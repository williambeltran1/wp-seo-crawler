<?php
class Test_WP_ROCKET_SEO_Crawler extends WP_UnitTestCase {

    function setUp() {
        parent::setUp();

        // Mock wp_remote_get
        add_filter('pre_http_request', [$this, 'mock_wp_remote_get'], 10, 3);
    }

    function tearDown() {
        remove_filter('pre_http_request', [$this, 'mock_wp_remote_get']);
        parent::tearDown();
    }

    function mock_wp_remote_get($preempt, $args, $url) {
        return array(
            'body' => '<a href="http://example.com/link1">Link1</a><a href="http://example.com/link2">Link2</a>'
        );
    }

    function test_crawl_homepage() {
        WP_ROCKET_SEO_Crawler::crawl_homepage();
        $links = WP_ROCKET_SEO_Crawler_Database::get_links();

        $this->assertCount(2, $links);
        $this->assertEquals("http://example.com/link1", $links[0]->url);
        $this->assertEquals("http://example.com/link2", $links[1]->url);
    }
}
