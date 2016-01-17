<?php
/**
 * The template for displaying Preisträger-Übersicht.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

get_header();?>

<main id="main" class="site-main m-t" role="main">
  <div class="row">
    <div class="col-xs-12 m-b"style="background-color: #eceeef; padding: 1rem;">
      <div class="col-lg-2 col-xs-6">
        <figure class="figure">
          <img class="img-responsive" alt="Logo der Journalisten des Jahres" src="<?php print get_template_directory_uri() . '/images/jdjschwarzaufweiss.png'  ?>">
        </figure>
      </div>
      <div class="col-lg-2 col-xs-6">
        <figure class="figure">
          <img class="img-responsive" alt="Logo der Journalisten des Jahres" src="<?php print get_template_directory_uri() . '/images/cover_MM012016.png'  ?>">
        </figure>
      </div>
      <header class="page-header col-lg-8 col-xs-12">
        <h1 class="page-title"><?php echo single_cat_title('', false); ?></h1>
        <div class="lead"><?php the_archive_description();?></div>
      </header><!-- .page-header -->
    </div>
  </div>

<?php if(is_tax( 'preise', 'journalisten-des-jahres' )){


  function end_prev_letter() {
     echo "<!-- End of letter-group -->\n";
     echo "<div class='clear'></div>\n";
  }
  function start_new_letter($letter) {
     echo "<div class='alert alert-success'>\n";
     echo "\t<strong>$letter</strong>\n";
     echo "</div>";
  }


  $args = array (
    'posts_per_page' => -1,
    'post_type' => 'preistraeger',
    'meta_key' => 'nachname',
    'orderby' => 'meta_value',
    'order' => 'ASC',
  );
  query_posts($args);
  if ( have_posts() ) {
    $in_this_row = 0;
    while ( have_posts() ) {
       the_post();
       $first_letter = strtoupper(substr(get_field('nachname'),0,1));
       if ($first_letter != $curr_letter) {
          if (++$post_count > 1) {
             end_prev_letter();
          }
          start_new_letter($first_letter);
          $curr_letter = $first_letter;
       }
      get_template_part('teasers/teaser', get_post_type());
    }
    end_prev_letter();
    ?>
  <?php } else {
    echo "<h2>Sorry, no posts were found!</h2>";
  }
//end of jdj-archive
}else{
  get_template_part('template-parts/content', 'preis-uebersicht');

}  ?>

</main><!-- #main -->
<?php get_footer();?>