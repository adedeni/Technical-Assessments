# Hello_Staff Plugin for RISE CRM

This is a simple production-ready plugin for RISE CRM demonstrating installation, hooks, routes, controller, views, language strings, and a dashboard widget.

## 1. RISE Version Tested

* **RISE CRM Version:** 2.8 and higher
* **PHP:** 8.0 and higher


## 2. Installation Steps

1.  Download the repository as a `.zip` file.
2.  Ensure the extracted folder is named exactly `Hello_Staff`.
3.  Upload the `Hello_Staff` folder to the `/plugins` directory of your RISE CRM installation.
4.  Navigate to **Settings > Plugins** in your RISE admin panel.
5.  Find the "Hello Staff" plugin in the list and click **Install**, then **Activate**.
6.  The installation is now complete.

## 3. Implementation Details

Here is a summary of where each required feature was implemented:

* **Routes**: The main route `GET /hello_staff` is defined in `Hello_Staff/Config/Routes.php`. It points to the `index` method of the controller.

* **Controller**: The main controller is located at `Hello_Staff/Controllers/Hello_Staff.php`. It extends `Security_Controller` to ensure user authentication, retrieves data using its model, and uses `$this->template->rander()` to render the main view within the RISE template.

* **View**: The primary view file is `Hello_Staff/Views/index.php`. It displays a greeting to the logged-in user and shows a list of items pulled from the database. A separate view for the dashboard widget is located at `Hello_Staff/Views/widget.php`.

* **Language**: All user-facing text is managed through language strings defined in `Hello_Staff/Language/english/default_lang.php`. These strings use the unique `hello_staff_` prefix and are called in the views using the `app_lang()` function.

* **Hooks**: All hooks are registered in the main plugin file, `Hello_Staff/index.php`:
    * **Installation/Activation**: `register_installation_hook()` is used to create the `plugin_hello_staff_items` table and seed it with demo data. `register_uninstallation_hook()`, `register_activation_hook()`, and `register_deactivation_hook()` are also correctly registered.
    * **Staff Menu**: The `app_filter_staff_left_menu` filter is used to add the "Hello Staff" link to the staff's left-side menu.
    * **Dashboard Widget**: The `app_filter_dashboard_widget` filter is used to register and render the dashboard widget.

* **Install SQL**: The SQL `CREATE TABLE` statement for the `plugin_hello_staff_items` table is executed within the `register_installation_hook()` function in `Hello_Staff/index.php`.


## 4. Where Things Live
- **Metadata + Hooks**: `Hello_Staff/index.php`
  - `register_installation_hook()` creates table + seed
  - `register_*` activate/deactivate/uninstall/update
  - `app_filter_staff_left_menu` adds menu item
  - `app_filter_dashboard_widget` registers widget
- **Routes**: `Hello_Staff/Config/Routes.php`
- **Controller**: `Hello_Staff/Controllers/Hello_Staff.php`
- **Model**: `Hello_Staff/Models/Hello_Staff_Model.php`
- **Views**:
  - Main page: `Hello_Staff/Views/index.php`
  - Widget: `Hello_Staff/Views/widget.php`
- **Language**: `Hello_Staff/Language/english/default_lang.php`


## 5. Assumptions

- It is assumed that the server environment meets the minimum requirements for RISE CRM v2.8.
- The database user for RISE has the necessary `CREATE`, `DROP`, and `INSERT` permissions to manage the plugin's table.
- User has Staff access and can see staff left menu.
- No CSRF exclusions needed (GET only).
- We keep data on uninstall (safe default); change in `index.php` if you want to drop tables.

## 6. Security & Quality
- Escaped output in views.
- Namespaced files and consistent casing.