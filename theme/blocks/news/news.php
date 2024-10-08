<div class="bg-foreground alignfull pt-12 pb-6 mt-20">
    <div class="max-w-wide mx-auto px-4 2xl:px-0">
        <h3 class="text-4xl text-white my-8">Latest news</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 mb-24">
        <?php
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC'
        );

        $recent_posts = new WP_Query( $args );

        if ( $recent_posts->have_posts() ) :
            while ( $recent_posts->have_posts() ) :
                $recent_posts->the_post(); 

                get_template_part( 'template-parts/content/content-blog-card' );

            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>No recent posts available.</p>';
        endif;
        ?>
        </div>
    </div>
</div>