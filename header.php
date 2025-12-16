<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<a href="#contenido-principal" class="skip-link">
    Saltar al contenido principal
</a>

<?php if ( get_theme_mod('semantic_wp_topbar_enable') ) :
    $topbar_text = get_theme_mod('semantic_wp_topbar_text', 'Sitio Oficial');
    $topbar_link = get_theme_mod('semantic_wp_topbar_link');
    $topbar_bg   = get_theme_mod('semantic_wp_topbar_bg');
?>
<div class="site-topbar">
    <?php if ( $topbar_bg ) : ?>
        <div class="topbar-logo"></div>
    <?php endif; ?>

    <div class="topbar-text">
        <?php if ( $topbar_link ) : ?>
            <a href="<?php echo esc_url($topbar_link); ?>" class="topbar-link">
                <?php echo esc_html($topbar_text); ?>
            </a>
        <?php else : ?>
            <?php echo esc_html($topbar_text); ?>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<header class="site-header">
    <div class="container">

        <nav class="navbar navbar-expand-lg" aria-label="Menú principal">
<h1 class="site-branding mb-0">
    <a id="site-logo" class="navbar-brand logo-bg" href="<?php echo esc_url( home_url() ); ?>" title="<?php bloginfo('name'); ?>">
        <span class="visually-hidden"><?php bloginfo('name'); ?></span>
    </a>
</h1>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#main-menu"
                aria-controls="main-menu"
                aria-expanded="false"
                aria-label="Abrir menú"
            >
                <span class="navbar-toggler-icon"></span>
                <span class="visually-hidden">Abrir menú</span>
            </button>
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'menu_id'        => 'main-menu',
                'container'      => 'div',
                'container_class'=> 'collapse navbar-collapse',
                'menu_class'     => 'menu navbar-nav ms-auto',
                'fallback_cb'    => false,
            ]);
            ?>

        </nav>

    </div>
</header>

<main id="contenido-principal" class="site-main container">
