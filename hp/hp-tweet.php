<?php
/**
 * HP Layout Teasergruppe-3.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

$tweet = get_sub_field('tweet');
$fbpost = get_sub_field('facebook');

if (!$fbpost) {
  $fbpost_from_cache = get_transient( 'mmbeta_fresh_facebook_post' );
  $cached_json = json_decode($fbpost_from_cache);

  if ( 'undefined' === $cached_json->id ) {
    hourly_social_api_call();
  }
  
  if ( 'undefined' !== $cached_json->id){
    $publisher_and_postid = explode("_", $cached_json->id);
    $fbpost = "https://www.facebook.com/" . $publisher_and_postid[0] . "/posts/" . $publisher_and_postid[1];
  }
}

?>

<div class="row">
  <div class="col-xs-12 col-lg-6">
      <?php echo $tweet; ?>
  </div>

  <div class="col-xs-12 col-lg-6">
    <div class="fb-post" data-href="<?php echo $fbpost; ?>" data-width="500"></div>
  </div>
</div>