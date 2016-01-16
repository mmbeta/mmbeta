<?php
/**
 * Template part for displaying single Preisträger Teaser.
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

?>

<?php $vorname = get_field('vorname') ?>
<article id="preistraeger-<?php the_ID(); ?>" <?php post_class(); ?>>
  <dl class="lead col-lg-6 m-t">
    <dt><?php the_field('nachname'); $vorname ? print ', ' . $vorname : print ''; ?> </dt>
    <d><?php the_field( "position" ); ?></dd>
    <div class="pull-md-left">
      <a href="<?php the_permalink(); ?>"><button type="button" class="btn btn-secondary btn-sm">Begründung</button></a>
    </div>
  </dl><!-- .entry-content -->
</article><!-- #post-## -->