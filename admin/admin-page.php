<?php

/**
 * Add Option to settings menu for WP Crawler
 *
 * @return void
 */
function wp_rocket_crawler_admin_page() {
	add_options_page( 'SEO Crawler', 'SEO Crawler', 'manage_options', 'seo-crawler', 'wp_rocket_crawler_page_content' );
}
add_action( 'admin_menu', 'wp_rocket_crawler_admin_page' );


/**
 * Display the WP Crawler Settings page to trigger crawler manually
 *
 * @return void
 */
function wp_rocket_crawler_page_content() {
	if ( isset( $_POST['start_crawl'] ) ) {
		WP_ROCKET_SEO_Crawler::crawl_homepage();
		WP_ROCKET_SEO_Sitemap::create_sitemap();
		echo '<p>Crawling completed.</p>';
	}

	echo '<form method="post" action="">
            <input type="submit" name="start_crawl" value="Start Crawl">
          </form>';

	// Display the last crawl results.
	$links = WP_ROCKET_SEO_Crawler_Database::get_links();
	if ( ! empty( $links ) ) {
		echo "</br><p>Check <a href='../sitemap.html' target='_blank'>sitemap.html</a></p>";
		echo "<p>Last Home page snapshot. View <a href='../home_page_snapshot.html' target='_blank'>home_page_snapshot.html</a></p>";

		echo '<h3>Last Crawl Results:</h3>';
		echo '<ul>';
		foreach ( $links as $link ) {
			echo esc_html_e( "<li><a href='{$link->url}'>{$link->url}</a></li>" );
		}
		echo '</ul>';
	}
}
