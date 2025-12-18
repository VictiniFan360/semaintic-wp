<?php
/**
 * Semantic WP – Functions
 * Tema semántico, accesible y personalizable
 */

function semantic_wp_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    register_nav_menus([
        'primary' => __('Menú principal', 'semantic-wp'),
    ]);
}
add_action('after_setup_theme', 'semantic_wp_setup');

function semantic_wp_assets() {
    wp_enqueue_style(
        'semantic-wp-base',
        get_stylesheet_uri(),
        [],
        wp_get_theme()->get('Version')
    );
    wp_enqueue_style(
        'semantic-wp-main',
        get_template_directory_uri() . '/css/main.css',
        ['semantic-wp-base'],
        wp_get_theme()->get('Version')
    );
    wp_enqueue_style(
        'style-tablet',
        get_template_directory_uri() . '/css/style-tablet.css',
        ['semantic-wp-main'],
        wp_get_theme()->get('Version')
    );
    wp_enqueue_style(
        'style-mobile',
        get_template_directory_uri() . '/css/style-mobile.css',
        ['semantic-wp-main'],
        wp_get_theme()->get('Version')
    );
    wp_enqueue_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
        [],
        '5.3.0'
    );
    wp_enqueue_script(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
        [],
        '5.3.0',
        true
    );
    wp_enqueue_script(
        'semantic-personalize',
        get_template_directory_uri() . '/js/personalize.js',
        [],
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('wp_enqueue_scripts', 'semantic_wp_assets');

function semantic_wp_widgets() {
    register_sidebar([
        'name'          => __('Footer', 'semantic-wp'),
        'id'            => 'footer-widget',
        'before_widget' => '<section class="footer-widget">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="footer-widget-title">',
        'after_title'   => '</h2>',
    ]);
    register_sidebar([
        'name'          => __('Sidebar Derecha', 'semantic-wp'),
        'id'            => 'sidebar-right',
        'before_widget' => '<aside class="widget recommended-posts">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ]);
}
add_action('widgets_init', 'semantic_wp_widgets');

function semantic_wp_customize($wp_customize) {
    $wp_customize->add_setting('semantic_wp_logo');
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'semantic_wp_logo',
            [
                'label'   => __('Logo', 'semantic-wp'),
                'section' => 'title_tagline',
            ]
        )
    );
    $wp_customize->add_setting('semantic_wp_header_color', ['default' => '#241F31']);
    $wp_customize->add_setting('semantic_wp_footer_color', ['default' => '#241F31']);
    $wp_customize->add_setting('semantic_wp_link_color',   ['default' => '#005A9C']);

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'semantic_wp_header_color',
            [
                'label'   => __('Color del Header', 'semantic-wp'),
                'section' => 'colors',
            ]
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'semantic_wp_footer_color',
            [
                'label'   => __('Color del Footer', 'semantic-wp'),
                'section' => 'colors',
            ]
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'semantic_wp_link_color',
            [
                'label'   => __('Color de los links', 'semantic-wp'),
                'section' => 'colors',
            ]
        )
    );
    $wp_customize->add_setting('semantic_wp_font_family', ['default' => 'system-ui, sans-serif']);
    $wp_customize->add_control('semantic_wp_font_family', [
        'label'   => __('Fuente del sitio', 'semantic-wp'),
        'section' => 'colors',
        'type'    => 'select',
        'choices' => [
            'system-ui, sans-serif'      => __('Sistema', 'semantic-wp'),
            'Georgia, serif'             => __('Serif', 'semantic-wp'),
            'Courier New, monospace'     => __('Monoespaciada', 'semantic-wp'),
        ],
    ]);
    $wp_customize->add_setting('semantic_wp_topbar_enable', ['default' => true]);
    $wp_customize->add_control('semantic_wp_topbar_enable', [
        'label'   => __('Mostrar TopBar', 'semantic-wp'),
        'section' => 'title_tagline',
        'type'    => 'checkbox',
    ]);
    $wp_customize->add_setting('semantic_wp_topbar_text', ['default' => 'Sitio Oficial']);
    $wp_customize->add_control('semantic_wp_topbar_text', [
        'label'   => __('Texto del TopBar', 'semantic-wp'),
        'section' => 'title_tagline',
    ]);
    $wp_customize->add_setting('semantic_wp_topbar_link', ['default' => '']);
    $wp_customize->add_control('semantic_wp_topbar_link', [
        'label'   => __('Link del TopBar', 'semantic-wp'),
        'section' => 'title_tagline',
        'type'    => 'url',
    ]);
    $wp_customize->add_setting('semantic_wp_topbar_color', ['default' => '#003366']);
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'semantic_wp_topbar_color',
            [
                'label'   => __('Color del TopBar', 'semantic-wp'),
                'section' => 'colors',
            ]
        )
    );
    $wp_customize->add_setting('semantic_wp_topbar_bg');
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'semantic_wp_topbar_bg',
            [
                'label'   => __('Imagen del TopBar', 'semantic-wp'),
                'section' => 'title_tagline',
            ]
        )
    );
    $wp_customize->add_setting('semantic_wp_copyright_text', ['default' => get_bloginfo('name')]);
    $wp_customize->add_control('semantic_wp_copyright_text', [
        'label'   => __('Texto del copyright', 'semantic-wp'),
        'section' => 'title_tagline',
    ]);
}
add_action('customize_register', 'semantic_wp_customize');

function semantic_wp_customizer_css() {
    echo '<style>:root{';
    echo '--semantic-header-color:' . esc_attr(get_theme_mod('semantic_wp_header_color', '#241F31')) . ';';
    echo '--semantic-footer-color:' . esc_attr(get_theme_mod('semantic_wp_footer_color', '#241F31')) . ';';
    echo '--semantic-link-color:'   . esc_attr(get_theme_mod('semantic_wp_link_color', '#005A9C'))   . ';';
    echo '--semantic-font-family:'  . esc_attr(get_theme_mod('semantic_wp_font_family', 'system-ui, sans-serif')) . ';';

    if ($logo = get_theme_mod('semantic_wp_logo')) {
        echo '--semantic-logo-bg:url(' . esc_url($logo) . ');';
    }
    if ($topbar_bg = get_theme_mod('semantic_wp_topbar_bg')) {
        echo '--semantic-topbar-bg:url(' . esc_url($topbar_bg) . ');';
    }
    echo '--semantic-topbar-color:' . esc_attr(get_theme_mod('semantic_wp_topbar_color', '#003366')) . ';';
    echo '}</style>';
}
add_action('wp_head', 'semantic_wp_customizer_css');

function semantic_wp_posts_per_page($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_archive()) {
        $query->set('posts_per_page', 9);
    }
}
add_action('pre_get_posts', 'semantic_wp_posts_per_page');
function semantic_wp_recommended_posts($count = 4) {
    $recommended = new WP_Query([
        'posts_per_page' => $count,
        'orderby'        => 'rand',
        'post_status'    => 'publish',
    ]);

    if ($recommended->have_posts()) :
        echo '<div class="recommended-posts"><h2>Entradas recomendadas</h2><div class="row g-3">';
        while ($recommended->have_posts()) : $recommended->the_post(); ?>
            <article class="col-12">
                <div class="card h-100">
                    <?php if (has_post_thumbnail()) : ?>
                        <img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top" alt="<?php the_title_attribute(); ?>">
                    <?php endif; ?>
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title"><?php the_title(); ?></h3>
                        <p class="card-text"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                        <a href="<?php the_permalink(); ?>" class="btn btn-primary mt-auto">Leer más</a>
                    </div>
                </div>
            </article>
        <?php endwhile;
        echo '</div></div>';
        wp_reset_postdata();
    endif;
}

