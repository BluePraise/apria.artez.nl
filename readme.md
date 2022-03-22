# ABOUT THIS THEME

## TEMPLATE TYPES

### Page with sidebar
- Uses CSS Grid - see `grid.css
- Classes: `<main class="content-with-sidebar">`
- HTML Structure: \s\s
    ```<main class="content-with-sidebar">
        <article class="">
            <header class="article-header">
                <h1 class="content-title"></h1>
                <h2 class="subtitle"></h2>
            </header>
            <div class="article__text"><?php the_content(); ?></div>
        </article> 
        <aside></aside>```
- Used by: `single.php`, `page-sidebar.php`
- Widget/Sidebar: `rp-right-sidebar`

## Changelog
2021.12
- Fixes selected posts view in singles
- Refactored home php. Everything is now in template php
- Logo in mobile open now is centered correctly.
2022.03.22
- Fixed author display on author.php
- Fixed grid on author.
- Consolidated grid to `.page-view`
- Refactored SCSS folders
- Added wide image in ACF to issue page
