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
  $vorname = get_field('vorname'); 
  $button_text = '';

  if($preis === 'journalisten-des-jahres'){
    $button_text = "Begründung";
  }elseif ($preis === 'top-30-bis-30') {
    $button_text = "Steckbrief";
  }else{
    $button_text = "mehr";
  }

?>

<dl class="lead d-flex align-items-start flex-column col-md-4 align-self-md-stretch mt-2">
  <dt><?php the_field('nachname'); $vorname ? print ', ' . $vorname : print ''; ?> </dt>
  <dd class="mb-auto"><?php the_field( "position" ); ?></dd>
  <a class="btn btn-outline-secondary btn-sm mt-2" href="<?php the_permalink(); ?>"><?php echo $button_text ?></a>
</dl><!-- .entry-content -->
