<?php if (have_rows('logos')) : ?>
<section class="py-6">
    <div class="max-w-wide mx-auto px-4 2xl:px-0">
        <?php if(the_field('accreds_title')): ?>
        <h3 class="text-2xl uppercase table bg-foreground text-yellow px-4 py-2 mx-auto">
                <?php the_field('accreds_title'); ?>
        </h3>
        <?php endif; ?>
    </div>
    <div class="alignfull mx-auto px-4 2xl:px-0 relative mb-12">
        <div class="logos group relative overflow-hidden whitespace-nowrap my-4 [mask-image:_linear-gradient(to_right,_transparent_0,_white_128px,white_calc(100%-128px),_transparent_100%)]">
            <div class="animate-slide-left infinite group-hover:animation-pause inline-block w-max">
                <?php
                // Initialize a counter for numbering the slides
                $counter = 1;

                // Loop through the carousel repeater fields
                while (have_rows('logos')) : the_row();
                    $image = get_sub_field('image');
                ?>
                <div class="inline w-64 px-2">
                    <?php if ($image) : ?>
                        <img loading="lazy" class="mx-2 inline w-44" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
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
    </div>
</section>
<?php else : ?>
    <p>No rows found in repeater.</p>
<?php endif; ?>