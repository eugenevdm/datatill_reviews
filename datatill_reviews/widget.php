<?php

/*
Plugin Name: DataTill Reviews
Plugin URI: https://github.com/eugenevdm/datatill-reviews
Description: A WordPress widget that displays DataTill reviews.
Version: 0.1.0
Author: Eugène van der Merwe
Author URI: http://www.herotel.com/
License: MIT
*/

use Carbon\Carbon;

class Datatill_Reviews_Widget extends WP_Widget {

	function Datatill_Reviews_Widget() {

		require_once( __DIR__ . '/vendor/autoload.php' );
		require_once( 'functions.php' );

		parent::WP_Widget( false, $name = __( 'DataTill Reviews', 'wp_widget_plugin' ) );

		require_once( sprintf( "%s/settings.php", dirname( __FILE__ ) ) );
		( new Datatill_Reviews_Settings );

		$plugin = plugin_basename( __FILE__ );
		add_filter( "plugin_action_links_$plugin", array( $this, 'plugin_settings_link' ) );

	}

	function plugin_settings_link( $links ) {
		$settings_link = '<a href="options-general.php?page=datatill_reviews">Settings</a>';
		array_unshift( $links, $settings_link );

		return $links;
	}

	function widget() {

		$minimum_rating = get_option( "datatill_reviews_minimum_rating" );
		$maximum_results = get_option( "datatill_reviews_maximum_results" );

		$sql = "
          SELECT contact_name, customer_id, rating_date, rating, rating_comment
          FROM ratings
          JOIN customers ON ratings.customer_id = customers.id
          WHERE rating >= $minimum_rating ORDER BY rating_date DESC LIMIT $maximum_results";

		$ratings = retrieve( $sql );
		foreach ( $ratings as $compliment ) {
			$title    = $compliment->contact_name;
			$textarea = $compliment->rating_comment;
			echo '<div class="widget-text wp_widget_plugin_box" style="width:269px; padding:5px 9px 20px 5px; border: 1px solid rgb(231, 15, 52); background: pink; border-radius: 5px; margin: 10px 0 25px 0;">';

			echo '<div class="widget-title" style="width: 90%; height:45px; margin-left:3%; ">';
			echo $title . "<br>";
			echo Carbon::createFromFormat( 'Y-m-d H:i:s', $compliment->rating_date )->diffForHumans();
			echo '</div>';

			echo '<div class="widget-textarea" style="width: 90%; margin-left:3%; padding:8px; background-color: white; border-radius: 3px; min-height: 70px;">';
			echo '<p class="wp_widget_plugin_textarea" style="font-size:15px;">' . $textarea . '</p>';
			echo '</div>';

			echo '</div>';
		}

	}

}

add_action( 'widgets_init', create_function( '', 'return register_widget("Datatill_Reviews_Widget");' ) );
