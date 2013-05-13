<?php
namespace wcf\data\botquestion;

use wcf\data\DatabaseObjectEditor;

// use wcf\data\IEditableCachedObject;
// use wcf\system\cache\builder\BotQuestionCacheBuilder;

/**
 * Provides functions to edit questions.
 * 
 * @author		Markus Bartz <roul@codingcorner.info>
 * @copyright	2013 Markus Bartz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		info.codingcorner.wcf.user.botquestion
 * @subpackage	data.botquestion
 * @category	Community Framework
 * 
 * @todo		TODO: implement caching (prepared)
 */
class BotQuestionEditor extends DatabaseObjectEditor /*implements IEditableCachedObject*/ {
	/**
	 * @see	wcf\data\DatabaseObjectEditor::$baseClass
	 */
	protected static $baseClass = 'wcf\data\botquestion\BotQuestion';
	
	/**
	 * @see	wcf\data\IEditableCachedObject::resetCache()
	 */
	// public static function resetCache() {
	// 	BotQuestionCacheBuilder::getInstance()->reset();
	// }
}
