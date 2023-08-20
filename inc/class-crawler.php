<?php

class WP_ROCKET_SEO_Crawler {

	/**
	 * Crawl the homepage and extract links
	 *
	 * @return void
	 */
	public static function crawl_homepage() {
		global $wp_filesystem;

		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}

		$homepage_content = wp_remote_get( home_url() );

		// Save the home page content to an HTML file.
		$file_path = ABSPATH . '/home_page_snapshot.html';

		$wp_filesystem->put_contents( $file_path, $homepage_content['body'] );

		preg_match_all( '/<a[^>]+href="([^">]+)"[^>]*>/i', $homepage_content['body'], $matches );

		// Delete old links.
		WP_ROCKET_SEO_Crawler_Database::delete_links();

		foreach ( $matches[1] as $url ) {
			if ( strpos( $url, home_url() ) !== false ) {
				WP_ROCKET_SEO_Crawler_Database::insert_link( $url );
			}
		}
	}
}
