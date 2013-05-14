<?php
namespace wcf\system\event\listener;

use wcf\system\event\IEventListener;
use wcf\system\WCF;

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
	 * instance of RegisterForm
	 * @var	wcf\form\RegisterForm
	 */
	protected $eventObj = null;
	
	/**
	 * @see	wcf\system\event\IEventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName) {
		$this->eventObj = $eventObj;
		
		$this->$eventName();
	}
	
	/**
	 * Handles the assignVariables event.
	 */
	protected function assignVariables() {
		WCF::getTPL()->assign(array(
			'question' => 'Testfrage',
		));
	}
}
