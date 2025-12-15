<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<a href="#contenido-principal" class="skip-link">Saltar al contenido principal</a>

<header class="site-header">
    <div class="container header-inner">
        <h1 class="site-title">
            <a
                href="<?php echo esc_url(home_url('/')); ?>"
                class="site-logo"
                title="<?php bloginfo('name'); ?>"
            >
                <span class="visually-hidden"><?php bloginfo('name'); ?></span>
            </a>
        </h1>

        <nav class="site-navigation" aria-label="Menú principal">
            <button
                class="menu-toggle"
                aria-controls="menu-principal"
                aria-expanded="false"
            >
                <span class="visually-hidden">Abrir menú</span>
            </button>

            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'menu_id'        => 'menu-principal',
                'container'      => false,
                'menu_class'     => 'menu',
                'fallback_cb'    => false,
                'walker'         => new class extends Walker_Nav_Menu {
                    function start_el(&$output, $item) {
                        $output .= '<li class="menu-item">';
                        $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
                    }
                    function end_el(&$output) {
                        $output .= '</li>';
                    }
                }
            ]);
            ?>
        </nav>
    </div>
</header>

<main id="contenido-principal" class="site-main container">