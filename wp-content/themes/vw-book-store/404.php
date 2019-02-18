<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package VW Book Store
 */

get_header(); ?>

<div id="content-vw">
	<div class="container">
        <div class="page-content">
        	<h1><?php printf( '<strong>%s</strong> %s', esc_html__( '404','vw-book-store' ), esc_html__( 'Not Found', 'vw-book-store' ) ) ?></h1>	
			<p class="text-404"><?php esc_html_e( 'Looks like you have taken a wrong turn&hellip', 'vw-book-store' ); ?></p>
			<p class="text-404"><?php esc_html_e( 'Dont worry&hellip it happens to the best of us.', 'vw-book-store' ); ?></p>
			<div class="error-btn">
        		<a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e( 'Return to the home page', 'vw-book-store' ); ?></a>
			</div>
			<div class="clearfix"></div>
        </div>
	</div>
</div>

<?php get_footer(); ?>