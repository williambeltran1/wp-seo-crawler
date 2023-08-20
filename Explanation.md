
# SEO Crawler Plugin Explanation

## Problem Statement

In essence, website administrators desire a simple way to visualize how their homepage is linked internally, aiding in manual SEO improvements. A WordPress plugin that can automate this process, particularly by crawling the home page and creating a structured representation of these links, is what we aim to implement.

## Technical Approach

1. **Plugin Administration**: Provide a WordPress backend admin interface to trigger the crawl manually.
2. **Automated Crawling**: Once triggered, initiate an hourly crawl of the website's homepage to identify internal links.
3. **Data Management**: Store crawl results temporarily in a database, while also facilitating deletion based on time constraints.
4. **Results Representation**: Display the crawl results in the admin interface and also create a `sitemap.html` for a visual structure.

## Technical Decisions

1. **Why WordPress?**: As one of the world's most popular CMS platforms, WordPress offers a broad audience base. The plugin API and hook system make it apt for such utilities.
2. **Database Storage**: Chose MySQL/MariaDB because of its tight integration with WordPress and its scalability for larger websites.
3. **Nonce Verification**: To ensure the security of our admin-triggered actions, we used WordPress nonce mechanism.
4. **WP Filesystem API**: Instead of generic PHP file functions, we utilized WP Filesystem for compatibility and security.

## How the Code Works

1. **Admin Interface**: Added an option in the settings menu of WordPress admin. This is where the admin triggers the crawl.
2. **Crawling the Home Page**: Utilized simple HTTP requests to fetch the content and then parsed the HTML to extract internal links.
3. **Database Operations**: Leveraged WordPress's `$wpdb` class for database interactions, ensuring optimal performance and security.
4. **File Creation**: Used WP Filesystem API to create and manage the `sitemap.html` and snapshot of the homepage.

## Achieving Admin's Desired Outcome

By providing a simple trigger on the admin interface, the plugin automates the process of link extraction, representation, and visualization. This aligns perfectly with the admin's needs, as outlined in the user story. It saves time, aids in SEO improvements, and offers insights into the website's structure.

## Reflections

### Problem Approach

When faced with such a problem, I began by understanding the core needs of the user. By segmenting the process into crawl, store, represent, and visualize, it became easier to design a solution.

### Thinking Process

Considering the platform (WordPress) and the overarching goal (SEO enhancement), the approach was to integrate seamlessly while offering substantial value.

### Direction Choice

The choice to keep the process simple, yet effective, stemmed from the understanding that website admins appreciate straightforward tools that do not interfere with their core activities.

### Solution Superiority

By focusing on core functionality, ensuring scalability, and maintaining adherence to WordPress standards, this solution stands out as efficient and user-friendly.
