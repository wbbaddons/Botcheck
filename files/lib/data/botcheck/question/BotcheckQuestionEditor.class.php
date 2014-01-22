<?php
namespace wcf\data\botcheck\question;

use wcf\data\DatabaseObjectEditor;
use wcf\data\IEditableCachedObject;
use wcf\system\cache\builder\BotcheckQuestionCacheBuilder;
use wcf\system\WCF;

/**
 * Provides functions to edit questions.
 *
 * @author		Markus Zhang <roul@codingcorner.info>
 * @copyright	2013 Markus Zhang
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		info.codingcorner.wcf.user.botcheck
 * @subpackage	data.botcheck.question
 * @category	Community Framework
 */
class BotcheckQuestionEditor extends DatabaseObjectEditor implements IEditableCachedObject {
	/**
	 * @see	wcf\data\DatabaseObjectEditor::$baseClass
	 */
	protected static $baseClass = 'wcf\data\botcheck\question\BotcheckQuestion';
	
	/**
	 * @see	wcf\data\IEditableCachedObject::resetCache()
	 */
	public static function resetCache() {
		BotcheckQuestionCacheBuilder::getInstance()->reset();
	}

	/**
	 * Updates the question stats.
	 *
	 * @var	boolean	$success
	 */
	public function updateStats($success = true) {
		$updateField = ($success ? 'succeeded' : 'failed');

		$sql = "UPDATE	wcf".WCF_N."_botcheck_question
				SET		".$updateField." = ".$updateField." + 1
				WHERE	questionID = ?";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($this->questionID));
	}
}
