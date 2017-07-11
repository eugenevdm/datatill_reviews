<?php

function retrieve( $sql ) {
	$db_host     = get_option( "datatill_reviews_db_host" );
	$db_name     = get_option( "datatill_reviews_db_name" );
	$db_username = get_option( "datatill_reviews_db_username" );
	$db_password = get_option( "datatill_reviews_db_password" );
	$wpdb        = new wpdb( $db_username, $db_password, $db_name, $db_host );

	return $wpdb->get_results( $sql );
}
