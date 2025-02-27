<?php
function quinkart_upload_video() {
    if (!empty($_FILES['video_file']['name'])) {
        $uploaded_file = $_FILES['video_file'];
        $upload_dir = wp_upload_dir();
        $target_file = $upload_dir['path'] . '/' . basename($uploaded_file['name']);
        
        if (move_uploaded_file($uploaded_file['tmp_name'], $target_file)) {
            global $wpdb;
            $table_name = $wpdb->prefix . 'quinkart_videos';
            $wpdb->insert($table_name, array(
                'video_url' => $target_file,
                'created_at' => current_time('mysql'),
            ));
        }
    }
    wp_redirect(admin_url('admin.php?page=quinkart_shoppable_videos'));
    exit();
}
add_action('admin_post_quinkart_upload_video', 'quinkart_upload_video');
?>
