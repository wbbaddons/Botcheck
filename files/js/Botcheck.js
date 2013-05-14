/**
 * Botcheck-related classes.
 * 
 * @author		Markus Bartz <roul@codingcorner.info>
 * @copyright	2013 Markus Bartz
 * @license		GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 */

Botcheck = {};

/**
 * Quick login extensions
 */
Botcheck.QuickLogin = Class.extend({
	/**
	 * botcheck_question input
	 * @var jQuery
	 */
	_question: null,

	/**
	 * botcheck_question input container
	 * @var jQuery
	 */
	_questionContainer: null,

	/**
	 * Initializes the quick login extensions
	 */
	init: function() {
		this._question = $('#botcheck_question');
		this._questionContainer = this._question.parents('dl');

		var $loginForm = $('#loginForm');
		$loginForm.find('input[name=action]').change($.proxy(this._change, this));
	},
	
	/**
	 * Handle toggle between login and register.
	 * 
	 * @param	object		event
	 */
	_change: function(event) {
		if ($(event.currentTarget).val() === 'register') {
			this._setState(true);
		}
		else {
			this._setState(false);
		}
	},

	/**
	 * Sets registration extension states.
	 *
	 * @param boolean enable
	 */
	_setState: function(enable) {
		if (enable) {
			this._question.enable();
			this._question.attr('required', true);
			this._questionContainer.removeClass('disabled');
		}
		else {
			this._question.disable();
			this._question.attr('required', false);
			this._questionContainer.addClass('disabled');
		}

		this._loginSubmitButton.val(buttonTitle);
	}
});
