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
		<dl{if $errorType.botcheckQuestion|isset} class="formError"{/if}>
			<dt>
				<label for="botcheckQuestion">{lang}wcf.botcheck.register.botcheckQuestion{/lang}</label>
			</dt>
			<dd>
				<input type="text" id="botcheckQuestion" name="botcheckQuestion" value="{$botcheckQuestion}" required="required" class="medium" />
				{if $errorType.botcheckQuestion|isset}
					<small class="innerError">
						{if $errorType.botcheckQuestion == 'notEqual'}{lang}wcf.botcheck.register.botcheckQuestion.error.notEqual{/lang}{/if}
					</small>
				{/if}
			</dd>
		</dl>
		{event name='emailFields'}
	</fieldset>
{/if}
