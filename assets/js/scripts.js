document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('qsv-reels-container');
    container.style.scrollSnapType = 'y mandatory';
    container.style.overflowY = 'scroll';
    container.style.height = '100vh';

    const reels = document.querySelectorAll('.qsv-reel');
    reels.forEach(reel => {
        reel.style.scrollSnapAlign = 'start';
    });
});
