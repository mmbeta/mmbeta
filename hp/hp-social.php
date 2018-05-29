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

if (function_exists('hourly_social_api_call')) {
  if (!$tweet) {
    $tweet_from_cache = get_transient( 'mmbeta_tweet' );

    if ( !$tweet_from_cache || isset($tweet_from_cache->error) ) {
      hourly_social_api_call();
    }
    
    if ( $tweet_from_cache && isset($tweet_from_cache->html) ){
      $tweet = $tweet_from_cache->html;
    }
  }

  if (!$fbpost) {
    $fbpost_from_cache = get_transient( 'mmbeta_fresh_facebook_post' );
    $cached_json = json_decode($fbpost_from_cache);

    if ( !$fbpost_from_cache || isset($cached_json->error) ) {
      hourly_social_api_call();
    }
    
    if ( $cached_json && isset($cached_json->id) ){
      $publisher_and_postid = explode("_", $cached_json->id);
      $fbpost = "https://www.facebook.com/" . $publisher_and_postid[0] . "/posts/" . $publisher_and_postid[1];
    }
  }
}

?>

<div class="container d-flex flex-row flex-wrap justify-content-center justify-content-lg-around social-container">
  <div class="col-12 col-lg-5 align-self-center">
    <?php echo $tweet; ?>
  </div>

  <div class="col-12 col-lg-5 align-self-center">
    <center>
      <div class="fb-post" data-href="<?php echo $fbpost; ?>" data-width="auto"></div>
    </center>
  </div>
</div>