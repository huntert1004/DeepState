<?php
// app/controller/ChatController.php
require_once __DIR__ . '/../model/Chat.php';
require_once __DIR__ . '/../model/User.php';
class ChatController
{
    private User $user;
    /**
     * This function decides which "Base" view to show
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function index()
    {
        // 1. Logic: Check if there's an existing chat history in the DB

        $history = Chat::find_by_user($this->user->get_profile()['id']);

        $data = [
            'username' => $this->user->get_name(),
            'email'    => $this->user->get_email(),
            'history'  => $history
        ];

        $this->render('BaseChat', $data);
    }

    private function render($pageName, $data)
    {
        $theme_uri = get_template_directory_uri();

        $data['page_styles'] = [
            $theme_uri . "/assets/css/layouts.css",
            $theme_uri . "/assets/css/base.css",
            $theme_uri . "/assets/css/components.css",
            $theme_uri . "/assets/css/variable.css",
        ];

        extract($data);

        ob_start();
        include get_template_directory() . "/app/view/pages/{$pageName}.php";
        $content = ob_get_clean();

        include get_template_directory() . "/app/view/layouts/MainShell.php";
    }
}
