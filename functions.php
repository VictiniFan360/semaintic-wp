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
        null
    );
    wp_enqueue_style(
        'semantic-wp-main',
        get_template_directory_uri() . '/css/main.css',
        ['semantic-wp-base'],
        null
    );
    wp_enqueue_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
        [],
        null
    );

    wp_enqueue_script(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
        [],
        null,
        true
    );
    wp_enqueue_script(
        'semantic-wp-backgrounds',
        get_template_directory_uri() . '/assets/background.js',
        [],
        null,
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
    $wp_customize->add_setting('semantic_wp_header_color', [
        'default' => '#241F31',
    ]);

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

    $wp_customize->add_setting('semantic_wp_footer_color', [
        'default' => '#241F31',
    ]);

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
    $wp_customize->add_setting('semantic_wp_font_family', [
        'default' => 'Helvetica, Helvetica Neue, Arial, DejaVu Sans, Ubuntu, sans-serif',
    ]);

    $wp_customize->add_control(
        'semantic_wp_font_family',
        [
            'label'   => __('Fuente del sitio', 'semantic-wp'),
            'section' => 'colors',
            'type'    => 'select',
            'choices' => [
                'Helvetica, Helvetica Neue, Arial, DejaVu Sans, Ubuntu, sans-serif' =>
                    'Helvetica / Arial (Sans)',
                'Verdana, Geneva, sans-serif' =>
                    'Verdana',
                'Trebuchet MS, Trebuchet, Arial, sans-serif' =>
                    'Trebuchet MS',
                'Tahoma, Geneva, sans-serif' =>
                    'Tahoma',
                'Times, Times New Roman, serif' =>
                    'Times',
            ],
        ]
    );
    $wp_customize->add_setting('semantic_wp_background_image');

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'semantic_wp_background_image',
            [
                'label'   => __('Imagen de fondo fija', 'semantic-wp'),
                'section' => 'colors',
            ]
        )
    );

    $wp_customize->add_setting('semantic_wp_background_area', [
        'default' => 'none',
    ]);

    $wp_customize->add_control(
        'semantic_wp_background_area',
        [
            'label'   => __('Imagen de fondo en:', 'semantic-wp'),
            'section' => 'colors',
            'type'    => 'select',
            'choices' => [
                'none'   => __('Ninguno', 'semantic-wp'),
                'body'   => __('Toda la página', 'semantic-wp'),
                'header' => __('Header', 'semantic-wp'),
                'footer' => __('Footer', 'semantic-wp'),
            ],
        ]
    );
    $wp_customize->add_setting('semantic_wp_allow_user_background', [
        'default' => false,
    ]);

    $wp_customize->add_control(
        'semantic_wp_allow_user_background',
        [
            'label'   => __('Permitir que el visitante elija el fondo', 'semantic-wp'),
            'section' => 'colors',
            'type'    => 'checkbox',
        ]
    );
    $wp_customize->add_setting('semantic_wp_copyright_text', [
        'default' => get_bloginfo('name'),
    ]);

    $wp_customize->add_control(
        'semantic_wp_copyright_text',
        [
            'label'   => __('Texto del copyright', 'semantic-wp'),
            'section' => 'title_tagline',
        ]
    );
}
add_action('customize_register', 'semantic_wp_customize');
function semantic_wp_customizer_css() {

    $header_color = get_theme_mod('semantic_wp_header_color', '#241F31');
    $footer_color = get_theme_mod('semantic_wp_footer_color', '#241F31');
    $logo         = get_theme_mod('semantic_wp_logo');
    $bg_image     = get_theme_mod('semantic_wp_background_image');
    $bg_area      = get_theme_mod('semantic_wp_background_area', 'none');
    $font_family  = get_theme_mod(
        'semantic_wp_font_family',
        'Helvetica, Helvetica Neue, Arial, DejaVu Sans, Ubuntu, sans-serif'
    );

    echo '<style>:root{';
    echo '--semantic-header-color:' . esc_attr($header_color) . ';';
    echo '--semantic-footer-color:' . esc_attr($footer_color) . ';';
    echo '--semantic-font-family:' . esc_attr($font_family) . ';';
    if ($logo) {
        echo '--semantic-logo:url(' . esc_url($logo) . ');';
    }
    if ($bg_image) {
        echo '--semantic-bg-image:url(' . esc_url($bg_image) . ');';
    }
    echo '}</style>';

    if ($bg_image && $bg_area !== 'none') {
        echo '<style>';
        if ($bg_area === 'body') {
            echo 'body{background-image:var(--semantic-bg-image);background-size:cover;background-repeat:no-repeat;}';
        }
        if ($bg_area === 'header') {
            echo '.site-header{background-image:var(--semantic-bg-image);background-size:cover;}';
        }
        if ($bg_area === 'footer') {
            echo '.site-footer{background-image:var(--semantic-bg-image);background-size:cover;}';
        }
        echo '</style>';
    }
}
add_action('wp_head', 'semantic_wp_customizer_css');
function semantic_wp_background_presets() {
    return [
        'abstract' => [
            'label' => __('Abstracto', 'semantic-wp'),
            'image' => get_template_directory_uri() . '/assets/bg-abstract.jpg',
        ],
        'nature' => [
            'label' => __('Naturaleza', 'semantic-wp'),
            'image' => get_template_directory_uri() . '/assets/bg-nature.jpg',
        ],
        'dark' => [
            'label' => __('Oscuro', 'semantic-wp'),
            'image' => get_template_directory_uri() . '/assets/bg-dark.jpg',
        ],
    ];
}

function semantic_wp_background_data() {
    wp_localize_script(
        'semantic-wp-backgrounds',
        'SemanticWPBackgrounds',
        [
            'allowed' => get_theme_mod('semantic_wp_allow_user_background'),
            'presets' => semantic_wp_background_presets(),
        ]
    );
}
add_action('wp_enqueue_scripts', 'semantic_wp_background_data');
function semantic_wp_posts_per_page($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_archive()) {
        $query->set('posts_per_page', 9);
    }
}
add_action('pre_get_posts', 'semantic_wp_posts_per_page');
