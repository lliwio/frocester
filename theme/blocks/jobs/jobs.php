
    <div class="max-w-wide mx-auto px-4 2xl:px-0">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 mb-24">
        <?php
        $args = array(
            'post_type'      => 'jobs',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC'
        );

        $recent_posts = new WP_Query( $args );

        if ( $recent_posts->have_posts() ) :
            while ( $recent_posts->have_posts() ) :
                $recent_posts->the_post(); 

                get_template_part( 'template-parts/content/content-job-card' );

            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>No job openings.</p>';
        endif;
        ?>
        </div>
    </div>
