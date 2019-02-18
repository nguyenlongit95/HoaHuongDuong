<?php
/**
 * The template part for displaying Post Content
 *
 * @package VW Book Store 
 * @subpackage vw_book_store
 * @since VW Book Store 1.0
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="post-main-box row">
    <?php 
      if(has_post_thumbnail()) {?>
        <div class="box-image col-md-6">
          <?php the_post_thumbnail(); ?>
        </div>
    <?php } ?>
    <div class="new-text <?php if(has_post_thumbnail()) { ?>col-md-6"<?php } else { ?>col-md-12"<?php } ?>>
      <h3 class="section-title"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title();?></a></h3>
      <div class="post-info">
        <span class="entry-date"><?php the_date(); ?></span><span>|</span>
        <span class="entry-author"> <?php the_author(); ?></span>
        <hr>
      </div>      
      <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_book_store_string_limit_words( $excerpt,20 ) ); ?></p>
      <div class="content-bttn">
        <a href="<?php echo esc_url( get_permalink() );?>" class="blogbutton-small" title="<?php esc_attr_e( 'Read More','vw-book-store' ); ?>"><?php esc_html_e('Read More','vw-book-store'); ?></a>
      </div>
    </div>
  </div>
</div>