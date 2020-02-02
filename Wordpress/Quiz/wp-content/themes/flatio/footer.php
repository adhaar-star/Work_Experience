        <?php if ( !is_front_page() and !is_page_template('page-homepage.php')) : ?>

        <footer id="footer-copyright">
            <a id="back_to_top" href="#"><i class="fa fa-angle-double-up"></i></a>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div id="copyright-center">
                           	<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'flatio' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'flatio' ), 'WordPress' ); ?></a>
							<span class="sep"> | </span>
							<a href="<?php echo esc_url( __( 'http://theme77.com/flatio-demo/', 'flatio' ) ); ?>"><?php printf( __( 'Flatio Theme by %s', 'flatio' ), 'Theme77.com' ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <?php endif; ?>

        </div>
        </div> <!-- /wapper -->

        <?php wp_footer(); ?>

    </body>
</html>
