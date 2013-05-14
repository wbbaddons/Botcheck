{include file='header'}

<script type="text/javascript">
	//<![CDATA[
	$(function() {
		new WCF.Action.Delete('wcf\\data\\botcheck\\BotcheckQuestionAction', '.jsQuestionRow');
		
		var options = { };
		{if $pages > 1}
			options.refreshPage = true;
			{if $pages == $pageNo}
				options.updatePageNumber = -1;
			{/if}
		{else}
			options.emptyMessage = '{lang}wcf.acp.botcheck.question.noneAvailable{/lang}';
		{/if}
		
		new WCF.Table.EmptyTableHandler($('#questionTableContainer'), 'jsLabelRow', options);
	});
	//]]>
</script>

<header class="boxHeadline">
	<h1>{lang}wcf.acp.botcheck.question.list{/lang}</h1>
</header>

<div class="contentNavigation">
	{pages print=true assign=pagesLinks controller="BotcheckQuestionList" link="pageNo=%d&sortField=$sortField&sortOrder=$sortOrder"}
	
	<nav>
		<ul>
			<li><a href="{link controller='BotcheckQuestionAdd'}{/link}" class="button"><span class="icon icon16 icon-plus"></span> <span>{lang}wcf.acp.botcheck.question.add{/lang}</span></a></li>
				
			{event name='contentNavigationButtonsTop'}
		</ul>
	</nav>
</div>

{if $objects|count}
	<div id="questionTableContainer" class="tabularBox tabularBoxTitle marginTop">
		<header>
			<h2>{lang}wcf.acp.botcheck.question.list{/lang} <span class="badge badgeInverse">{#$items}</span></h2>
		</header>
		
		<table class="table">
			<thead>
				<tr>
					<th class="columnID columnLabelID{if $sortField == 'questionID'} active {@$sortOrder}{/if}" colspan="2"><a href="{link controller='BotcheckQuestionList'}pageNo={@$pageNo}&sortField=questionID&sortOrder={if $sortField == 'qustionID' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}wcf.global.objectID{/lang}</a></th>
					<th class="columnTitle columnLabel{if $sortField == 'question'} active {@$sortOrder}{/if}"><a href="{link controller='BotcheckQuestionList'}pageNo={@$pageNo}&sortField=question&sortOrder={if $sortField == 'question' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}wcf.acp.botcheck.question.question{/lang}</a></th>
					
					{event name='columnHeads'}
				</tr>
			</thead>
			
			<tbody>
				{foreach from=$objects item=question}
					<tr class="jsQuestionRow">
						<td class="columnIcon">
							<a href="{link controller='BotcheckQuestionEdit' object=$question}{/link}" title="{lang}wcf.global.button.edit{/lang}" class="jsTooltip"><span class="icon icon16 icon-pencil"></span></a>
							<span class="icon icon16 icon-remove jsDeleteButton jsTooltip pointer" title="{lang}wcf.global.button.delete{/lang}" data-object-id="{@$question->questionID}" data-confirm-message="{lang}wcf.acp.botcheck.question.delete.sure{/lang}"></span>
							
							{event name='rowButtons'}
						</td>
						<td class="columnID">{@$question->questionID}</td>
						<td class="columnTitle columnLabel"><a href="{link controller='BotcheckQuestionEdit' object=$question}{/link}" title="{$question}" class="question">{$question}</a></td>
						
						{event name='columns'}
					</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
	
	<div class="contentNavigation">
		{@$pagesLinks}
		
		<nav>
			<ul>
				<li><a href="{link controller='BotcheckQuestionAdd'}{/link}" class="button"><span class="icon icon16 icon-plus"></span> <span>{lang}wcf.acp.botcheck.question.add{/lang}</span></a></li>
					
				{event name='contentNavigationButtonsBottom'}
			</ul>
		</nav>
	</div>
{else}
	<p class="info">{lang}wcf.acp.botcheck.question.noneAvailable{/lang}</p>
{/if}

{include file='footer'}
