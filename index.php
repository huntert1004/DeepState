<?php
/**
 * index.php - The Router
 */

// 1. Load the Controller needed for this request
require_once get_template_directory() . '/app/controller/ChatController.php';

require_once get_template_directory() . '/app/controller/AccountController.php';



if (!AccountController::auth()){
    wp_redirect(wp_login_url());
}
$current_user_id = get_current_user_id();
$user = new User($current_user_id);

// 2. Initialize the Controller
$app = new ChatController($user);

// 3. Run the main logic
// This will internally decide to include BaseStart.php or BaseChat.php
$app->index();