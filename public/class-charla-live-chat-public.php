<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://getcharla.com
 * @since      1.0.0
 *
 * @package    Charla_Live_Chat
 * @subpackage Charla_Live_Chat/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Charla_Live_Chat
 * @subpackage Charla_Live_Chat/public
 * @author     Yehia A.Salam <yehia.asalam@gmail.com>
 */
class Charla_Live_Chat_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Charla_Live_Chat_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Charla_Live_Chat_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/charla-live-chat-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Charla_Live_Chat_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Charla_Live_Chat_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		$charla_params = array(
			'property_key' => get_option('charla_property_key_setting'),
			'customer' => $this->get_customer(),
			'cart' => $this->get_cart()
		);

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/charla-live-chat-public.js', array( 'jquery' ), $this->version, false );
		
		//@todo Use wp_add_inline_script instead per https://developer.wordpress.org/reference/functions/wp_localize_script/ guidelines
		wp_localize_script( $this->plugin_name, 'charla_params', $charla_params );

	}

	public function get_customer() {

		// Check if Woocommerce is installed
		if( !function_exists( 'WC' ) || !is_object( WC() ) || !is_a( WC(), 'WooCommerce' ) ){
			return array( 'id' => 0, 'email' =>  '');
		}

		if (WC()->customer == null) {
			return array( 'id' => 0, 'email' =>  '');
		}

		if (WC()->customer->get_email() == null) {
			return array( 'id' => 0, 'email' =>  '');
		}

		$customer_data = array(
			'id' => WC()->customer->get_id(),
			'email' =>  WC()->customer->get_email()
		);

		return $customer_data;

	}

	public function get_cart() {

		// Check if Woocommerce is installed
		if( !function_exists( 'WC' ) || !is_object( WC() ) || !is_a( WC(), 'WooCommerce' ) ){
			return array();
		}

		$cart_data = (object) array();

		if (WC()->cart != null && !WC()->cart->is_empty()) {
			$cart =  WC()->cart->get_cart();
			$cart_items = array();

			foreach ( $cart as $cart_item_key => $cart_item ) {
				$product = $cart_item['data'];

				$item = (object) $product->get_data();

				$product_image = wp_get_attachment_image_src($product->get_image_id());
				$permalink = $product->get_permalink();
				$quantity = $cart_item['quantity'];

				if ($product_image) {
					$image = (object) array(
						'id' => $product->get_image_id(),
						'source' => $product_image[0]
					);

					$item->image = $image;
				}

				if ($permalink) {
					$item->permalink = $permalink;
				}

				if ($quantity) {
					$item->quantity = $quantity;
				}

				array_push($cart_items, $item);
			}

			$cart_data = (object) array(
				'base_url' => get_site_url(),
				'totals' => WC()->cart->get_totals(),
				'currency' => get_woocommerce_currency(),
				'items' => $cart_items,
			);
		}

		return $cart_data;
	}

	/**
	 * Enqueue Async script
	 */
	public function enqueue_async( $tag, $handle) {
		if ( $this->plugin_name !== $handle ) {
			return $tag;
		}

		return str_replace('src', 'defer src', $tag );
	}


}
