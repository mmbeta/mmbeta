<?php
/**
 * Template part for displaying single Preisträger Teaser.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

?>

<article id="preistraeger-<?php the_ID(); ?>" <?php post_class(); ?>>
  <dl class="lead">
    <dt><?php the_title(); ?></dt>
    <d><?php the_field( "position" ); ?></dd>
    <div class="pull-md-left">
      <a href="<?php the_permalink(); ?>"><button type="button" class="btn btn-secondary btn-sm">Begründung</button></a>
    </div>
  </dl><!-- .entry-content -->
</article><!-- #post-## -->