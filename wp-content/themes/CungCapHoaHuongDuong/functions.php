<?php 
	/*
		* Thiet lap cac hang du lieu quan trong
		* Chèn file init.php de cau hinh ban dau cho website 
		* Thiet lap chieu rong noi dung
	*/
		// define('CORE', THEME_URL . "/core");
	
		// require_once(CORE . 'init.php'); // lay duong dan thu muc core

		// if(!isset($content_width)){
		// 	$content_width = 620;
		// }
?>

<?php 
	
	/**
	* Khai bao chuc nang cua theme
	**/

	/*---------------Custom imagesize-------------------*/
	/*
	* tham so 1: ten cua size
	* tham so 2: kick co cua hinh 
	* tham so 3: mac dinh la false, neu chon true thi se crop hinh cho dung kich co da khai bao
	*/
	function custom_image_sizes() { 
    	add_theme_support('post-thumbnails'); 
	    add_image_size('banner', 960, 355, true); 
	    add_image_size('thumb', 120, 120, true); 
	    add_image_size('widget', 170, 400, false); 
	} 
	add_action('after_setup_theme', 'custom_image_sizes');
	/*
	* Goi ham o noi can goi: <?php the_post_thumbnail( 'thumb' ); ?>
	*/
	/*--------------End Custom images size--------------*/

	if (!function_exists('LongNguyen_theme_setup')) {
		function LongNguyen_theme_setup(){

		// Tu dong them link RSS tren phan <head>
			add_theme_support("automatic-feed-links");
		// --------------------------------------

		// Them hinh dai dien cho bai viet (post-thumnail)
			add_theme_support("post-thumbnails");
		//-----------------------------------------------

		// Them post fomat cho bai viet
			add_theme_support(
				'post-formats' , array( 
				'image',
				'video',
				'gallery', 
				'qoute',
				'link'
				)
			);
		//------------------------------------------------

		// them title tag. Khong van them ham wp_title trong header.php
			add_theme_support('title-tag');
		// -----------------------------------------------

		// Them chuc nang customs background cho bai viet
			$default_background = array(
				'default-color' => '#e8e8e8', 
			);
			add_theme_support('custom-background', $default_background);
		//-----------------------------------------------

		// Tao menu cho theme ***************************************
			register_nav_menu( 'primary-menu', __( 'primary menu', 'LongNguyen' ) );
			register_nav_menu( 'menu2', __( 'menu 2', 'LongNguyen' ) );
			
			/**
			*****************thiet lap menu********************
			**/
			/*****************Menu header*********************/
			if (!function_exists('LongNguyen_menu')) {
				
				function LongNguyen_menu($menu){
					$menu = array(
						'theme_location' => $menu, 
						'container' => 'nav',
						'container_class' => $menu
					);
					wp_nav_menu($menu);
				}
			}
			/*******************Menu footer******************/
			if (!function_exists('menu_footer')) {
				# code...
				function menu_footer($menu_footer){
					$menu_footer = array(
						'theme_location' => $menu_footer,
						'container' => 'nav',
						'container_class' => $menu_footer
					);
					wp_nav_menu($menu_footer);
				}
			}
			register_nav_menu( 'footer', __( 'Footer', 'LongNguyen' ) );
			/**
			***************Ket thuc thiet lap menu************
			**/

		// Su dung nav menus, co nhieu loai menu do minh tu dinh nghia
		    // register_nav_menus(array(
		    //     'primary_menu'    => __('Menu top', 'LongNguyen'), // menu header
		    //     'menu_main' => __('Menu main', 'LongNguyen'), // menu ben sidebar
		    //     'menu_footer' => __('Menu footer', 'LongNguyen'), // menu footer
		    // ));
		// ----------------------------------------------------------

		// Tao sidebar cho website **********************************
			$sidebar = array(
				'name' => __('Main sidebar' , 'LongNguyen'),
				'id' => 'main-sidebar',
				'description' => 'Main sidebar for web',
				'class' => 'main-sidebar', // class dung de viet CSS
				'before_title' => '<h3 class="widget-title">', // tieu de cua sidebar duoc dat trong the h3 
				'after_title' => '</h3>'
			);
			register_sidebar($sidebar);
		// ----------------------------------------------------------
		}
		add_action('init', 'LongNguyen_theme_setup');
	}


	
	/**
	**********Thiet lap tuy bien cho comment**********
	**/
	function LongNguyen_comment($comment,$args,$depth){
		$GLOBAL['comment'] = $comment;
		?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_id(); ?>"></li>
			<div id="comment-<?php comment_id(); ?>" class="clearfix">
				<div class="author-vcard">
					<?php echo get_avatar($comment,$size='80', $default='<path_to_url'); ?>
					<?php printf(__('<p class="fn">%s</p>'),get_commnt_author_link()); ?>
					<?php if($comment->comment_approved=='0'): ?>
						<em><?php echo 'You are comment waiting for modertion'; ?></em>
					<?php endif; ?>
					<p class="meta-data">
						<?php printf(get_comment_date(),edit_comment_link('Edit'),'',''); ?>
					</p>
				</div>
				<div id="comment-body">
					<p><?php comment_text(); ?></p>
					<p class="reply"><?php comment_reply_link();?></p>
				</div>
			</div>
		<?php
	}
	/**
	***************End custom comment*****************
	**/


	/*---------------Begin show_thumbnail-------------*/
	function LongNguyen_show_thumbnail($option = '', $css = '', $hasLink = true, $file_none_thumb = ''){
	    if(empty($option)) $option = 'thumbnail';
	    if(empty($css)) $css = 'LongNguyen-thumbnail';
	    if(empty($file_none_thumb)) $file_none_thumb = 'default-thumbnail.jpg';

	    if ( has_post_thumbnail() )
	    {
	        if($hasLink)
	            echo '<a href="'. get_the_permalink() . '" title="' . get_the_title() . '">';
	        the_post_thumbnail( $option, array('class' => $css));
	        if($hasLink)
	            echo "</a>";
	    }
	    else
	    {
	        if($hasLink)
	            echo '<a href="'. get_the_permalink() . '" title="' . get_the_title() . '">';
	        echo '<img src="' .  get_template_directory_uri() . '/images/' . $file_none_thumb . '" class="' . $css . '" alt="' . get_the_title() .'"/>';
	        if($hasLink)
	            echo "</a>";
	    }
	}
	/*--------------End show_thumbail-----------------*/

	/*----------------Lay so luot nguoi xem cua bai viet--------------------*/
	function getPostViews($postID) // hàm này dùng để lấy số người đã xem qua bài viết
	{
	    $count_key = 'post_views_count';
	    $count     = get_post_meta($postID, $count_key, true);
	    if ($count == '') { // Nếu như lượt xem không có
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '0');
	        return "0"; // giá trị trả về bằng 0
	    }
	    return $count; // Trả về giá trị lượt xem
	}
	function setPostViews($postID) // hàm này dùng để set và update số lượt người xem bài viết.
	{
	    $count_key = 'post_views_count';
	    $count     = get_post_meta($postID, $count_key, true);
	    if ($count == '') {
	        $count = 0;
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '0');
	    } else {
	        $count++; // cộng đồn view
	        update_post_meta($postID, $count_key, $count); // update count
	    }
	}
	/*------------------------End check view--------------------------------*/


	//Gioi han so luong ky tu cua bai viet
	function string_limit_words($string, $word_limit)
	{
	    $words = explode(' ', $string, ($word_limit + 1));
	     
	    if (count($words) > $word_limit) {
	        array_pop($words);
	    }
	     
	    return implode(' ', $words);
	}

	// lay ham gioi han bai viet o trang bai viet
	// echo string_limit_words(get_the_excerpt(), 20);
	// End limit word

	// hay dấu [...]cuối excerpt bằng dấu >>
	function LongNguyen_excerpt_more($more)
	{
	    global $post;
	    $more_link = '<a href="' . get_permalink($post->ID) . '">&raquo;</a>';
	    remove_filter('the_excerpt', 'wpautop');
	    return '...' . $more_link;
	}
	add_filter('excerpt_more', 'LongNguyen_excerpt_more');

	// đổi class style curent_item sang active trong hàm wp_nav_menu()
	function LongNguyen_current_to_active_item($text){
	    $replace = array(
	        // List of classes to replace with "active"
	        'current_page_item' => 'active',
	        'current_page_parent' => 'active',
	        'current_page_ancestor' => 'active',
	        'current-menu-item' => 'active',
	        'current-menu-parent' => 'active',
	        'menu-item-has-children' => 'menu-item-has-children dropdown dropdown-icon'
	    );
	    $text = str_replace(array_keys($replace), $replace, $text);
	        return $text;
	    }
	add_filter ('wp_nav_menu','LongNguyen_current_to_active_item');

	// hàm cắt chuỗi excerpt
	function LongNguyen_show_excerpt($limit, $show_more = true)
	{
	    global $post;

	    $excerpt = get_the_excerpt();

	    $page_excerpt = get_field('page_excerpt');
	    if($page_excerpt != '')
	        $excerpt = $page_excerpt;

	    $arr_words = explode(" ", $excerpt);
	    $str_excerpt = '';
	    for ($i = 0; $i <= $limit; ++$i) {
	        $str_excerpt = $str_excerpt . ' ' . $arr_words[$i];
	    }

	    // show more view
	    if($show_more)
	    {
	        $more_link = '<a href="' . get_permalink($post->ID) . '">&raquo;</a>';
	        $str_excerpt = $str_excerpt . '...' . $more_link;
	    }

	    echo $str_excerpt;
	}


	//  hiển thị breadcrumb
	function LongNguyen_show_breadcrumbs()
	{
	    /* === OPTIONS === */
	    $text['home'] = 'Trang chủ'; // text for the 'Home' link
	    $text['category'] = '%s'; // text for a category page
	    $text['search'] = 'Nội dung tìm kiếm "%s"'; // text for a search results page
	    $text['tag'] = 'Chủ đề "%s"'; // text for a tag page
	    $text['author'] = 'Tác giả %s'; // text for an author page
	    $text['404'] = 'Không tìm thấy trang'; // text for the 404 page

	    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	    $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	    $delimiter = ''; // delimiter between crumbs
	    $before = '<li class="active">'; // tag before the current crumb
	    $after = '</li>'; // tag after the current crumb
	    /* === END OF OPTIONS === */

	    global $post;
	    $homeLink = get_bloginfo('url');
	    $linkBefore = '<li>';
	    $linkAfter = '</li>';
	    $linkAttr = '';
	    $link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

	    if (is_home() || is_front_page()) {

	        if ($showOnHome == 1) echo '<a class="home" href="' . $homeLink . '">' . $text['home'] . '</a>';

	    } else {

	        echo sprintf($link, $homeLink, $text['home']) . $delimiter;
	        if (is_category()) {
	            $thisCat = get_category(get_query_var('cat'), false);
	            if ($thisCat->parent != 0) {
	                $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
	                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
	                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
	                echo $cats;
	            }
	            echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

	        } elseif(is_tax() ){
	            $taxonomy = get_query_var( 'taxonomy' );
	            $term = get_term_by( 'slug', get_query_var( 'term' ), $taxonomy);

	            //$tag = single_tag_title('', false);
	            //$tag_id = get_tag_id($tag);
	            $link_tax = tonphong_get_term_parents($term->term_id, $term->term_id , $taxonomy);
	            echo $link_tax;
	            //echo $before . $link_tax . $after;

	        } elseif (is_search()) {
	            echo $before . sprintf($text['search'], get_search_query()) . $after;

	        } elseif (is_day()) {
	            /*
	            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
	            echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F')) . $delimiter;
	            echo $before . get_the_time('d') . $after;
	            */

	        } elseif (is_month()) {
	            /*
	            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
	            echo $before . get_the_time('F') . $after;
	            */

	        } elseif (is_year()) {
	            /*
	            echo $before . get_the_time('Y') . $after;
	            */

	        } elseif (is_single() && !is_attachment()) {
	            // Custom post
	            if (get_post_type() != 'post') {
	                // get post type by post
	                $post_type = $post->post_type;

	                // get post type taxonomies
	                $taxonomies = get_object_taxonomies( $post_type, 'objects' );
	                //$terms = get_the_term_list( $post->ID, $taxonomies[0], '', '*', '' );
	                //$arr_term = explode("*", $terms);
	                //echo $before . $arr_term[0] . $after;

	                $out = array();
	                foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){
	                    // get the terms related to post
	                    $terms = get_the_terms( $post->ID, $taxonomy_slug );
	                    if ( !empty( $terms ) ) {
	                      foreach ( $terms as $term ) {
	                        if($term->taxonomy != 'post_tag')
	                        {
	                            $out[] =
	                              '  <li><a href="'
	                            .    get_term_link( $term->slug, $taxonomy_slug ) .'">'
	                            .    $term->name
	                            . "</a></li>";
	                        }
	                      }
	                      $out[] = "";
	                    }
	                }

	                echo implode('', $out );

            	if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
	            } else {
	                $cat = get_the_category();
	                $cat = $cat[0];
	                $cats = get_category_parents($cat, TRUE, $delimiter);
	                if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
	                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
	                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
	                echo $cats;
	                if ($showCurrent == 1) echo $before . get_the_title() . $after;
	            }

	        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
	            /*
	            $post_type = get_post_type_object(get_post_type());
	            echo $before . $post_type->labels->singular_name . $after;
	            */

	        } elseif (is_attachment()) {
	            $parent = get_post($post->post_parent);
	            $cat = get_the_category($parent->ID);
	            $cat = $cat[0];
	            $cats = get_category_parents($cat, TRUE, $delimiter);

	            if ( !is_wp_error( $cats ) ) {
	                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
	                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
	            }
	            else
	                $cats = '';


	            echo $cats;
	            printf($link, get_permalink($parent), $parent->post_title);
	            if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

	        } elseif (is_page() && !$post->post_parent) {
	            if ($showCurrent == 1) echo $before . get_the_title() . $after;

	        } elseif (is_page() && $post->post_parent) {
	            $parent_id = $post->post_parent;
	            $breadcrumbs = array();
	            while ($parent_id) {
	                $page = get_page($parent_id);
	                $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
	                $parent_id = $page->post_parent;
	            }
	            $breadcrumbs = array_reverse($breadcrumbs);
	            for ($i = 0; $i < count($breadcrumbs); $i++) {
	                echo $breadcrumbs[$i];
	                if ($i != count($breadcrumbs) - 1) echo $delimiter;
	            }
	            if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

	        } elseif (is_tag()) {
	            echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

	        } elseif (is_author()) {
	            global $author;
	            $userdata = get_userdata($author);
	            echo $before . sprintf($text['author'], $userdata->display_name) . $after;

	        } elseif (is_404()) {
	            echo $before . $text['404'] . $after;

	        }

	        if (get_query_var('paged')) {
	            //if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ' (';
	            echo __(' (trang') . ' ' . get_query_var('paged') . ')';
	            //if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ')';
	        }
	    }
	}

	// hiển thị phân trang
	function LongNguyen_show_pagination($pages = '', $range = 5)
	{
	    $showitems = ($range * 2) + 1;

	    global $paged;
	    if (empty($paged)) $paged = 1;

	    if ($pages == '') {
	        global $wp_query;
	        $pages = $wp_query->max_num_pages;
	        if (!$pages) {
	            $pages = 1;
	        }
	    }

	    if (1 != $pages) {
	        echo "<ul class=\"pagination pagination-sm\">";
	        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) echo "<li class=\"prev\"><a aria-label=\"Previous\" href='" . get_pagenum_link(1) . "'>&laquo;</a></li>";
	        if ($paged > 1 && $showitems < $pages) echo "<li><a href='" . get_pagenum_link($paged - 1) . "'>&lsaquo;</a></li>";

	        for ($i = 1; $i <= $pages; $i++) {
	            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
	                echo ($paged == $i) ? "<li class=\"active\"><a href=\"#\">" . $i . "<span class=\"sr-only\">(current)</span></a></li>" : "<li><a href='" . get_pagenum_link($i) . "'>" . $i . "</a></li>";
	            }
	        }

	        if ($paged < $pages && $showitems < $pages) echo "<li class=\"next\"><a href='" . get_pagenum_link($paged + 1) . "'>&rsaquo;</a></li>";
	        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) echo "<li class=\"next\"><a aria-label=\"Next\" href='" . get_pagenum_link($pages) . "'>&raquo;</a></li>";
	        echo "</ul>\n";
	    }
	}

	// ham hien thi link hinh anh
	function LongNguyen_show_full_path_image($file_none_thumb = '')
	{
	    if(empty($file_none_thumb)) $file_none_thumb = 'default-thumbnail.jpg';

	    if ( has_post_thumbnail() ) {
	        $full_path_img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
	        echo $full_path_img[0];
	    }
	    else
	        echo get_template_directory_uri() . '/images/' . $file_none_thumb;
	}

	// hien thi hinh anh slides su dung meta slides
	function LongNguyen_get_slides($slider_id)
	{
	    $args = array(
	        'force_no_custom_order' => true,
	        'orderby' => 'menu_order',
	        'order' => 'ASC',
	        'post_type' => 'attachment',
	        'post_status' => 'inherit',
	        'lang' => '', // polylang, ingore language filter
	        'suppress_filters' => 1, // wpml, ignore language filter
	        'posts_per_page' => -1,
	        'tax_query' => array(
	            array(
	                'taxonomy' => 'ml-slider',
	                'field' => 'slug',
	                'terms' => $slider_id
	            )
	        )
	    );
	    $settings = get_post_meta( $post->ID, 'ml-slider_settings', true );
	    $args = apply_filters( 'metaslider_populate_slides_args', $args, $slider_id, $settings );
	    $query = new WP_Query( $args );

	    $slides = array();
	    while ( $query->have_posts() ) {
	        $query->next_post();

	        $slide_id = $query->post->ID;
	        $meta = wp_get_attachment_metadata( $slide_id );
	        $src = esc_url(home_url()) .'/wp-content/uploads/'. $upload_dir['baseurl'] . $meta['file'];//get_post_meta( $query->post->ID, '_wp_attached_file', true );

	        if ( isset( $meta['width'], $meta['height'] ) ) {
	            $slide = array();
	            $slide['width'] = $meta['width'];
	            $slide['height'] = $meta['height'];
	            $slide['src'] = $src;
	            $slide['title'] = __( get_post_meta( $slide_id, 'ml-slider_title', true ) );
	            $slide['url'] = get_post_meta( $slide_id, 'ml-slider_url', true );
	            $slide['target'] = get_post_meta( $slide_id, 'ml-slider_new_window', true ) ? '_blank' : '_self';
	            $slide['alt'] = __( get_post_meta( $slide_id, '_wp_attachment_image_alt', true ) );
	            $slide['caption'] = __( html_entity_decode( do_shortcode( $query->post->post_excerpt ), ENT_NOQUOTES, 'UTF-8' ) );
	            array_push($slides,$slide);
	        }
	    }

	    return $slides;
	}

	// ham hien thi advanced custom feild 
	function LongNguyen_show_field($field_name = '', $is_home = false)
	{
	    global $home_id;
	    if($field_name != '' && $is_home)
	        echo the_field($field_name, $home_id);
	    else
	        echo the_field($field_name);
	}

	// ham cat so luong ky tu trong van ban
	function LongNguyen_show_text_trim($text, $word_count = 0)
	{

	    $arr_words = explode(" ", $text);
	    $str_trim = '';
	    for ($i = 0; $i <= $word_count; ++$i) {
	        $str_trim = $str_trim . ' ' . $arr_words[$i];
	    }
	    $str_trim = $str_trim . ' ...';

	    echo $str_trim;
	}


	// gioi han chieu dai cho video youtube
	function LongNguyen_limit_width($matches) {
    $max = 700;
    $width = $matches[1];
    if(is_numeric($width) && ($width > $max)) {
        $width = $max;
    }
    return 'width="' . strval($width) . '"';
	}
	 
	function LongNguyen_change_embed_width($content) {
	    $pattern = '(width=[\'\"](\d+)[\'\"])';
	    if(false !== strpos($content, 'youtube')) {
	        $content = preg_replace_callback($pattern, LongNguyen_limit_width, $content);
	    }
	    return $content;
	}
	add_filter('embed_oembed_html', 'LongNguyen_change_embed_width');


	// hien thi thanh Widget bang ham
	the_widget('WP_Widget_Search');
 
	if(function_exists('the_widget')) {
	    $rss_options = array(
	        'title' => 'RSS Title',  // Title of the Widget
	        'url' => 'http://codepeach.com/feed/', // URL of the RSS Feed
	        'items' => 10, // Number of items to be displayed
	        'show_summary' => 1, // Show post excerpts?
	        'show_author' => 1, // Set 1 to display post author
	        'show_date' => 1 // Set 1 to display post dates
	    );
	    the_widget('WP_Widget_RSS', $rss_options);
	}


	// $image_url = wp_get_attachment_image_src( $banner_ids[$rand], 'image_size_banner' );

	// ham thay doi kich co anh
	function display_custom_image_sizes( $sizes ) { 
	  	global $_wp_additional_image_sizes;   
	  	if ( empty($_wp_additional_image_sizes) )    
	   	return $sizes;   
		foreach ( $_wp_additional_image_sizes as $id => $data ) {
		     if ( !isset($sizes[$id]) )      
		      $sizes[$id] = ucfirst( str_replace( '-', ' ', $id ) );   
		}   
		return $sizes; 
	} 
	add_filter( 'image_size_names_choose', 'display_custom_image_sizes' );

?>