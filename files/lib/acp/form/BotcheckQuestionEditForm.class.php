<?php
namespace wcf\acp\form;

use wcf\data\botcheck\BotcheckQuestion;
use wcf\data\botcheck\BotcheckQuestionAction;
use wcf\data\package\PackageCache;
use wcf\form\AbstractForm;
use wcf\system\exception\IllegalLinkException;
use wcf\system\language\I18nHandler;
use wcf\system\WCF;

/**
 * Shows the question edit form.
 * 
 * @author		Markus Bartz <roul@codingcorner.info>
 * @copyright	2013 Markus Bartz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		info.codingcorner.wcf.user.botcheck
 * @subpackage	acp.form
 * @category	Community Framework
 */
class BotcheckQuestionEditForm extends BotcheckQuestionForm {
	/**
	 * @see	wcf\page\AbstractPage::$activeMenuItem
	 */
	public $activeMenuItem = 'wcf.acp.menu.link.user.botcheck';
	
	/**
	 * @see	wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array('admin.user.botcheck.canManageQuestions');
	
	/**
	 * question id
	 * @var	integer
	 */
	public $questionID = 0;
	
	/**
	 * question object
	 * @var	wcf\data\botcheck\BotcheckQuestion
	 */
	public $questionObj = null;
	
	/**
	 * @see	wcf\page\IPage::readParameters()
	 */
	public function readParameters() {
		parent::readParameters();
		
		if (isset($_REQUEST['id'])) $this->questionID = intval($_REQUEST['id']);
		$this->questionObj = new BotcheckQuestion($this->questionID);
		if (!$this->questionObj->questionID) {
			throw new IllegalLinkException();
		}
	}
	
	/**
	 * @see	wcf\form\IForm::save()
	 */
	public function save() {
		AbstractForm::save();
		
		$this->question = 'wcf.acp.botcheck.question'.$this->questionObj->questionID;
		if (I18nHandler::getInstance()->isPlainValue('question')) {
			I18nHandler::getInstance()->remove($this->question, PackageCache::getInstance()->getPackageID('info.codingcorner.wcf.user.botcheck'));
			$this->question = I18nHandler::getInstance()->getValue('question');
		}
		else {
			I18nHandler::getInstance()->save('question', $this->question, 'wcf.acp.botcheck', PackageCache::getInstance()->getPackageID('info.codingcorner.wcf.user.botcheck'));
		}
		
		$this->answers = 'wcf.acp.botcheck.answers'.$this->questionObj->questionID;
		if (I18nHandler::getInstance()->isPlainValue('answers')) {
			I18nHandler::getInstance()->remove($this->answers, PackageCache::getInstance()->getPackageID('info.codingcorner.wcf.user.botcheck'));
			$this->answers = I18nHandler::getInstance()->getValue('answers');
		}
		else {
			I18nHandler::getInstance()->save('answers', $this->answers, 'wcf.acp.botcheck', PackageCache::getInstance()->getPackageID('info.codingcorner.wcf.user.botcheck'));
		}
		
		// update question
		$this->objectAction = new BotcheckQuestionAction(array($this->questionID), 'update', array('data' => array(
			'question' => $this->question,
			'answers' => $this->answers,
		)));
		$this->objectAction->executeAction();
		
		$this->saved();
		
		// show success
		WCF::getTPL()->assign(array(
			'success' => true
		));
	}
	
	/**
	 * @see	wcf\page\IPage::readData()
	 */
	public function readData() {
		parent::readData();
		
		if (empty($_POST)) {
			I18nHandler::getInstance()->setOptions('question', PackageCache::getInstance()->getPackageID('info.codingcorner.wcf.user.botcheck'), $this->questionObj->question, 'wcf.acp.botcheck.question\d+');
			$this->question = $this->questionObj->question;
			
			I18nHandler::getInstance()->setOptions('answers', PackageCache::getInstance()->getPackageID('info.codingcorner.wcf.user.botcheck'), $this->questionObj->answers, 'wcf.acp.botcheck.answers\d+');
			$this->answers = $this->questionObj->answers;
		}
	}
	
	/**
	 * @see	wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		I18nHandler::getInstance()->assignVariables(!empty($_POST));
		
		WCF::getTPL()->assign(array(
			'question' => $this->questionObj,
			'action' => 'edit'
		));
	}
}
