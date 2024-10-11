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
                <div class="swiper-slide bg-white pb-4 px-8 min-h-[380px]">
                    <?php if ($image) : ?>
                        <img class="h-24 w-24 object-cover" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
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

        <div class="relative !top-12 mt-6 mb-12 max-w-48 mx-auto">
            <div class="swiper-button-next static border border-white hover:bg-coral hover:!border-coral !w-12 !h-12 text-md p-4"></div>
            <div class="swiper-pagination !-top-4"></div>
            <div class="swiper-button-prev static border border-white hover:bg-coral hover:!border-coral !w-12 !h-12 text-md p-4"></div>
        </div>
    </div>
<?php else : ?>
    <p>No rows found in repeater.</p>
<?php endif; ?>
