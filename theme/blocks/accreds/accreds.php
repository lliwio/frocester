<?php if (have_rows('logos')) : ?>
    <div class="max-w-wide w-full mx-auto px-4 2xl:px-0 relative mb-12">
        <div class="swiper carousel-swiper">
            <div class="swiper-wrapper">
                <?php
                // Initialize a counter for numbering the slides
                $counter = 1;

                // Loop through the carousel repeater fields
                while (have_rows('logos')) : the_row();
                    $image = get_sub_field('image');
                ?>
                <div class="swiper-slide bg-white pb-4 px-8">
                    <?php if ($image) : ?>
                        <img class="h-24 object-contain" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <?php else : ?>
                       
                    <?php endif; ?>
                </div>
                <?php 
                    // Increment the counter after each iteration
                    $counter++; 
                endwhile; 
                ?>
            </div>
        </div>
        <div class="swiper-button-next static !top-24 !right-0 xl:!-right-8 !w-6 !h-6 p-4"></div>
        <div class="swiper-button-prev static !top-24 !left-0 xl:!-left-8 !w-6 !h-6 p-4"></div>
    </div>
<?php else : ?>
    <p>No rows found in repeater.</p>
<?php endif; ?>
