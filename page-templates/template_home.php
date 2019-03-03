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

              $teaser_format_1 = get_sub_field('teaserform_1');
              $teaser_format_2 = get_sub_field('teaserform_2');
              $teaser_format_3 = get_sub_field('teaserform_3');


              // TODO: Der Ausschluss funktioniert noch nicht, wenn ein Teaser 'ad' ist.
              if ($teaser_format_1 !== 'ad' && $post_1 ) {
                $teaser_text_1 = get_sub_field('teaser-text_1');
                update_post_meta($post_1, 'hp_teaser', $teaser_text_1);
                update_post_meta($post_1, 'hp_teaser_format', $teaser_format_1);
                array_push($teasergruppe_posts, $post_1);
              }

              if ($teaser_format_2 !== 'ad' && $post_2) {
                $teaser_text_2 = get_sub_field('teaser-text_2');
                update_post_meta($post_2, 'hp_teaser', $teaser_text_2);
                update_post_meta($post_2, 'hp_teaser_format', $teaser_format_2);
                array_push($teasergruppe_posts, $post_2);
              }

              if ($teaser_format_3 !== 'ad' && $post_3) {
                $teaser_text_3 = get_sub_field('teaser-text_3');
                update_post_meta($post_3, 'hp_teaser', $teaser_text_3);
                update_post_meta($post_3, 'hp_teaser_format', $teaser_format_3);
                array_push($teasergruppe_posts, $post_3);
              }

              $editorial_teaser_count = count($teasergruppe_posts);
              $ad_count = $posts_to_be_shown - $editorial_teaser_count;

              $teasergroup_query = new WP_Query( array( 
                'post__in' => $teasergruppe_posts,
                'orderby' => 'post__in',
                'posts_per_page' => $posts_to_be_shown,
                'ignore_sticky_posts' => 1,
                )
              );

              if ( !empty($teasergruppe_posts) && $teasergroup_query->have_posts() ) : 
              ?>
                <div class="container d-flex flex-row flex-wrap justify-content-center mt-3">
                  
                  <?php
                    $template_name = 'teasergruppe-' . $posts_to_be_shown;

                    while ( $teasergroup_query->have_posts() ) : $teasergroup_query->the_post();
                      get_template_part( 'hp/hp', $template_name);
                    endwhile;

                    for ($i=$posts_to_be_shown; $i > $editorial_teaser_count; $i--) {  
                      echo "<!-- adding an ad -->";
                      get_template_part( 'hp/hp', $template_name . '-ad');
                    }
                  ?>
                  
                </div>
              <?php
              elseif ($ad_count > 0) :

              ?>

                <div class="container d-flex flex-row flex-wrap justify-content-center mt-3">
                  <!-- Hier kann ein vollbreites Ad hin -->
                  <?php get_template_part( 'hp/hp', 'teasergruppe-1-ad'); ?>
                  
                </div>
              
              <?php
              else:
                echo "no Post";
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
              $selection = get_sub_field('preistraeger_for_slider');
              $titel_link = get_sub_field('titel-link');
              
              
              if ( !$kategorie && count($selection) > 0 ) {
                echo heads_gallery_shortcode( 
                  array(
                  'kategorie' => null, 
                  'farbe' => $farbe, 
                  'titel' => $titel,
                  'selection' => $selection,
                  'titel-link' => $titel_link,
                  ) 
                );
              }else{
                // There is a page called preis_seite that can be added to JDJ 2017 / Top30 2019 etc. via custom field
                $tax_page = empty( get_field('preis_seite', $kategorie ) ) ? "" :  get_field('preis_seite', $kategorie )[0];
                $tax_page_url = empty( get_post_permalink($tax_page) ) ? "" : get_post_permalink($tax_page);

                echo heads_gallery_shortcode( 
                  array(
                  'kategorie' => $kategorie->slug, 
                  'farbe' => $farbe, 
                  'titel' => $titel,
                  'selection' => null,
                  'titel-link' => $tax_page_url,
                  ) 
                );
              }

              wp_reset_query();

            elseif ( get_row_layout() == 'cover-slider'):
              $kategorie = get_sub_field('cover-slider');
              $farbe = get_sub_field('color');
              $titel = get_sub_field('slider_titel');
              echo '<div class="row cover-slider mt-3 mb-3 pt-3" style="background-color:' . mmbeta_color($farbe) . ' " >';
                echo '<div class="justify-content-center container d-flex flex-row flex-wrap">';
                  echo '<h6 class="heads-gallery-heading col-12">' . $titel . '</h6>';
                  echo "<div class='col-12'>";
                    echo cover_gallery_shortcode(
                          array(
                            'kategorie' => $kategorie->slug, 
                            'farbe' => $farbe, 
                            'titel' => $titel
                          )
                    );
                  echo '</div>';
                echo '</div>';
              echo '</div>';
            
            elseif ( get_row_layout() == 'aufmacher'):
              $post = get_post( get_sub_field('aufmacher-artikel') );
              $post->background_color = get_sub_field('color');
              $post->contrast_color = get_sub_field('contrast-color');

              get_template_part('hp/hp', 'aufmacher');
              wp_reset_query();
            elseif ( get_row_layout() == 'hp_embed' ):
              echo '<div class="container d-flex flex-row flex-wrap justify-content-center mt-3">';
              get_template_part( 'hp/hp', 'video');
              echo '</div>';
            endif;


        endwhile;

    else :
        echo "no layouts found";
    endif;

    ?>


</main><!-- #main -->

</div><!-- #primary -->

<?php get_footer(); ?>