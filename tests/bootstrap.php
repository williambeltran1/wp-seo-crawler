<?php
$_tests_dir = getenv('WP_TESTS_DIR');

if (!$_tests_dir) {
    $_tests_dir = dirname(__FILE__).'/../../../..';
}

require dirname(__FILE__) . '/../../../../wp-blog-header.php';
require_once $_tests_dir . '/wp-includes/functions.php';

function _manually_load_plugin() {
    require dirname(dirname(__FILE__)) . '/wp-seo-crawler.php';
}
tests_add_filter('muplugins_loaded', '_manually_load_plugin');

require $_tests_dir . '/includes/bootstrap.php';
