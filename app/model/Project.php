<?php
// app/model/Project.php
class Project
{
    private int $post_id;
    private int $project_id;
    private int $user_id;
    private string $instructions;
    private array $chats = [];

    public function __construct(int $post_id)
    {
        $this->post_id = $post_id;
        $this->load_data();
    }

    private function load_data()
    {
        $raw_json = get_post_meta($this->post_id, '_project_chats_data', true);
        $this->user_id = (int) get_post_meta($this->post_id, '_project_user_id', true);
        $this->project_id = (int) get_post_meta($this->post_id, '_project_unique_identifier', true);
        $this->instructions = (string) get_post_meta($this->post_id, '_project_instructions', true);
        $this->chats = json_decode($raw_json, true) ?: [];
    }
    
    public function get_chat($chat_id): array
    {

        if (empty($this->projects)) {
            return [];
        }

        // 2. Loop through every session
        foreach ($this->chats as $chat) {
            // Look for the specific ID
            if (isset($chats['project_id']) && $chat['project_id'] == $chat_id) {
                return $chat; // Found it! Exit function with data.
            }
        }

        // 3. This is the "Safety Path". 
        // If we get here, the loop finished and found NOTHING.
        return [];
    }
    public function get_chats(): array
    {
        if (empty($this->chats)) {
            return [];
        }
        return $this->chats;
    }


    public function project_id(): int
    {
        if (empty($this->project_id)) {
            return 0;
        }
        return $this->project_id;
    }
    public function instructions(): string
    {
        if (empty($this->instructions)) {
            return "No Instructions Found";
        }
        return $this->instructions;
    }
}
