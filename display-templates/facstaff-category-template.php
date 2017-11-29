<?php
$custom_terms = get_terms('profile-category');
// echo '<p>'.print_r($custom_terms).'</p>';
// echo 'hello world!';
foreach($custom_terms as $custom_term) {
    wp_reset_query();
    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'facstaff',
        'tax_query' => array(
            array(
                'taxonomy' => 'profile-category',
                'field' => 'slug',
                'terms' => $custom_term->slug,
            ),
        ),
     );

     $loop = new WP_Query($args);
    //  echo '<p>the query'.$loop.'</p>';
     if($loop->have_posts()) {
        echo '<h2>'.$custom_term->name.'</h2>';

        // echo 'is page:'.$is_page.'.<br/>';
        // echo '<pre>'.print($custom_term).'</pre>';
        while($loop->have_posts()) : $loop->the_post();
            // original
            echo '<a href="'.get_permalink($facstaff_posts->ID).'">'.get_the_title().'</a><br>';
            
            // echo 'the meta:'.get_post_meta(get_the_ID(), 'facstafftitle')[0].'<br/>';
            // echo 'the meta: '.print_r(get_post_meta(get_the_ID()), true).'<br/>';
            // echo 'thumbnail 3: '.print_r(get_post_meta(get_the_ID(), '_thumbnail_id')[0], true).'<br/>';
            // echo 'thumbnail'..'<br/>';

            // with thumbnail wip
            // echo '<a href="'.get_permalink($facstaff_posts->ID).'">'.get_the_post_thumbnail(null, [50,50]).get_the_title().' - '.'</a><br/><br/>';
        endwhile;
     }
}
?>
