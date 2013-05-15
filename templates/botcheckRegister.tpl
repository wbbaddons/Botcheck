{if MODULE_USER_BOTCHECK && $question|isset}
	<fieldset>
		<legend>{lang}wcf.botcheck.register.title{/lang}</legend>
		<dl{if $errorType.email|isset} class="formError"{/if}>
			<dt>
				<label for="email">{lang}wcf.botcheck.register.question{/lang}</label>
			</dt>
			<dd>
				{$question}
			</dd>	
		</dl>
		<dl{if $errorType.answer|isset} class="formError"{/if}>
			<dt>
				<label for="answer">{lang}wcf.botcheck.register.answer{/lang}</label>
			</dt>
			<dd>
				<input type="text" id="answer" name="answer" value="{$answer}" required="required" class="medium" />
				{if $errorType.answer|isset}
					<small class="innerError">
						{if $errorType.answer == 'notEqual'}{lang}wcf.botcheck.register.answer.error.notEqual{/lang}{/if}
					</small>
				{/if}
			</dd>
		</dl>
		{event name='emailFields'}
	</fieldset>
{/if}
