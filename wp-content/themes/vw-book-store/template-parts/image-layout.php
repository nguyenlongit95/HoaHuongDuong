<?php
/**
 * The template part for displaying Image Layout
 *
 * @package VW Book Store
 * @subpackage vw-book-store
 * @since VW Book Store 1.0
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
    <div class="entry-content">
        <h1><?php the_title();?></h1>    
        <div class="entry-attachment">
            <div class="attachment">
                <?php vw_book_store_the_attached_image(); ?>
            </div>

            <?php if ( has_excerpt() ) : ?>
                <div class="entry-caption">
                    <?php the_excerpt(); ?>
                </div>
            <?php endif; ?>
        </div>    
        <?php
            the_content();
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'vw-book-store' ),
                'after'  => '</div>',
            ) );
        ?>
    </div>    
    <?php edit_post_link( __( 'Edit', 'vw-book-store' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
    <div class="clearfix"></div>
</div>