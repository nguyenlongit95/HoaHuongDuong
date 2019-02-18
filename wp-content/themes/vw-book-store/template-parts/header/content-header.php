<?php
/**
 * The template part for displaying Top header
 *
 * @package VW Book Store 
 * @subpackage vw_book_store
 * @since VW Book Store 1.0
 */
?>

<div class="top-bar">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <div class="row">
          <div class="col-md-3">
            <?php if ( get_theme_mod('vw_book_store_my_account_text','') != "" ) {?>
              <i class="fas fa-user"></i><a href="<?php echo esc_url( get_theme_mod('vw_book_store_my_account_link',__('#','vw-book-store')) ); ?>"><?php echo esc_html( get_theme_mod('vw_book_store_my_account_text',__('My Account','vw-book-store')) ); ?></a>
            <?php }?>
          </div>
          <div class="col-md-3">
            <?php if ( get_theme_mod('vw_book_store_help_text','') != "" ) {?>
              <i class="far fa-question-circle"></i><a href="<?php echo esc_url( get_theme_mod('vw_book_store_help_link',__('#','vw-book-store')) ); ?>"><?php echo esc_html( get_theme_mod('vw_book_store_help_text',__('Help','vw-book-store')) ); ?></a>
            <?php }?>
          </div>
          <div class="col-md-6">
            <?php if ( get_theme_mod('vw_book_store_email','') != "" ) {?>
              <i class="far fa-envelope"></i><span><?php echo esc_html( get_theme_mod('vw_book_store_email',__('support@example.com','vw-book-store')) ); ?></span>
            <?php }?>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <?php dynamic_sidebar('social-icon'); ?>
      </div>
    </div>
  </div>
</div>