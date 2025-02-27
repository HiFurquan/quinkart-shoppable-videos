<!-- Functions for video CRUD operations -->
<?php
// Fetch reels for frontend
function qsv_get_reels() {
    $args = [
        'post_type'      => 'qsv_reels',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];

    $query = new WP_Query($args);
    $reels = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $reels[] = [
                'video_url'     => get_field('video_url'),
                'product_title' => get_field('product_title'),
                'price'         => get_field('price'),
                'discount'      => get_field('discount'),
                'rating'        => get_field('rating'),
                'wishlist_count'=> get_field('wishlist_count'),
                'share_count'   => get_field('share_count'),
                'product_url'   => get_permalink(get_field('linked_product')),
            ];
        }
    }
    wp_reset_postdata();
    wp_send_json_success($reels);
}

add_action('wp_ajax_qsv_get_reels', 'qsv_get_reels');
add_action('wp_ajax_nopriv_qsv_get_reels', 'qsv_get_reels');
