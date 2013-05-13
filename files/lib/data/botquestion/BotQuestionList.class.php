<?php
namespace wcf\data\botquestion;

use wcf\data\DatabaseObjectList;

/**
 * Represents a list of questions.
 * 
 * @author		Markus Bartz <roul@codingcorner.info>
 * @copyright	2013 Markus Bartz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package		info.codingcorner.wcf.user.botquestion
 * @subpackage	data.botquestion
 * @category	Community Framework
 */
class BotQuestionList extends DatabaseObjectList {
	/**
	 * @see	wcf\data\DatabaseObjectList::$className
	 */
	public $className = 'wcf\data\botquestion\BotQuestion';
}
