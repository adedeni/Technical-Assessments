<?php

namespace Hello_Staff\Controllers;

use App\Controllers\Security_Controller;//This helps to access main app's secure controller
use Hello_Staff\Models\Hello_Staff_Model;

class Hello_Staff extends Security_Controller
{
    protected $Hello_Staff_Model;

    public function __construct()
    {
        parent::__construct();
        $this->Hello_Staff_Model = new Hello_Staff_Model();
    }

    // Renders the main view for the plugin
    public function index()
    {
        // Greet the logged-in user
        $data['greeting'] = app_lang('hello_staff_greeting') . " " . $this->login_user->first_name . "!";
        
        // Get items from the custom table
        $data['items'] = $this->Hello_Staff_Model->list_items();


        // Render the view using the main template
        return $this->template->rander('Hello_Staff/Views/index', $data);
    }
}