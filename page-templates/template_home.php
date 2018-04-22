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
  <main id="main" role="main">

    <?php
    // check if the flexible content field has rows of data
    if( have_rows('homepage') ):

         // loop through the rows of data
        while ( have_rows('homepage') ) : the_row();

            //  Teasergruppe
            if( get_row_layout() == 'teasergruppe' ):

              $posts_to_be_shown = get_sub_field('teaser-anzahl');
              $teasergruppe_posts = array();

              $post_1 = get_sub_field('linkziel_1');
              $post_2 = get_sub_field('linkziel_2');
              $post_3 = get_sub_field('linkziel_3');

              if ($post_1) {
                $teaser_text_1 = get_sub_field('teaser-text_1');
                $teaser_format = get_sub_field('teaserform_1');
                update_post_meta($post_1, 'hp_teaser', $teaser_text_1);
                update_post_meta($post_1, 'hp_teaser_format', $teaser_format);
                array_push($teasergruppe_posts, $post_1);
              }

              if ($post_2) {
                $teaser_text_2 = get_sub_field('teaser-text_2');
                $teaser_format = get_sub_field('teaserform_2');
                update_post_meta($post_2, 'hp_teaser', $teaser_text_2);
                update_post_meta($post_2, 'hp_teaser_format', $teaser_format);
                array_push($teasergruppe_posts, $post_2);
              }

              if ($post_3) {
                $teaser_text_3 = get_sub_field('teaser-text_3');
                $teaser_format = get_sub_field('teaserform_3');
                update_post_meta($post_3, 'hp_teaser', $teaser_text_3);
                update_post_meta($post_3, 'hp_teaser_format', $teaser_format);
                array_push($teasergruppe_posts, $post_3);
              }

              $teasergroup_query = new WP_Query( array( 
                'post__in' => $teasergruppe_posts,
                'orderby' => 'post__in',
                'posts_per_page' => $posts_to_be_shown, 
                )
              );

              if ( $teasergroup_query->have_posts() ) : 
              ?>
                <div class="row">
                  <div class="col-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1 col-xl-8 col-xl-offset-2">
                  <?php
                    $template_name = 'teasergruppe-' . $posts_to_be_shown;

                    while ( $teasergroup_query->have_posts() ) : $teasergroup_query->the_post();
                      get_template_part( 'hp/hp', $template_name);
                    endwhile;
                  ?>
                  </div>
                </div>
              <?php
              endif;
              wp_reset_query();          

            // Zitat
            elseif( get_row_layout() == 'zitat' ): 

              get_template_part( 'hp/hp', 'zitat');

            // Tweet
            elseif( get_row_layout() == 'social-teaser' ):
              
              get_template_part( 'hp/hp', 'social');
            
            // Kopf-Slider
            elseif( get_row_layout() == 'preistraeger-slider' && null !== get_sub_field('kopf-slider')  ):
              $kategorie = get_sub_field('kopf-slider');
              $farbe = get_sub_field('color');
              $titel = get_sub_field('slider_titel');
              
              echo heads_gallery_shortcode( 
                array(
                'kategorie' => $kategorie->slug, 
                'farbe' => $farbe, 
                'titel' => $titel
                ) 
              );
              wp_reset_query();

            elseif ( get_row_layout() == 'cover-slider'):
              $kategorie = get_sub_field('cover-slider');
              $farbe = get_sub_field('color');
              $titel = get_sub_field('slider_titel');
              echo '<div class="row cover-slider m-t" style="background-color:' . mmbeta_color($farbe) . ' " >';
                echo '<h6 class="heads-gallery-heading">' . $titel . '</h6>';
                echo "<div class='col-md-8 col-md-offset-2'>";
                  echo cover_gallery_shortcode(
                        array(
                          'kategorie' => $kategorie->slug, 
                          'farbe' => $farbe, 
                          'titel' => $titel
                        )
                  );
                echo '</div>';
              echo '</div>';
            
            elseif ( get_row_layout() == 'aufmacher'):
              $post = get_post( get_sub_field('aufmacher-artikel') );
              $post->background_color = get_sub_field('color');
              $post->contrast_color = get_sub_field('contrast-color');

              get_template_part('hp/hp', 'aufmacher');
              wp_reset_query();
            elseif ( get_row_layout() == 'hp_embed' ):
              get_template_part( 'hp/hp', 'video');
            endif;


        endwhile;

    else :
        echo "no layouts found";
    endif;

    ?>


</main><!-- #main -->

</div><!-- #primary -->

<?php get_footer(); ?>