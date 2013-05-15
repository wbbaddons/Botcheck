{include file='header'}
<header class="boxHeadline">
	<h1>{lang}wcf.acp.botcheck.question.{$action}{/lang}</h1>
</header>

{if $errorField}
	<p class="error">{lang}wcf.global.form.error{/lang}</p>
{/if}

{if $success|isset}
	<p class="success">{lang}wcf.global.success.{$action}{/lang}</p>
{/if}

<div class="contentNavigation">
	<nav>
		<ul>
			<li><a href="{link controller='BotcheckQuestionList'}{/link}" class="button"><span class="icon icon16 icon-list"></span> <span>{lang}wcf.acp.menu.link.user.botcheck.question.list{/lang}</span></a></li>
				
			{event name='contentNavigationButtons'}
		</ul>
	</nav>
</div>

<form method="post" action="{if $action == 'add'}{link controller='BotcheckQuestionAdd'}{/link}{else}{link controller='BotcheckQuestionEdit' object=$question}{/link}{/if}">
	<div class="container containerPadding marginTop">
		<fieldset>
			<legend>{lang}wcf.global.form.data{/lang}</legend>
			
			<dl{if $errorField == 'question'} class="formError"{/if}>
				<dt><label for="question">{lang}wcf.acp.botcheck.question.question{/lang}</label></dt>
				<dd>
					<input type="text" id="question" name="question" value="{$question}" autofocus="autofocus" class="long" />
					{if $errorField == 'question'}
						<small class="innerError">
							{if $errorType == 'empty'}
								{lang}wcf.global.form.error.empty{/lang}
							{else if $errorType == 'multilingual'}
								{lang}wcf.global.form.error.multilingual{/lang}
							{else}
								{lang}wcf.acp.botcheck.question.question.error.{@$errorType}{/lang}
							{/if}
						</small>
					{/if}
				</dd>
			</dl>
			{include file='multipleLanguageInputJavascript' elementIdentifier='question' forceSelection=false}
			
			<dl{if $errorField == 'answers'} class="formError"{/if}>
				<dt><label for="answers">{lang}wcf.acp.botcheck.question.answers{/lang}</label></dt>
				<dd>
					<textarea id="answers" name="answers" cols="40" rows="10">{$answers}</textarea>
					<small>{lang}wcf.acp.botcheck.question.answers.description{/lang}</small>
					{if $errorField == 'answers'}
						<small class="innerError">
							{if $errorType == 'empty'}
								{lang}wcf.global.form.error.empty{/lang}
							{else if $errorType == 'multilingual'}
								{lang}wcf.global.form.error.multilingual{/lang}
							{else}
								{lang}wcf.acp.botcheck.question.answers.error.{@$errorType}{/lang}
							{/if}
						</small>
					{/if}
				</dd>
			</dl>
			{include file='multipleLanguageInputJavascript' elementIdentifier='answers' forceSelection=false}
			
			{event name='dataFields'}
		</fieldset>
		
		{event name='fieldsets'}
	</div>
	
	<div class="formSubmit">
		<input type="submit" value="{lang}wcf.global.button.submit{/lang}" accesskey="s" />
	</div>
</form>

{include file='footer'}
