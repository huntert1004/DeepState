<?php

/**
 * 1. Enqueue Styles
 */
function ds_theme_enqueue() {}
add_action('wp_enqueue_scripts', 'deep_state_theme_enqueue');


/* ==========================================================================
   Register Custom Post Type: Projects
   ========================================================================== */
function ds_register_project_cpt()
{
    $labels = [
        'name'               => 'Projects',
        'singular_name'      => 'Project',
        'add_new'            => 'Add New Project',
        'add_new_item'       => 'Add New Project',
        'edit_item'          => 'Edit Project',
        'new_item'           => 'New Project',
        'view_item'          => 'View Project',
        'search_items'       => 'Search Projects',
        'not_found'          => 'No Projects Found',
        'not_found_in_trash' => 'No Project Found In Trash',
        'menu_name'          => 'Recent Project'
    ];

    $args = [
        'labels'       => $labels,
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => ['slug' => 'projects'],
        'menu_position' => 5,
        'menu_icon'    => 'dashicons-portfolio',
        'supports'     => ['title'],
        'show_in_rest' => false,
    ];

    register_post_type('projects', $args);
}
add_action('init', 'ds_register_project_cpt');

/* ==========================================================================
   Register Custom Post Type: Chats
   ========================================================================== */
function ds_register_chat_cpt()
{
    $labels = [
        'name'               => 'Chats',
        'singular_name'      => 'Chat',
        'add_new'            => 'Add New Chat',
        'add_new_item'       => 'Add New Chat',
        'edit_item'          => 'Edit Chat',
        'new_item'           => 'New Chat',
        'view_item'          => 'View Chat',
        'search_items'       => 'Search Chats',
        'not_found'          => 'No Chats Found',
        'not_found_in_trash' => 'No Chat Found In Trash',
        'menu_name'          => 'Recent Chats'
    ];

    $args = [
        'labels'       => $labels,
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => ['slug' => 'chats'],
        'menu_position' => 5,
        'menu_icon'    => 'dashicons-clipboard',
        'supports'     => ['title'],
        'show_in_rest' => false,
    ];

    register_post_type('chats', $args);
}
add_action('init', 'ds_register_chat_cpt');

/**
 * ====================================================
 * CUSTOM METABOXES FOR PROJECTS AND CHATS
 * ====================================================
 */

/**
 * Register Metaboxes
 */
function ds_add_custom_metaboxes()
{
    // Projects Metabox
    add_meta_box(
        'ds_project_details',
        'Project Configuration & Data',
        'ds_render_project_metabox',
        'projects', // Your registered slug
        'normal',
        'high'
    );

    // Chats Metabox
    add_meta_box(
        'ds_chat_details',
        'Chat Session Data',
        'ds_render_chat_metabox',
        'chats', // Your registered slug
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'ds_add_custom_metaboxes');

/**
 * Render Project Metabox
 */
function ds_render_project_metabox($post)
{
    // Add nonce for security
    wp_nonce_field('ds_save_project_meta', 'ds_project_nonce');

    // Retrieve existing values
    $user_id = get_post_meta($post->ID, '_project_user_id', true);
    $unique_id = get_post_meta($post->ID, '_project_unique_identifier', true);
    $instructions = get_post_meta($post->ID, '_project_instructions', true);
    $chats_data = get_post_meta($post->ID, '_project_chats_data', true);

    echo '<div class="ds-metabox-wrapper">';

    echo '<p><label>User ID:</label><br />';
    echo '<input type="number" name="ds_project_user_id" value="' . esc_attr($user_id) . '" class="widefat" /></p>';

    echo '<p><label>Unique Identifier:</label><br />';
    echo '<input type="text" name="ds_project_unique_identifier" value="' . esc_attr($unique_id) . '" class="widefat" /></p>';

    echo '<p><label>Project Instructions:</label><br />';
    echo '<textarea name="ds_project_instructions" rows="4" class="widefat">' . esc_textarea($instructions) . '</textarea></p>';

    echo '<p><label>Chat History (JSON):</label><br />';
    echo '<textarea name="ds_project_chats_data" rows="10" class="widefat" 
      placeholder=\'[{"chat_title": "...", "messages": [...]}]\'>'
        . esc_textarea($chats_data) . '</textarea></p>';


    echo '</div>';
}

/**
 * Render Chat Metabox
 */
function ds_render_chat_metabox($post)
{
    wp_nonce_field('ds_save_chat_meta', 'ds_chat_nonce');

    $user_id = get_post_meta($post->ID, '_chat_user_id', true);
    $unique_id = get_post_meta($post->ID, '_chat_unique_identifier', true);
    $chat_data = get_post_meta($post->ID, '_chat_data', true);

    echo '<div class="ds-metabox-wrapper">';

    echo '<p><label>User ID:</label><br />';
    echo '<input type="number" name="ds_chat_user_id" value="' . esc_attr($user_id) . '" class="widefat" /></p>';

    echo '<p><label>Unique Identifier:</label><br />';
    echo '<input type="text" name="_chat_user_id" value="' . esc_attr($unique_id) . '" class="widefat" /></p>';

    echo '<p><label>Chat History (JSON):</label><br />';
    echo '<textarea name="ds_chat_data" rows="10" class="widefat" 
      placeholder=\'[{"prompt": "...", "response": "...", "timestamp": "..."}]\'>'
        . esc_textarea($chat_data) . '</textarea></p>';

    echo '</div>';
}

/**
 * Save Metabox Logic
 */
function ds_save_custom_metabox_data($post_id)
{
    // 1. Basic Security Checks
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // --- SAVE PROJECTS DATA ---
    if (isset($_POST['ds_project_nonce']) && wp_verify_nonce($_POST['ds_project_nonce'], 'ds_save_project_meta')) {

        // Sanitize numeric and text
        if (isset($_POST['ds_project_user_id'])) {
            update_post_meta($post_id, '_project_user_id', intval($_POST['ds_project_user_id']));
        }
        if (isset($_POST['ds_project_unique_identifier'])) {
            update_post_meta($post_id, '_project_unique_identifier', sanitize_text_field($_POST['ds_project_unique_identifier']));
        }
        if (isset($_POST['ds_project_instructions'])) {
            update_post_meta($post_id, '_project_instructions', sanitize_textarea_field($_POST['ds_project_instructions']));
        }

        // Validate and Save JSON
        if (isset($_POST['ds_project_chats_data'])) {
            $json_input = wp_unslash($_POST['ds_project_chats_data']);
            if (is_array(json_decode($json_input, true))) {
                update_post_meta($post_id, '_project_chats_data', $json_input);
            }
        }
    }

    // --- SAVE CHATS DATA ---
    if (isset($_POST['ds_chat_nonce']) && wp_verify_nonce($_POST['ds_chat_nonce'], 'ds_save_chat_meta')) {

        if (isset($_POST['ds_chat_user_id'])) {
            update_post_meta($post_id, '_chat_user_id', intval($_POST['ds_chat_user_id']));
        }

        // Validate and Save JSON
        if (isset($_POST['ds_chat_data'])) {
            $json_input = wp_unslash($_POST['ds_chat_data']);
            if (is_array(json_decode($json_input, true))) {
                update_post_meta($post_id, '_chat_data', $json_input);
            }
        }
    }
}
add_action('save_post', 'ds_save_custom_metabox_data');
