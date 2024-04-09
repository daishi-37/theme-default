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
                    <img src="<?php echo THEMEIMG; ?>/logo.png" alt="" class="header__logo-img">
                </div>
                <nav id="global-nav" class="header__navi">
                    <?php
                        wp_nav_menu(array( 
                            'container'       => 'nav', 
                            'container_id'    => 'global-nav',
                            'container_class' => 'header__navi',
                            'menu_class'      => 'header__navi-lists',
                            'add_li_class'    => 'header__navi-item',
                            'add_a_class'     => 'header__navi-link',
                            'theme_location'  => 'global-nav', 
                        )); 
                    ?>
                </nav>
                <div class="header__hamburger-button">
                </div>
            </div>
        </header>
        <div class="header__dummy"></div>
