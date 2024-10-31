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

    if (menuToggle && menu) { 
        menuToggle.addEventListener('click', function() {
            const expanded = menuToggle.getAttribute('aria-expanded') === 'true';
            menuToggle.setAttribute('aria-expanded', !expanded);
            menu.classList.toggle('hidden');

            if (expanded) {
                body.classList.remove('overflow-hidden');
            } else {
                body.classList.add('overflow-hidden');
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const logosContainers = document.querySelectorAll('.logos');

    logosContainers.forEach(logosContainer => {
        const firstClone = logosContainer.children[0].cloneNode(true);
        logosContainer.appendChild(firstClone);
    });
});

jQuery(document).ready(function($) {
    $('.filter-button').on('click', function(e) {
        e.preventDefault();

        $('.filter-button').removeClass('active');
        
        $(this).addClass('active');
        
        $('#skeleton-grid').show();
        $('#content-grid').hide();

        var category = $(this).data('category');
        var postType = $(this).data('post-type');

        $.ajax({
            url: ajaxfilter.ajaxurl,
            type: 'POST',
            data: {
                action: 'filter_posts',
                category: category,
                post_type: postType
            },
            success: function(response) {
                
                setTimeout(function() {
                    $('#content-grid').html(response).show();
                    $('#skeleton-grid').hide();
                }, 500); 
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
});

import Swiper from 'swiper/bundle';
document.addEventListener('DOMContentLoaded', function () {
    var swiper = new Swiper('.carousel-swiper', {
        slidesPerView: 6,
        spaceBetween: 30,
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            375: {
                slidesPerView: 2,
            },
            640: {
                slidesPerView: 3,
            },
            768: {
                slidesPerView: 4,
            },
            960: {
                slidesPerView: 5,
            },
        },
    });
});
