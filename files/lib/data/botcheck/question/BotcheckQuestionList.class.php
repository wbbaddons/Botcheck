<?php
namespace wcf\data\botcheck\question;

use wcf\data\DatabaseObjectList;

/**
 * Represents a list of questions.
 * 
 * @author		Markus Bartz <roul@codingcorner.info>
 * @copyright	2013 Markus Bartz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		info.codingcorner.wcf.user.botcheck
 * @subpackage	data.botcheck.question
 * @category	Community Framework
 */
class BotcheckQuestionList extends DatabaseObjectList {
	/**
	 * @see	wcf\data\DatabaseObjectList::$className
	 */
	public $className = 'wcf\data\botcheck\question\BotcheckQuestion';
}
