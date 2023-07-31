<?php
/**
 * Plugin Name: Bootstrap to WordPress plugin
 * Desciption: Custom Elementor widget for wordpress course
 * Vesrion: 1.0.0
 * Author: Zhan M
 * Author URI: https://zhan883.kz
 * Text Domain: plugin-b2w
 * 
 */
function register_new_widgets( $widgets_manager ) {

    require_once( __DIR__ . '/widgets/class-buttons.php' );
    

    $widgets_manager->register( new \B2w_Buttons_Widget() );
    

}

 

add_action( 'elementor/widgets/register', 'register_new_widgets' );


 if(! defined('ABSPATH')){
    exit;
 }
 $plugin_images = plugin_dir_url( __FILE__ ) .'assets/images';

 final class B2W_Elementor_Extension{
    const MINIMUM_ELEMENTOR_VERSION = '3.2.0';
    const MINIMUM_PHP_VERSION = '7.0';
    /**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var \Elementor_Test_Addon\Plugin The single instance of the class.
	 */
    private static $_instance = null;
    public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

    public function __construct() {

		if ( $this->is_compatible() ) {
			add_action( 'elementor/init', [ $this, 'init' ] );
            
		}

	}

 
    

    public function i18n(){
        load_textdomain( 'plugin-b2w');
    }

    public function is_compatible() {

		// Check if Elementor is installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
		}

		return true;

	}

    public function init() {

		$this->i18n();
        add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'frontend_styles' ] );
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'frontend_scripts' ] );
        add_action( 'elementor/widgets/register', 'register_new_widgets' );

	}

    public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'plugin-b2w' ),
			'<strong>' . esc_html__( 'Bootstrap to WordPress plugin', 'plugin-b2w' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'plugin-b2w' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}
    public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'plugin-b2w' ),
			'<strong>' . esc_html__( 'Bootstrap to WordPress plugin', 'plugin-b2w' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'plugin-b2w' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}



    public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'plugin-b2w' ),
			'<strong>' . esc_html__( 'Bootstrap to WordPress plugin', 'plugin-b2w' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'plugin-b2w' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

    
    
    

    
 }


