<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<a href="#contenido-principal" class="skip-link">Saltar al contenido principal</a>

<?php if ( get_theme_mod('semantic_wp_topbar_enable') ) : ?>
<div class="site-topbar d-flex align-items-center px-3" style="background-color: var(--semantic-topbar-color); height: 50px;">
    <?php if (get_theme_mod('semantic_wp_topbar_bg')) : ?>
        <div class="topbar-logo me-2" style="background-image: var(--semantic-topbar-bg); background-size: contain; background-repeat: no-repeat; width: 40px; height: 40px;"></div>
    <?php endif; ?>
    <div class="topbar-text" style="color: #fff; font-weight: bold;">
        <?php echo esc_html(get_theme_mod('semantic_wp_topbar_text', 'Sitio Oficial')); ?>
    </div>
</div>
<?php endif; ?>

<header class="site-header">
    <div class="container d-flex justify-content-between align-items-center py-2">
        <h1 class="site-title m-0" style="font-size: 1.5rem;">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" title="<?php bloginfo('name'); ?>">
                <span class="visually-hidden"><?php bloginfo('name'); ?></span>
            </a>
        </h1>

        <nav class="site-navigation" aria-label="Menú principal">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu-principal" aria-controls="menu-principal" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'menu_id' => 'menu-principal',
                'container' => 'div',
                'container_class' => 'collapse navbar-collapse',
                'menu_class' => 'navbar-nav ms-auto',
                'fallback_cb' => false,
            ]);
            ?>
        </nav>
    </div>
</header>

<main id="contenido-principal" class="site-main container mt-4">