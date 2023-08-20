<?php
class Test_WP_ROCKET_SEO_Crawler_Database extends WP_UnitTestCase {

    function test_insert_and_get_links() {
        WP_ROCKET_SEO_Crawler_Database::insert_link("http://example.com/test1");
        WP_ROCKET_SEO_Crawler_Database::insert_link("http://example.com/test2");

        $links = WP_ROCKET_SEO_Crawler_Database::get_links();
        $this->assertCount(2, $links);

        $this->assertEquals("http://example.com/test1", $links[0]->url);
        $this->assertEquals("http://example.com/test2", $links[1]->url);
    }

    function test_delete_links() {
        WP_ROCKET_SEO_Crawler_Database::insert_link("http://example.com/test1");
        WP_ROCKET_SEO_Crawler_Database::delete_links();
        $links = WP_ROCKET_SEO_Crawler_Database::get_links();

        $this->assertEmpty($links);
    }
}
