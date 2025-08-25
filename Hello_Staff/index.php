<?php

// Prevent direct access
defined('PLUGINPATH') or exit('No direct script access allowed');

/*
Plugin Name: Hello Staff
Plugin URL: https://example.com/hello-staff
Description: A simple plugin to greet staff members and display a list from a custom table, and a page that greets the logged-in user and lists demo rows.
Version: 1.0
Requires at least: 2.8
Author: Olayode Adeshina
Author URL: https://github.com/adedeni
*/

use Config\Services;

//Installation hook: this is to create demo table and seed rows
register_installation_hook("Hello_Staff", function ($item_purchase_code) {
    // If you require purchase validation, add it here (this is an optional, feature):
    // if (!validate_purchase_code($item_purchase_code)) {so you can add the code block here if it is in your plan ... }

    $db = db_connect('default');
    $db_prefix = get_db_prefix();
    $db->query("SET sql_mode = ''");

    $table = $db_prefix . "plugin_hello_staff_items";
    $db->query("CREATE TABLE IF NOT EXISTS `$table` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `title` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `deleted` TINYINT(1) NOT NULL DEFAULT '0',
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;");

    // Seed a couple of rows if empty
    $count = $db->table($table)->countAllResults();
    if ($count == 0) {
        $db->table($table)->insertBatch([
            ['title' => 'Welcome to Hello Staff', 'deleted' => 0],
            ['title' => 'Second demo row', 'deleted' => 0],
        ]);
    }
});

// Hook for uninstallation: Can be used to remove the table, I have comment the code block out, because I am keeping data by default, if you want to uninstall hooks uncomment it!
register_uninstallation_hook("Hello_Staff", function () {
    // $db = db_connect('default');
    // $db_prefix = get_db_prefix();
    // $db->query("DROP TABLE IF EXISTS `{$db_prefix}plugin_hello_staff_items`;");
});

// Hook for activation
register_activation_hook("Hello_Staff", function () {
    // No operation needed for this test, but the hook is registered, could re-enable anything if disabled on deactivate
});

// Hook for deactivation
register_deactivation_hook("Hello_Staff", function () {
    // No operation needed for this test, but the hook is also registered here, could soft-disable things or set deleted flags if needed
});

//Hook for update
register_update_hook("Hello_Staff", function () {
    // Show information or run migrations between versions if needed
});

// Add left menu item for Staff, always return the first parameter (per docs).
app_hooks()->add_filter('app_filter_staff_left_menu', function ($sidebar_menu) {
    $sidebar_menu["hello_staff"] = [
        "name" => app_lang("hello_staff_menu"), // This will be translated via app_lang()
        "url" => "hello_staff",
        "class" => "users", // Example icon class
        "position" => 99
    ];
    return $sidebar_menu;
});

// Filter to add a widget to the dashboard
app_hooks()->add_filter('app_filter_dashboard_widget', function ($dashboard_widgets) {
    $dashboard_widgets[] = array(
        "widget" => "hello_staff_widget",
        "widget_view" => view("Hello_Staff\\Views\\widget")
    );
    return $dashboard_widgets;
});

