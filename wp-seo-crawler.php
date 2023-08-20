<?php
/**
 * Plugin Name: WP SEO Crawler
 * Description: Crawl homepage and list internal links.
 * Version: 1.0
 * Author: William Beltran
 * Text Domain: wp_rocket
 */

/*Constants*/
define( 'WP_ROCKET_SEO_CRAWLER_PATH', plugin_dir_path( __FILE__ ) );
define( 'WP_ROCKET_SEO_CRAWLER_URL', plugin_dir_url( __FILE__ ) );

/* Requires*/
require_once WP_ROCKET_SEO_CRAWLER_PATH . 'inc/class-database.php';
require_once WP_ROCKET_SEO_CRAWLER_PATH . 'inc/class-crawler.php';
require_once WP_ROCKET_SEO_CRAWLER_PATH . 'inc/class-sitemap.php';
require_once WP_ROCKET_SEO_CRAWLER_PATH . 'admin/admin-page.php';

/* Activation */
register_activation_hook( __FILE__, [ 'WP_ROCKET_SEO_Crawler_Database', 'create_table' ] );

/* WP Cron */
if ( ! wp_next_scheduled( 'seo_crawler_hourly_event' ) ) {
	wp_schedule_event( time(), 'hourly', 'seo_crawler_hourly_event' );
}
add_action( 'seo_crawler_hourly_event', [ 'WP_ROCKET_SEO_Crawler', 'crawl_homepage' ] );
