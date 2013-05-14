<?php
namespace wcf\data\botcheck;

use wcf\data\DatabaseObjectEditor;

// use wcf\data\IEditableCachedObject;
// use wcf\system\cache\builder\BotQuestionCacheBuilder;

/**
 * Provides functions to edit questions.
 * 
 * @author		Markus Bartz <roul@codingcorner.info>
 * @copyright	2013 Markus Bartz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		info.codingcorner.wcf.user.botcheck
 * @subpackage	data.botcheck
 * @category	Community Framework
 * 
 * @todo		TODO: implement caching (prepared)
 */
class BotcheckQuestionEditor extends DatabaseObjectEditor /*implements IEditableCachedObject*/ {
	/**
	 * @see	wcf\data\DatabaseObjectEditor::$baseClass
	 */
	protected static $baseClass = 'wcf\data\botcheck\BotcheckQuestion';
	
	/**
	 * @see	wcf\data\IEditableCachedObject::resetCache()
	 */
	// public static function resetCache() {
	//	TODO: One of those:
	// 	BotcheckQuestionCacheBuilder::getInstance()->reset();
	//	BotcheckCacheBuilder::getInstance()->reset();
	// }
}
