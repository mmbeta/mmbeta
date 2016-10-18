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
  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3 container">
    <div class="row">
    <?php

      //get_field('teaser-typ') ? $teaser_typ = get_field('teaser-typ') : $teaser_typ = 'Standard';
      //get_template_part( 'teasers/teaser', $teaser_typ );


    // check if the flexible content field has rows of data
    if( have_rows('homepage') ):

         // loop through the rows of data
        while ( have_rows('homepage') ) : the_row();

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

              $the_query = new WP_Query( array( 
                'post__in' => array( $post_1, $post_2, $post_3 ) 
                )
              );

              if ( $the_query->have_posts() ) : 
                while ( $the_query->have_posts() ) : $the_query->the_post();
                  get_template_part( 'hp/hp', 'teasergruppe');
                endwhile;
              endif;
              

            elseif( get_row_layout() == 'zitat' ): 

              $zitat = get_sub_field('zitat-text');
              echo $zitat;

            elseif( get_row_layout() == 'tweet-teaser' ):
              $tweet = get_sub_field('tweet');
              echo $tweet;
            endif;

        endwhile;

    else :

        // no layouts found

    endif;

    ?>

    </div>
</div>
</main><!-- #main -->

</div><!-- #primary -->


<div class="col-xs-12">
  <?php get_footer(); ?>
</div>