<?php

class WP_ROCKET_SEO_Sitemap {

	/**
	 * Create sitemap.html
	 *
	 * @return void
	 */
	public static function create_sitemap() {
		$links           = WP_ROCKET_SEO_Crawler_Database::get_links();
		$sitemap_content = '<ul>';
		foreach ( $links as $link ) {
			$sitemap_content .= "<li><a href='{$link->url}'>{$link->url}</a></li>";
		}
		$sitemap_content .= '</ul>';

		$file_path = ABSPATH . '/sitemap.html';
		file_put_contents( $file_path, $sitemap_content );
	}
}
