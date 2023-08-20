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
		$nonce = isset( $_POST['seo_crawler_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['seo_crawler_nonce'] ) ) : '';
		if ( ! wp_verify_nonce( $nonce, 'seo_crawler_action' ) ) {
			die( 'Nonce verification failed!' );
		}
		WP_ROCKET_SEO_Crawler::crawl_homepage();
		WP_ROCKET_SEO_Sitemap::create_sitemap();
		echo '<p>Crawling completed.</p>';
	}
	$nonce_field = wp_nonce_field( 'seo_crawler_action', 'seo_crawler_nonce' );
	echo '<form method="post" action="">
            <input type="submit" name="start_crawl" value="' . esc_html__( 'Start Crawl', 'rocket' ) . '">'
		. $nonce_field // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		. '</form>';

	// Display the last crawl results.
	$links = WP_ROCKET_SEO_Crawler_Database::get_links();
	if ( ! empty( $links ) ) {
		echo '</br><p>' . esc_html__( 'Check', 'rocket' ) . " <a href='../sitemap.html' target='_blank'>" . esc_html__( 'sitemap.html', 'rocket' ) . '</a></p>';
		echo '<p>' . esc_html__( 'Last Home page snapshot. View', 'rocket' ) . " <a href='../home_page_snapshot.html' target='_blank'>" . esc_html__( 'home_page_snapshot.html', 'rocket' ) . '</a></p>';

		echo '<h3>' . esc_html__( 'Last Crawl Results', 'rocket' ) . ':</h3>';
		echo '<ul>';
		foreach ( $links as $link ) {
			$url = $link->url;
			echo '<li><a href="' . esc_html( $url ) . ' target="_blank">' . esc_html( $url ) . '</a></li>';
		}
		echo '</ul>';
	}
}
