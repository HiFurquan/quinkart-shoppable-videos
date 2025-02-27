<?php
/*
Plugin Name: QuinKart Shoppable Videos
Description: Responsive, autoplaying shoppable reels with fixed 9:16 aspect ratio and smooth transitions.
Version: 1.5
Author: QuinKart Team
*/

add_shortcode('quinkart_reels', 'quinkart_shoppable_reels');

function quinkart_shoppable_reels() {
    ob_start(); ?>
    <style>
        /* Main Reels Container */
        .qsv-reels-container {
            width: 100vw;
            height: 100vh;
            overflow-y: scroll;
            scroll-snap-type: y mandatory;
            -webkit-overflow-scrolling: touch;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #000;
        }

        /* Reel Wrapper with Fixed Aspect Ratio (9:16) */
        .qsv-reel {
            position: relative;
            width: 100%;
            max-width: 430px; /* Max width for larger screens */
            aspect-ratio: 9 / 16;
            scroll-snap-align: start;
            background-color: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
        }

        /* Video Styling */
        .qsv-reel video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        /* Action Buttons */
        .qsv-buttons {
            position: absolute;
            right: 12px;
            bottom: 100px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .qsv-buttons button {
            background-color: rgba(0, 0, 0, 0.6);
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 50%;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .qsv-buttons button:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Product Info */
        .qsv-product-info {
            position: absolute;
            bottom: 70px;
            left: 15px;
            right: 15px;
            background-color: rgba(0, 0, 0, 0.6);
            color: #fff;
            padding: 10px;
            border-radius: 8px;
            font-size: 14px;
            line-height: 1.4;
        }

        /* Order Button */
        .qsv-order-btn {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            background-color: #ff007b;
            color: #fff;
            padding: 14px;
            text-align: center;
            font-size: 18px;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .qsv-order-btn:hover {
            background-color: #e6006b;
        }

        /* Audio Toggle */
        .qsv-audio-toggle {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: rgba(0, 0, 0, 0.6);
            color: #fff;
            padding: 10px;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
        }

        /* Responsive Adjustments */
        @media (max-width: 480px) {
            .qsv-buttons button { font-size: 16px; padding: 8px; }
            .qsv-product-info { font-size: 13px; }
            .qsv-order-btn { font-size: 16px; }
        }

        @media (min-width: 768px) and (max-width: 1023px) {
            .qsv-buttons button { font-size: 20px; }
            .qsv-product-info { font-size: 15px; }
            .qsv-order-btn { font-size: 20px; }
        }

        @media (min-width: 1024px) {
            .qsv-buttons button { font-size: 22px; }
            .qsv-product-info { font-size: 16px; }
            .qsv-order-btn { font-size: 22px; }
        }
    </style>

    <div class="qsv-reels-container">
        <?php
        $videos = [
            ['src' => 'https://www.w3schools.com/html/mov_bbb.mp4', 'title' => 'Elegant Dress', 'price' => '₹1499', 'discount' => '20%', 'rating' => '4.5'],
            ['src' => 'https://www.w3schools.com/html/movie.mp4', 'title' => 'Stylish Top', 'price' => '₹999', 'discount' => '15%', 'rating' => '4.7']
        ];

        foreach ($videos as $index => $video) : ?>
            <div class="qsv-reel" data-index="<?php echo $index; ?>">
                <video src="<?php echo $video['src']; ?>" playsinline autoplay loop></video>

                <div class="qsv-audio-toggle">🔊</div>

                <div class="qsv-buttons">
                    <button title="Wishlist">❤️</button>
                    <button title="Share Link">🔗</button>
                    <button title="Share">📤</button>
                </div>

                <div class="qsv-product-info">
                    <strong><?php echo $video['title']; ?></strong><br>
                    Price: <?php echo $video['price']; ?> | Discount: <?php echo $video['discount']; ?> | ⭐ <?php echo $video['rating']; ?>
                </div>

                <div class="qsv-order-btn">Order Now</div>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const videos = document.querySelectorAll('.qsv-reel video');

            // Play videos with sound on load
            videos.forEach((video, index) => {
                video.muted = false; // Default unmuted
                video.addEventListener('loadeddata', () => video.play().catch(err => console.warn('Autoplay blocked:', err)));
            });

            // Smooth playback control with Intersection Observer
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    const video = entry.target;
                    if (entry.isIntersecting) {
                        video.play().catch(err => console.warn('Play error:', err));
                    } else {
                        video.pause();
                        video.currentTime = 0;
                    }
                });
            }, { threshold: 0.6 });

            videos.forEach(video => observer.observe(video));

            // Audio toggle functionality
            document.querySelectorAll('.qsv-audio-toggle').forEach((toggle, index) => {
                toggle.addEventListener('click', () => {
                    const video = videos[index];
                    video.muted = !video.muted;
                    toggle.textContent = video.muted ? '🔇' : '🔊';
                });
            });
        });
    </script>
     <?php return ob_get_clean();
}
   // ------------------------------------------BACKEND PROCESS----------------------------------------------

// Hook to add admin menu
add_action('admin_menu', 'qsv_add_admin_menu');

function qsv_add_admin_menu() {
    add_menu_page(
        'QuinKart Shoppable Videos',
        'Shoppable Videos',
        'manage_options',
        'quinkart_shoppable_videos',
        'quinkart_shoppable_videos_dashboard',
        'dashicons-video-alt3',
        6
    );
}

// Include dashboard display function
require_once plugin_dir_path(__FILE__) . 'admin/admin-dashboard.php';
require_once plugin_dir_path(__FILE__) . 'includes/video-functions.php';

function quinkart_shoppable_videos_dashboard() {
?>
    <div class="wrap">
        <h2>QuinKart Shoppable Videos - Manage Videos</h2>
        
        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data">
            <input type="hidden" name="action" value="quinkart_upload_video">
            <label for="video_file">Upload Video (MP4, MOV):</label>
            <input type="file" name="video_file" accept="video/mp4,video/mov" required>
            <button type="submit">Upload</button>
        </form>

        <h3>Uploaded Videos</h3>
        <ul>
            <?php 
            $videos = quinkart_get_all_videos(); 
            foreach ($videos as $video) {
                echo "<li>" . esc_html($video->video_url) . "</li>";
            }
            ?>
        </ul>
    </div>
    <?php
}

register_activation_hook(__FILE__, 'quinkart_create_video_table');
?>