<?php
namespace wcf\data\botcheck;

use wcf\data\DatabaseObject;
use wcf\system\WCF;

/**
 * Represents a question.
 * 
 * @author		Markus Bartz <roul@codingcorner.info>
 * @copyright	2013 Markus Bartz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		info.codingcorner.wcf.user.botcheck
 * @subpackage	data.botcheck
 * @category	Community Framework
 */
class BotcheckQuestion extends DatabaseObject {
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
		return WCF::getLanguage()->get($this->question);
	}
}
