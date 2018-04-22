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
$link_class = mmbeta_color( get_sub_field('color'), true ) === "#FFFFFF" ? "link-bright" : "link-dark";
?>

<div class="row m-t m-b" style="background-color: <?php echo mmbeta_color( get_sub_field('color') ); ?>;">
  <div class="col-12">
    <a href="<?php the_sub_field('zitat-link')?>" class="<?php echo $link_class ?>">
      <blockquote class="mmbeta_hp_quote">
        <p><?php echo $zitat; ?></p>
        <footer>
          <cite><?php echo '- ' . $zitatgeber; ?></cite>
        </footer>
      </blockquote>
    </a>
  </div>
</div>