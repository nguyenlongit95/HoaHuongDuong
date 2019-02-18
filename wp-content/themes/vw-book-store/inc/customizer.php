<?php
/**
 * VW Book Store Theme Customizer
 *
 * @package VW Book Store
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_book_store_customize_register( $wp_customize ) {

	//add home page setting pannel
	$wp_customize->add_panel( 'vw_book_store_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'VW Settings', 'vw-book-store' ),
	    'description' => __( 'Description of what this panel does.', 'vw-book-store' ),
	) );

	$wp_customize->add_section( 'vw_book_store_left_right', array(
    	'title'      => __( 'General Settings', 'vw-book-store' ),
		'priority'   => 30,
		'panel' => 'vw_book_store_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('vw_book_store_theme_options',array(
        'default' => __('Right Sidebar','vw-book-store'),
        'sanitize_callback' => 'vw_book_store_sanitize_choices'	        
	));
	$wp_customize->add_control('vw_book_store_theme_options',array(
        'type' => 'radio',
        'label' => __('Do you want this section','vw-book-store'),
        'section' => 'vw_book_store_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-book-store'),
            'Right Sidebar' => __('Right Sidebar','vw-book-store'),
            'One Column' => __('One Column','vw-book-store'),
            'Three Columns' => __('Three Columns','vw-book-store'),
            'Four Columns' => __('Four Columns','vw-book-store'),
            'Grid Layout' => __('Grid Layout','vw-book-store')
        ),
	) );

	//Topbar
	$wp_customize->add_section('vw_book_store_topbar',array(
		'title'	=> __('Topbar','vw-book-store'),
		'description'=> __('This section will appear in the Topbar','vw-book-store'),
		'panel' => 'vw_book_store_panel_id',
	));	
	
	$wp_customize->add_setting('vw_book_store_my_account_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_book_store_my_account_text',array(
		'label'	=> __('My Account Text','vw-book-store'),
		'section'=> 'vw_book_store_topbar',
		'setting'=> 'vw_book_store_my_account_text',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_book_store_my_account_link',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('vw_book_store_my_account_link',array(
		'label'	=> __('My Account Link','vw-book-store'),
		'section'=> 'vw_book_store_topbar',
		'setting'=> 'vw_book_store_my_account_link',
		'type'=> 'url'
	));

	$wp_customize->add_setting('vw_book_store_help_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_book_store_help_text',array(
		'label'	=> __('Help Text','vw-book-store'),
		'section'=> 'vw_book_store_topbar',
		'setting'=> 'vw_book_store_help_text',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_book_store_help_link',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('vw_book_store_help_link',array(
		'label'	=> __('Help Link','vw-book-store'),
		'section'=> 'vw_book_store_topbar',
		'setting'=> 'vw_book_store_help_link',
		'type'=> 'url'
	));

	$wp_customize->add_setting('vw_book_store_email',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_book_store_email',array(
		'label'	=> __('Add Email Address','vw-book-store'),
		'section'=> 'vw_book_store_topbar',
		'setting'=> 'vw_book_store_email',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_book_store_cart_link',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('vw_book_store_cart_link',array(
		'label'	=> __('Add Cart page url','vw-book-store'),
		'section'=> 'vw_book_store_topbar',
		'setting'=> 'vw_book_store_cart_link',
		'type'=> 'url'
	));
    
	//Slider
	$wp_customize->add_section( 'vw_book_store_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'vw-book-store' ),
		'priority'   => null,
		'panel' => 'vw_book_store_panel_id'
	) );

	for ( $count = 1; $count <= 4; $count++ ) {

		// Add color scheme setting and control.
		$wp_customize->add_setting( 'vw_book_store_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vw_book_store_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'vw_book_store_slider_page' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'vw-book-store' ),
			'description' => __('Slider image size (1500 x 600)','vw-book-store'),
			'section'  => 'vw_book_store_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	//Book Store
	$wp_customize->add_section( 'vw_book_store_book_store' , array(
    	'title'      => __( 'Trending Products', 'vw-book-store' ),
		'priority'   => null,
		'panel' => 'vw_book_store_panel_id'
	) );

	for ( $count = 0; $count <= 0; $count++ ) {

		$wp_customize->add_setting( 'vw_book_shop_product_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vw_book_store_sanitize_dropdown_pages'
		));
		$wp_customize->add_control( 'vw_book_shop_product_page' . $count, array(
			'label'    => __( 'Select Page', 'vw-book-store' ),
			'section'  => 'vw_book_store_book_store',
			'type'     => 'dropdown-pages'
		));
	}
	
	//Footer Text
	$wp_customize->add_section('vw_book_store_footer',array(
		'title'	=> __('Footer','vw-book-store'),
		'description'=> __('This section will appear in the footer','vw-book-store'),
		'panel' => 'vw_book_store_panel_id',
	));	
	
	$wp_customize->add_setting('vw_book_store_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_book_store_footer_text',array(
		'label'	=> __('Copyright Text','vw-book-store'),
		'section'=> 'vw_book_store_footer',
		'setting'=> 'vw_book_store_footer_text',
		'type'=> 'text'
	));	
}

add_action( 'customize_register', 'vw_book_store_customize_register' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class VW_Book_Store_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'VW_Book_Store_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new VW_Book_Store_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'Book Store Pro', 'vw-book-store' ),
					'pro_text' => esc_html__( 'Upgrade Pro', 'vw-book-store' ),
					'pro_url'  => esc_url('https://www.vwthemes.com/themes/bookstore-wordpress-theme/'),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-book-store-customize-controls', trailingslashit( get_template_directory_uri() ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-book-store-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
VW_Book_Store_Customize::get_instance();