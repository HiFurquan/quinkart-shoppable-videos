jQuery(document).ready(function($) {
    $.post(qsv_ajax.ajax_url, { action: 'qsv_get_reels' }, function(response) {
        if (response.success) {
            const container = $('#qsv-reels-container');
            container.empty(); // Clear loading text

            response.data.forEach(reel => {
                container.append(`
                    <div class="reel">
                        <video src="${reel.video_url}" controls autoplay muted loop></video>
                        <h3>${reel.product_title}</h3>
                        <p>Price: ₹${reel.price} | Discount: ${reel.discount}% | ⭐ ${reel.rating}</p>
                        <a href="${reel.product_url}">View Product</a>
                    </div>
                `);
            });
        } else {
            $('#qsv-reels-container').html('<p>No reels found.</p>');
        }
    });
});
