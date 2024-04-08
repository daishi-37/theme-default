<?php $locale = get_locale(); ?>
<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/WebPage" <?php language_attributes(); ?>>
    <head prefix="og: http://ogp.me/ns# <?php $type = is_home() ? 'website' : 'article'; echo 'fb: http://ogp.me/ns/fb# '.$type.': http://ogp.me/ns/'.$type.'#'; ?>">
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title><?php wp_title('|', true, 'right').bloginfo('name'); ?></title>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div id="top"></div>
        <header class="header">
            <div class="header__inner">
                <div class="header__logo">
                </div>
                <nav id="global-nav" class="header__navi">
                </nav>
                <div class="header__hamburger-button">
                </div>
            </div>
        </header>
        <div class="header__dummy"></div>
