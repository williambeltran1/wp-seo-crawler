<?php

class WP_ROCKET_SEO_Crawler_Database {

	/**
	 * Create Database table to store links
	 *
	 * @return void
	 */
	public static function create_table() {
		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();
		$table_name      = $wpdb->prefix . 'seo_crawler';

		$sql = "CREATE TABLE $table_name (
            id INT NOT NULL AUTO_INCREMENT,
            url VARCHAR(255) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );
	}

	/**
	 * Insert url entry to database
	 *
	 * @param $url
	 * @return void
	 */
	public static function insert_link( $url ) {
		global $wpdb;
		$table_name = $wpdb->prefix . 'seo_crawler';
		$wpdb->insert( $table_name, [ 'url' => $url ] );
	}

	/**
	 * Return list of links stored in database
	 *
	 * @return array|object|stdClass[]|null
	 */
	public static function get_links() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'seo_crawler';
		return $wpdb->get_results( "SELECT * FROM $table_name" );
	}

	/**
	 * Delete all links from database
	 *
	 * @return void
	 */
	public static function delete_links() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'seo_crawler';
		$wpdb->query( "DELETE FROM $table_name" );
	}
}
