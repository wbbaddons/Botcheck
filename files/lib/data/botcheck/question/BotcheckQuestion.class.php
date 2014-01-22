<?php
namespace wcf\data\botcheck\question;

use wcf\data\DatabaseObject;
use wcf\system\request\IRouteController;
use wcf\system\Regex;
use wcf\system\WCF;
use wcf\util\ArrayUtil;
use wcf\util\StringUtil;

/**
 * Represents a question.
 *
 * @author		Markus Zhang <roul@codingcorner.info>
 * @copyright	2013 Markus Zhang
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		info.codingcorner.wcf.user.botcheck
 * @subpackage	data.botcheck.question
 * @category	Community Framework
 */
class BotcheckQuestion extends DatabaseObject implements IRouteController {
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'botcheck_question';
	
	/**
	 * @see	wcf\data\DatabaseObject::$databaseIndexName
	 */
	protected static $databaseTableIndexName = 'questionID';
	
	/**
	 * Returns the question's textual representation if a question is treated as a
	 * string.
	 *
	 * @return	string
	 */
	public function __toString() {
		return $this->getTitle();
	}

	/**
	 * @see wcf\data\ITitledObject::getTitle()
	 */
	public function getTitle() {
		return WCF::getLanguage()->get($this->question);
	}

	/**
	 * Validates the given answer to this question
	 *
	 * @var		string	$answer
	 * @return	boolean
	 */
	public function validateAnswer($answer) {
		$answers = StringUtil::unifyNewlines($this->answers);

		if (BOTCHECK_QUESTION_IGNORECASE && !$this->regex) {
			$answers = StringUtil::toLowerCase($answers);
			$answer = StringUtil::toLowerCase($answer);
		}

		if (BOTCHECK_QUESTION_IGNOREWHITESPACES && !$this->regex) {
			$whitespaceRegexp = new Regex('\h+');

			$answers = $whitespaceRegexp->replace($answers, '');
			$answer = $whitespaceRegexp->replace($answer, '');
		}

		$answers = ArrayUtil::trim(explode("\n", $answers));

		$success = false;
		if ($this->regex) {
			foreach ($answers as $pattern) {
				if (Regex::compile($pattern, ((BOTCHECK_QUESTION_IGNORECASE) ? (Regex::CASE_INSENSITIVE) : (Regex::MODIFIER_NONE)))->match($answer) == 1) {
					$success = true;
					break;
				}
			}
		}
		else {
			if (array_search($answer, $answers) !== false) {
				$success = true;
			}
		}

		$questionEditor = new BotcheckQuestionEditor($this);
		$questionEditor->updateStats($success);

		return $success;
	}
}
