<?php
// app/model/User.php
class User{
    private int $id;
    private string $name;
    private string $email;

    public function __construct(int $user_id) {
        $this->id = $user_id;
        $this->load_data();

    }
    public function load_data(){
        $info = get_userdata($this->id);
        $this->name = $info->display_name ?? 'Guest';
        $this->email = $info->user_email ?? '';
    }

    public function get_profile(): array {
        return [
            'id'   => $this->id,
            'name' => $this->name,
            'email' => $this->email
        ];
    }
    public function get_name(): string {
        return $this->name;
    }

    public function get_email(): string {
        return $this->email;
    }

}