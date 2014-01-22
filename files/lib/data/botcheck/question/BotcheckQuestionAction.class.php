<?php
namespace wcf\data\botcheck\question;

use wcf\data\language\item\LanguageItemAction;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\system\database\util\PreparedStatementConditionBuilder;
use wcf\system\WCF;

/**
 * Executes question-related actions.
 *
 * @author		Markus Zhang <roul@codingcorner.info>
 * @copyright	2013 Markus Zhang
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		info.codingcorner.wcf.user.botcheck
 * @subpackage	data.botcheck.question
 * @category	Community Framework
 */
class BotcheckQuestionAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$className
	 */
	protected $className = 'wcf\data\botcheck\question\BotcheckQuestionEditor';
	
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$permissionsCreate
	 */
	protected $permissionsCreate = array('admin.user.botcheck.canManageQuestions');
	
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$permissionsDelete
	 */
	protected $permissionsDelete = array('admin.user.botcheck.canManageQuestions');
	
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$permissionsUpdate
	 */
	protected $permissionsUpdate = array('admin.user.botcheck.canManageQuestions');
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$requireACP
	 */
	protected $requireACP = array('create', 'delete', 'update');
	
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::delete()
	 */
	public function delete() {
		parent::delete();
		
		if (!empty($this->objects)) {
			// identify i18n questions
			$languageVariables = array();
			foreach ($this->objects as $object) {
				if (preg_match('~wcf.acp.botcheck.question\d+~', $object->question)) {
					$languageVariables[] = $object->question;
				}
			}
			
			// remove language variables
			if (!empty($languageVariables)) {
				$conditions = new PreparedStatementConditionBuilder();
				$conditions->add("languageItem IN (?)", array($languageVariables));
				
				$sql = "SELECT	languageItemID
					FROM	wcf".WCF_N."_language_item
					".$conditions;
				$statement = WCF::getDB()->prepareStatement($sql);
				$statement->execute($conditions->getParameters());
				$languageItemIDs = array();
				while ($row = $statement->fetchArray()) {
					$languageItemIDs[] = $row['languageItemID'];
				}
				
				$objectAction = new LanguageItemAction($languageItemIDs, 'delete');
				$objectAction->executeAction();
			}
		}
	}
}
