<?php
/**
 * Template Name: Custom Home
 */

get_header(); ?>

<?php do_action( 'vw_book_store_before_slider' ); ?>

<section id="slider">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
    <?php $pages = array();
      for ( $count = 1; $count <= 3; $count++ ) {
        $mod = intval( get_theme_mod( 'vw_book_store_slider_page' . $count ));
        if ( 'page-none-selected' != $mod ) {
          $pages[] = $mod;
        }
      }
      if( !empty($pages) ) :
        $args = array(
          'post_type' => 'page',
          'post__in' => $pages,
          'orderby' => 'post__in'
        );
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) :
          $i = 1;
    ?>     
    <div class="carousel-inner" role="listbox">
      <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
        <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
          <img src="<?php the_post_thumbnail_url('full'); ?>"/>
          <div class="carousel-caption">
            <div class="inner_carousel">
              <h2><?php the_title(); ?></h2>
              <p><?php the_excerpt(); ?></p>
              <div class="more-btn">              
                <a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','vw-book-store'); ?></a>
              </div>
            </div>
          </div>
        </div>
      <?php $i++; endwhile; 
      wp_reset_postdata();?>
    </div>
    <?php else : ?>
        <div class="no-postfound"></div>
    <?php endif;
    endif;?>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
    </a>
  </div>  
  <div class="clearfix"></div>
</section>

<?php do_action( 'vw_book_store_after_slider' ); ?>

<section id="book-store">
  <div class="container">      
    <?php $pages = array();
    for ( $count = 0; $count <= 0; $count++ ) {
      $mod = absint( get_theme_mod( 'vw_book_shop_product_page' . $count ));
      if ( 'page-none-selected' != $mod ) {
        $pages[] = $mod;
      }
    }
    if( !empty($pages) ) :
      $args = array(
        'post_type' => 'page',
        'post__in' => $pages,
        'orderby' => 'post__in'
      );
      $query = new WP_Query( $args );
      if ( $query->have_posts() ) :
        $count = 0;
        while ( $query->have_posts() ) : $query->the_post(); ?>
          <div class="">
            <h3><?php the_title(); ?></h3>
            <p><?php the_content(); ?></p>
            <div class="clearfix"></div>
          </div>
        <?php $count++; endwhile; ?>
      <?php else : ?>
          <div class="no-postfound"></div>
      <?php endif;
    endif;
    wp_reset_postdata()?>
      <div class="clearfix"></div> 
  </div>
</section>

<?php do_action( 'vw_book_store_after_services' ); ?>

<div id="content-vw">
  <div class="container">
    <?php while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
  </div>
</div>

<?php get_footer(); ?>