<?php
// app/controller/AccountController.php
require_once __DIR__ . '/../model/User.php';
class AccountController
{
    private int $current_user_id;
    public function __construct() {
        $this->current_user_id = get_current_user_id();
    }
    public static function auth(): bool
    {
        $current_user_id = get_current_user_id();
        $user = new User($current_user_id);
        
        // Check if the user object actually loaded data
        return !empty($user->get_profile());
    }
    public function get_current_user_id(): int{
        return $this->current_user_id;
    }
}
