<?php

// app/model/Chat.php

class Chat {
    private int $post_id;
    private int $user_id;
    private int $chat_id;
    private array $sessions = [];

    public function __construct(int $post_id) {
        $this->post_id = $post_id;
        $this->load_data();
    }

    private function load_data() {
        $raw_json = get_post_meta($this->post_id, '_chat_data', true);
        $this->sessions = json_decode($raw_json, true) ?: [];
        $this->user_id = (int) get_post_meta($this->post_id, '_chat_user_id', true);
        $this->chat_id = (int) get_post_meta($this->post_id, '_chat_unique_identifier', true);
    }

    /**
     *
     * This keeps the WP_Query logic inside the Model where it belongs.
     */
    public static function find_by_user(int $user_id): array {
        $instances = [];
        $query = new WP_Query([
            'post_type'      => 'chats',
            'posts_per_page' => -1,
            'meta_query'     => [
                [
                    'key'   => '_chat_user_id',
                    'value' => $user_id,
                ]
            ]
        ]);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                // Return actual Chat objects
                $instances[] = new self(get_the_ID());
            }
            wp_reset_postdata();
        }
        return $instances;
    }

    // Getters...
    public function get_sessions(): array { return $this->sessions; }
    public function get_chat_id(): int { return $this->chat_id; }
}