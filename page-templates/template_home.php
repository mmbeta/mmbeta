<?php 

/**
 * Template Name: Homepage
 * The template file for mmbeta home page.
 *
 * The page depends on the Advanced Custom Fields Pro feature flexible content fields.
 * It can be managed through the dordpress editor.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

get_header();

?>

<div id="primary" class="content-area">
  <main id="main" class="row" role="main">
  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1 col-xl-6 col-xl-offset-3 container">
    <div class="row">
    <?php


    // check if the flexible content field has rows of data
    if( have_rows('homepage') ):

         // loop through the rows of data
        while ( have_rows('homepage') ) : the_row();

            //  Teasergruppe
            if( get_row_layout() == 'teasergruppe' ):

              $post_1 = get_sub_field('linkziel_1');
              $post_2 = get_sub_field('linkziel_2');
              $post_3 = get_sub_field('linkziel_3');

              if ( get_sub_field('teaser-text_1') ) {
                $teaser_text_1 = get_sub_field('teaser-text_1');
                update_post_meta($post_1, 'hp_teaser', $teaser_text_1); 
              }
              if ( get_sub_field('teaser-text_2') ) {
                $teaser_text_1 = get_sub_field('teaser-text_2');
                update_post_meta($post_2, 'hp_teaser', $teaser_text_1); 
              }
              if ( get_sub_field('teaser-text_3') ) {
                $teaser_text_1 = get_sub_field('teaser-text_3');
                update_post_meta($post_3, 'hp_teaser', $teaser_text_1); 
              }

              $teasergroup_query = new WP_Query( array( 
                'post__in' => array( $post_1, $post_2, $post_3 ),
                'orderby' => 'post__in' 
                )
              );

              if ( $teasergroup_query->have_posts() ) : 
                while ( $teasergroup_query->have_posts() ) : $teasergroup_query->the_post();
                  get_template_part( 'hp/hp', 'teasergruppe');
                endwhile;
              endif;
              wp_reset_query();          

            // Zitat
            elseif( get_row_layout() == 'zitat' ): 

              get_template_part( 'hp/hp', 'zitat');

            // Tweet
            elseif( get_row_layout() == 'tweet-teaser' ):
              $tweet = get_sub_field('tweet');
              echo $tweet;
            
            // Kopf-Slider
            elseif( get_row_layout() == 'preistraeger-slider' ):
              $kategorie = get_sub_field('kopf-slider');
              echo heads_gallery_shortcode( array('kategorie' => $kategorie->slug) );
              wp_reset_query(); 
            endif;

        endwhile;

    else :

        echo "no layouts found";

    endif;

    ?>

    </div>
</div>
</main><!-- #main -->

</div><!-- #primary -->


<div class="col-xs-12">
  <?php get_footer(); ?>
</div>