<?php
namespace wcf\system\event\listener;

use wcf\system\cache\builder\BotcheckQuestionCacheBuilder;
use wcf\system\event\IEventListener;
use wcf\system\exception\UserInputException;
use wcf\system\Regex;
use wcf\system\WCF;
use wcf\util\ArrayUtil;
use wcf\util\StringUtil;

/**
 * Handles botcheck stuff in register form.
 * 
 * @author		Markus Bartz <roul@codingcorner.info>
 * @copyright	2013 Markus Bartz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		info.codingcorner.wcf.user.botcheck
 * @subpackage	system.event.listener
 * @category	Community Framework
 */
class RegisterFormBotcheckListener implements IEventListener {
	/**
	 * question cache
	 * @var array<wcf\data\botcheck\question\BotcheckQuestion>
	 */
	protected $questions = null;

	/**
	 * instance of RegisterForm
	 * @var	wcf\form\RegisterForm
	 */
	protected $eventObj = null;

	/**
	 * question
	 * @var wcf\data\botcheck\question\BotcheckQuestion
	 */
	protected $question = null;

	/**
	 * answer
	 * @var string
	 */
	protected $answer = '';

	/**
	 * botcheck question enabled
	 * @var bool
	 */
	protected $enabled = MODULE_USER_BOTCHECK;
	
	protected function getQuestions() {
		if ($this->questions === null) {
			$this->questions = BotcheckQuestionCacheBuilder::getInstance()->getData();
		}

		return $this->questions;
	}

	/**
	 * @see	wcf\system\event\IEventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName) {
		$this->eventObj = $eventObj;
		
		if ($this->enabled && (!WCF::getSession()->getVar('botcheckQuestionSolved') || $eventName == 'save')) {
			$questions = $this->getQuestions();

			if (!count($questions)) {
				$this->enabled = false;

				return;
			}

			$this->$eventName();
		}
	}
	
	/**
	 * Handles the assignVariables event.
	 */
	protected function assignVariables() {
		WCF::getTPL()->assign(array(
			'question' => $this->question,
			'answer' => $this->answer,
		));
	}

	/**
	 * Sets a random question.
	 */
	protected function setQuestion() {
		$questions = $this->getQuestions();
		$questionIDs = array_keys($questions);

		$i = mt_rand(0, count($questionIDs) - 1);
		$questionID = $questionIDs[$i];

		$this->question = $questions[$questionID];
		WCF::getSession()->register('questionID', $questionID);
	}

	/**
	 * Handles the readData event.
	 * This is only called in UserGroupEditForm.
	 */
	protected function readData() {
		if (empty($_POST)) {
			$this->setQuestion();
		}
	}

	/**
	 * Handles the readFormParameters event.
	 */
	protected function readFormParameters() {
		$questionID = WCF::getSession()->getVar('questionID');

		$questions = $this->getQuestions();
		$this->question = $questions[$questionID];

		if (isset($_POST['answer'])) $this->answer = StringUtil::trim($_POST['answer']);
	}

	/**
	 * Handles the validate event.
	 */
	protected function validate() {
		$answer = $this->answer;
		$answers = StringUtil::unifyNewlines($this->question->answers);

		if (BOTCHECK_QUESTION_IGNORECASE && !$this->question->regexp) {
			$answers = StringUtil::toLowerCase($answers);
			$answer = StringUtil::toLowerCase($answer);
		}

		if (BOTCHECK_QUESTION_IGNOREWHITESPACES && !$this->question->regexp) {
			$whitespaceRegexp = new Regex('\h+');

			$answers = $whitespaceRegexp->replace($answers, '');
			$answer = $whitespaceRegexp->replace($answer, '');
		}

		$answers = ArrayUtil::trim(explode("\n", $answers));

		$error = true;
		if ($this->question->regexp) {
			foreach ($answers as $pattern) {
				if (Regex::compile($pattern, ((BOTCHECK_QUESTION_IGNORECASE) ? (Regex::CASE_INSENSITIVE) : (Regex::MODIFIER_NONE)))->match($answer) == 1) {
					$error = false;
					
					break;
				}
			}
		}
		else {
			if (array_search($answer, $answers) !== false) {
				$error = false;
			}
		}

		if ($error) {
			$this->eventObj->errorType['answer'] = 'false';

			if (BOTCHECK_QUESTION_NEWONFAIL) {
				$this->setQuestion();
				$this->answer = '';
			}

			return;
		}

		WCF::getSession()->register('botcheckQuestionSolved', true);
	}

	/**
	 * Handles the save event.
	 */
	protected function save() {
		WCF::getSession()->unregister('botcheckQuestionSolved');
	}
}
