</main>

<footer class="site-footer">
    <div class="container footer-inner">

        <p class="copyright">
            &copy;
            <?php echo esc_html( date('Y') ); ?>
            <?php echo esc_html( get_theme_mod( 'semantic_wp_copyright_text', get_bloginfo('name') ) ); ?>
        </p>

        <div class="footer-widgets">
            <?php
            if ( is_active_sidebar( 'footer-widget' ) ) {
                dynamic_sidebar( 'footer-widget' );
            }
            ?>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>



