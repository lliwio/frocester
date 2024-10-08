/**
 * Front-end JavaScript
 *
 * The JavaScript code you place here will be processed by esbuild. The output
 * file will be created at `../theme/js/script.min.js` and enqueued in
 * `../theme/functions.php`.
 *
 * For esbuild documentation, please see:
 * https://esbuild.github.io/
 */

document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('button[aria-controls="primary-menu"]');
    const menu = document.getElementById('primary-menu');
    const body = document.body;

    if (menuToggle && menu) {  // Ensure both elements exist
        menuToggle.addEventListener('click', function() {
            const expanded = menuToggle.getAttribute('aria-expanded') === 'true';
            menuToggle.setAttribute('aria-expanded', !expanded);
            menu.classList.toggle('hidden');

            // Lock or unlock body scroll
            if (expanded) {
                body.classList.remove('overflow-hidden');
            } else {
                body.classList.add('overflow-hidden');
            }
        });
    }
});


document.addEventListener('DOMContentLoaded', function() {
    const logosContainer = document.querySelector('.logos');
    const firstClone = logosContainer.children[0].cloneNode(true);
    logosContainer.appendChild(firstClone);
});

jQuery(document).ready(function($) {
    $('.filter-button').on('click', function(e) {
        e.preventDefault();

        // Remove active class from all buttons
        $('.filter-button').removeClass('active');
        
        // Add active class to the clicked button
        $(this).addClass('active');
        
        // Show the skeleton UI and hide the content
        $('#skeleton-grid').show();
        $('#content-grid').hide();

        // Get the category and post type
        var category = $(this).data('category');
        var postType = $(this).data('post-type'); // You need to set this in your HTML

        $.ajax({
            url: ajaxfilter.ajaxurl,
            type: 'POST',
            data: {
                action: 'filter_posts',
                category: category,
                post_type: postType // Pass the post type as well
            },
            success: function(response) {
                // Delay showing the content and hiding the skeleton
                setTimeout(function() {
                    $('#content-grid').html(response).show();
                    $('#skeleton-grid').hide();
                }, 500); // Adjust delay as needed
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
});
