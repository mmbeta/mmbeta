<?php
/**
 * HP Layout Zitat.
 * Shows $zitat and $zitatgeber
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

$zitat = get_sub_field('zitat-text');
$zitatgeber = get_sub_field('zitatgeber');

?>

<div class="row" style="background-color: <?php echo mmbeta_color( get_sub_field('color') ); ?>">
  <div class="col-xs-12">
    <a href="<?php the_sub_field('zitat-link')?>">
      <blockquote class="mmbeta_hp_quote">
        <p><?php echo $zitat; ?></p>
        <footer>
          <cite><?php echo '- ' . $zitatgeber; ?></cite>
        </footer>
      </blockquote>
    </a>
  </div>
</div>