<?php
// Shortcode to display reels
function qsv_display_reels() {
    ob_start();
    ?>
    <div id="qsv-reels-container">
        <?php
        $videos = [
            ['url' => 'https://www.w3schools.com/html/mov_bbb.mp4', 'product_url' => '#'],
            ['url' => 'https://www.w3schools.com/html/movie.mp4', 'product_url' => '#'],
        ];

        foreach ($videos as $video) : ?>
            <div class="qsv-reel">
                <video src="<?php echo esc_url($video['url']); ?>" loop muted playsinline></video>
                <div class="qsv-buttons">
                    <a href="<?php echo esc_url($video['product_url']); ?>" class="qsv-btn order-btn" title="Order Now">🛍️</a>
                    <button class="qsv-btn wishlist-btn" title="Wishlist">💖</button>
                    <button class="qsv-btn share-btn" title="Share">🔗</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('qsv_reels', 'qsv_display_reels');
