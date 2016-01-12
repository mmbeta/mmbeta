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
</main><!-- #main -->
<?php get_footer();?>