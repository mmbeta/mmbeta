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
  <?php
  $posts = get_posts(array(
  	'posts_per_page' => -1,
  	'post_type' => 'preistraeger',
  	'meta_key' => 'nachname',
  	'orderby' => 'meta_value',
  	'order' => 'ASC',
  ));

  if (have_posts()): ?>
    <header class="page-header m-t">
      <h1 class="page-title"><?php echo single_cat_title('', false); ?></h1>
      <div class="lead"><?php the_archive_description();?></div>
    </header><!-- .page-header -->
    <?php while (have_posts()): the_post();?>
      <?php get_template_part('teasers/teaser', get_post_type());?>
  	<?php endwhile;?>
  <?php else: ?>
    <?php get_template_part('template-parts/content', 'none');?>
  <?php endif;?>

// TESTING
<style type="text/css">
.letter-group { width: 100%; }
.letter-cell { width: 5%; height: 2em; text-align: center; padding-top: 8px; margin-bottom: 8px; background: #e0e0e0; float: left; }
.row-cells { width: 70%; float: right; margin-right: 180px; }
.title-cell { width: 30%;  float: left; overflow: hidden; margin-bottom: 8px; }
.clear { clear: both; }
</style>

<?php 
  $posts_per_row = 3;

function end_prev_letter() {
   echo "<!-- End of letter-group -->\n";
   echo "<div class='clear'></div>\n";
}
function start_new_letter($letter) {
   echo "<div class='alert alert-success'>\n";
   echo "\t<strong>$letter</strong>\n";
   echo "</div>";
}

 
?>

<style type="text/css">
.letter-group { width: 100%; }
.letter-cell { width: 5%; height: 2em; text-align: center; padding-top: 8px; margin-bottom: 8px; background: #e0e0e0; float: left; }
.row-cells { width: 70%; float: right; margin-right: 180px; }
.title-cell { width: 30%;  float: left; overflow: hidden; margin-bottom: 8px; }
.clear { clear: both; }
</style>
 
<div id="main-background">
 
   <div id="main-column">
      <h1><?php the_title(); ?></h1>
 
      <div class="margin-top"></div>
 
      <div id="a-z">
 
         <?php



         $args = array (
            'posts_per_page' => -1,
            'post_type' => 'preistraeger',
            'orderby' => 'title',
            'order' => 'ASC',
         );
         query_posts($args);
         if ( have_posts() ) {
            $in_this_row = 0;
            while ( have_posts() ) {
               the_post();
               $first_letter = strtoupper(substr(apply_filters('the_title',$post->post_title),0,1));
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
            <div class="navigation">
               <div class="alignleft"><?php next_posts_link('&laquo; Higher Letters') ?></div>
               <div class="alignright"><?php previous_posts_link('Lower Letters &raquo;') ?></div>
            </div>
         <?php } else {
            echo "<h2>Sorry, no posts were found!</h2>";
         }
         ?>
 
      </div><!-- End id='a-z' -->
 
   </div><!-- End class='margin-top -->
 
</div><!-- End id='rightcolumn' -->

</main><!-- #main -->
<?php get_footer();?>