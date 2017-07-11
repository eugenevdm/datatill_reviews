<?php

if ( ! class_exists( 'Datatill_Reviews_Settings' ) ) {

	class Datatill_Reviews_Settings {

		public function __construct() {
			add_action( 'admin_menu', array( &$this, 'admin_menu' ) );
			add_action( 'admin_init', array( &$this, 'admin_init' ) );
		}

		public function admin_menu() {
			add_options_page(
				'DataTill Reviews Settings',
				'DataTill Reviews',
				'manage_options',
				'datatill_reviews',
				array( &$this, 'plugin_settings_page' )
			);
		}

		public function admin_init() {

			register_setting( 'datatill_reviews-group', 'datatill_reviews_db_host' );
			register_setting( 'datatill_reviews-group', 'datatill_reviews_db_name' );
			register_setting( 'datatill_reviews-group', 'datatill_reviews_db_username' );
			register_setting( 'datatill_reviews-group', 'datatill_reviews_db_password' );
			register_setting( 'datatill_reviews-group', 'datatill_reviews_minimum_rating' );
			register_setting( 'datatill_reviews-group', 'datatill_reviews_maximum_results' );

			add_settings_section(
				'datatill_reviews-section',
				'DataTill Reviews Widget Settings',
				array( &$this, 'settings_section_datatill_reviews' ),
				'datatill_reviews'
			);

			add_settings_field(
				'datatill_reviews-datatill_reviews_db_host',
				'DataTill Host',
				array( &$this, 'settings_field_input_text' ),
				'datatill_reviews',
				'datatill_reviews-section',
				array(
					'field' => 'datatill_reviews_db_host'
				)
			);

			add_settings_field(
				'datatill_reviews-db_name',
				'Database Name',
				array( &$this, 'settings_field_input_text' ),
				'datatill_reviews',
				'datatill_reviews-section',
				array(
					'field' => 'datatill_reviews_db_name'
				)
			);

			add_settings_field(
				'datatill_reviews-db_username',
				'Database Username',
				array( &$this, 'settings_field_input_text' ),
				'datatill_reviews',
				'datatill_reviews-section',
				array(
					'field' => 'datatill_reviews_db_username'
				)
			);

			add_settings_field(
				'datatill_reviews-db_password',
				'Database Password',
				array( &$this, 'settings_field_input_password' ),
				'datatill_reviews',
				'datatill_reviews-section',
				array(
					'field' => 'datatill_reviews_db_password'
				)
			);

			add_settings_field(
				'datatill_reviews-minimum_rating',
				'Minimum Rating',
				array( &$this, 'settings_field_input_text' ),
				'datatill_reviews',
				'datatill_reviews-section',
				array(
					'field' => 'datatill_reviews_minimum_rating'
				)
			);

			add_settings_field(
				'datatill_reviews_maximum_results',
				'Maximum Results',
				array( &$this, 'settings_field_input_text' ),
				'datatill_reviews',
				'datatill_reviews-section',
				array(
					'field' => 'datatill_reviews_maximum_results'
				)
			);

		}

		public function settings_field_input_text( $args ) {
			$field = $args['field'];
			$value = get_option( $field );
			echo sprintf( '<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value );
		}

		public function settings_field_input_password( $args ) {
			$field = $args['field'];
			$value = get_option( $field );
			echo sprintf( '<input type="password" name="%s" id="%s" value="%s" />', $field, $field, $value );
		}

		public function settings_section_datatill_reviews() {
			echo 'Complete the database connection information to use the widget.';
		}

		public function plugin_settings_page() {
			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
			}
			include( sprintf( "%s/templates/settings.php", dirname( __FILE__ ) ) );
		}

	}
	
}