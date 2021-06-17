{extends file="main.tpl"}
{block name="content"}
    <div class="main-content">
        <article class="main-column">
            <div class="home-intro">
                <p>{$intro|htmlspecialchars}</p>
            </div>

            {foreach $allIssues as $aIssue}
                <div class="home-issue clickable-block" data-href="{$aIssue->url}">
                    <div class="article__preview-background"{if $aIssue->background_image} style="background-image: url({$aIssue->background_image});background-color:{$aIssue->background_color};color:{$aIssue->text_color}"{/if}>
                        <div class="article__issue article__issue--home balance-text">{$aIssue->number|formatIssueNumber|string_format:#issue_number#}</div>
                        <a href="{$aIssue->url}" class="article__title balance-text"
                           style="color:inherit">{$aIssue->title}</a>
                        {if $aIssue->subtitle}
                            <div class="article__subtitle balance-text">{$aIssue->subtitle}</div>
                        {/if}
                    </div>
                    <div class="article__info">
                        <div class="article__meta">
                            {$aIssue->number|formatIssueNumber}<br/>
                            {$aIssue->date|formatDateLarge}<br/>
                            {foreach $aIssue->authors as $aAuthor}
                                <a
                                href="{$aAuthor->post_url}">{$aAuthor->name}</a>{if !$aAuthor@last || $aIssue->download_pdf}
                                <br/>
                            {/if}
                            {/foreach}
                            {if $aIssue->download_pdf}
                                <br>
                                <a class="download_pdf" href="{$aIssue->download_pdf}">{#download_pdf#}</a>
                            {/if}
                        </div>
                        <div class="article__preview-text">
                            {$aIssue->preview_text}
                        </div>
                    </div>
                </div>
                {if $aIssue@first && count($allIssues) > 1}
                    <div class="load-more-issues js-load-more hide-on-desktop">{#prev_issue#}</div>
                {/if}
            {/foreach}
            {include "element_footer.tpl" class="hide-on-mobile"}

        </article>

        {include "element_sidebar.tpl" sidebar_posts=$currentIssuePosts}

    </div>
{/block}
