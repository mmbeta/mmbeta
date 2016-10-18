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

<div class="row">
  <blockquote class="mmbeta_hp_quote">
    <p><?php echo $zitat; ?></p>
    <footer>
      <cite><?php echo $zitatgeber; ?></cite>
    </footer>
  </blockquote>
</div>