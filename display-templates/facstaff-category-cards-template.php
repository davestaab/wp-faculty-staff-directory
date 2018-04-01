<?php
wp_enqueue_style( 'facstaff-style', plugins_url('../css/tachyons.min.css', __FILE__) );
// echo '
// <div class="flex flex-wrap pa2">
//   <div class="tc ma2">
//     <img src="http://tachyons.io/img/avatar_1.jpg" class="br-100 h4 w4 dib ba b--black-05 pa2" title="Photo of a kitty staring at you">
//     <h1 class="f3 mb2">Mimi W.</h1>
//     <h2 class="f5 fw4 gray mt0">CCO (Chief Cat Officer)</h2>
//   </div>
// </div>
// ';

$custom_terms = get_terms('profile-category', array('orderby' => 'slug'));
// echo '<pre>';
// print_r($custom_terms);
// echo '</pre>';
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
        echo '<h1 class="f3 f2-m f1-l">'.$custom_term->name.'</h1>';

        // echo 'is page:'.$is_page.'.<br/>';
        // echo '<pre>'.print($custom_term).'</pre>';
        echo '<div class="flex flex-wrap pa2">';
        while($loop->have_posts()) : $loop->the_post();
            // original
            // // echo '<a href="'.get_permalink($facstaff_posts->ID).'">'.get_the_title().'</a><br>';
            echo '
              <a href="' . get_permalink($facstaff_posts->ID) . '">
                <div class="tc ma2 pa2 ba b--black-20">
                  <img src="' . get_the_post_thumbnail_url(null, [150, 150]) . '" class="br-100 h4 w4 dib ba b--black-20 pa2" title="staff photo">
                  <h1 class="f3 mb2 mw4">' . get_the_title() . '</h1> 
                  <h2 class="f5 fw4 gray mt0 mw4">' . get_post_meta(get_the_ID(), 'facstafftitle', true) . '</h2> 
                </div>
              </a>
            ';
            
            // // echo 'the meta:' . get_post_meta(get_the_ID(), 'facstafftitle', true) . '<br/>'; 
            // // echo 'the meta: '.print_r(get_post_meta(get_the_ID()), true).'<br/>';
            // // echo 'thumbnail 3: '.print_r(get_post_meta(get_the_ID(), '_thumbnail_id')[0], true).'<br/>';
            // // echo 'thumbnail'..'<br/>';
            // // with thumbnail wip
            // // echo '<a href="'.get_permalink($facstaff_posts->ID).'">'.get_the_post_thumbnail(null) . '</a><br/><br/>';
        endwhile;
        echo '</div>';
     }
}
?>
