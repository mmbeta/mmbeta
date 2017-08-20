<?php
/**
 * Template part for displaying single Preisträger Teaser.
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

?>
<?php 
  $preis = mmbeta_welcher_preis('slug'); 
  $button_text = '';
  if($preis === 'journalisten-des-jahres'){
    $button_text = "Begründung";
  }elseif ($preis === 'top-30-bis-30') {
    $button_text = "Steckbrief";
  }else{
    $button_text = "mehr";
  }
?>
<?php $vorname = get_field('vorname') ?>
<article id="preistraeger-<?php the_ID(); ?>" <?php post_class(); ?>>
  <dl class="lead col-lg-4 col-md-6 col-xs-12 m-t">
    <dt><?php the_field('nachname'); $vorname ? print ', ' . $vorname : print ''; ?> </dt>
    <dd><?php the_field( "position" ); ?></dd>
    <div class="pull-md-left">
      <a href="<?php the_permalink(); ?>"><button type="button" class="btn btn-secondary btn-sm"><?php echo $button_text ?></button></a>
    </div>
  </dl><!-- .entry-content -->
</article><!-- #post-## -->