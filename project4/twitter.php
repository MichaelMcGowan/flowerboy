<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Flower Boy</title>
  <meta name="description" content="Flower Boy">
  <meta name="author" content="Michael McGowan">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="css/styles.css">
</head>

<body>

<!-- start php here -->
<?php

ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');
require_once('TwitterTextFormatter.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "454238095-8VsPdb6RC4N8FKx60mX14rcboqf841hNWGiStGOq",
    'oauth_access_token_secret' => "ZR05hNeD6GV4v8NMZU648eqaqb4XZEm8EKXRPlpylNJWV",
    'consumer_key' => "gbYVwKFNjkrjFGzLEa9nO2Uc4",
    'consumer_secret' => "QdtGrAQ0WC8vSgiiYtBPo0ZXvnMv0iXq6e3y7ubkdIHOVYMmOY"
);

// Set here the Twitter account from where getting latest tweets
$screen_name = 'tylerthecreator';

// Get timeline using TwitterAPIExchange
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = "?screen_name={$screen_name}";
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$user_timeline = $twitter
  ->setGetfield($getfield)
  ->buildOauth($url, $requestMethod)
  ->performRequest();

$user_timeline = json_decode($user_timeline);

// var_dump($user_timeline);




// Use the class TwitterTextFormatter
use Netgloo\TwitterTextFormatter;

// Use the code above to fill the $user_timeline with latest tweets

// ...

// Print each tweet using TwitterTextFormatter to get the HTML text
echo "<div class='container-fluid'>";
//
// foreach ($user_timeline as $user_tweet) {
//   echo '<div class="tweet" id="tweets">';
//   $profile_image_url = $user_tweet->user->profile_image_url;
//   $screen_name = $user_tweet->user->screen_name;
//   echo '<img class="profile_image_url" src="' . $profile_image_url . '">';
//   echo '<h5 class="twitter_handle">' . $twitter_handle . '</h5>';
//   echo '<p class="t">' . TwitterTextFormatter::format_text($user_tweet) . '</p>';
//   echo '</div>';
// }



foreach ($user_timeline as $user_tweet) {

  echo "<div class='row box-it'><div class='col-xs-12 col-md-1'>";
  $profile_image_url = $user_tweet->user->profile_image_url;
    echo "<img class='profile_image' src='{$profile_image_url}' />";
      "</div>";

    $twitter_handle = $user_tweet->user->screen_name;
        echo "<a class='handle' href='https://twitter.com/tylerthecreator' target='_blank'>" . $twitter_handle . "</a>";

  echo "<div class='tweet col-xs-12 col-md-11'>";

  if (isset($user_tweet->entities->media)) {
    $media_url = $user_tweet->entities->media[0]->media_url;
    echo "<img src='{$media_url}' width='100%' />";


  }





  echo "<p>" . TwitterTextFormatter::format_text($user_tweet) . "</p>";

  echo "</div></div></div>";
}
echo "</div></div>";



// $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
// $getfield = '?screen_name=tylerthecreator';
// $requestMethod = 'GET';
// $twitter = new TwitterAPIExchange($settings);
// $tweetData = json_decode( $twitter->setGetfield($getfield)
//              ->buildOauth($url, $requestMethod)
//              ->performRequest(),$assoc=TRUE);
//
//           foreach($tweetData['statuses'] as $index => $items){
//                $userArray = $items['user'];
//                echo '<div class="tweet-border row">';
//                echo '<a class="float-left" href="http://twitter.com/' . $userArray['screen_name'] . '"><img class="tweetimg" src="' . $userArray['profile_image_url'] . '"></a>';
//                echo '<span>';
//                echo '<a class="float-left" href="http://twitter.com/' . $userArray['screen_name'] . '"><h3 class="tweet-name">' . $userArray['name'] . '</h3>' . '</a>';
//                echo '<h1 class="tweet">@' . $userArray['screen_name'] . '</h1>' . "<br />";
//                echo '<h2 class="tweet-text">' . $items['text'] . '</h2>' . "<br />";
//                echo '</span>';
//                echo '</div>';
//
//              }
// echo "<script>pageComplete();</script>;"


?>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="tweetLinkIt.js"></script>
<script src="js/scripts.js"></script>
<script>

   function pageComplete(){
       $('.tweet').tweetLinkify();
   }
</script>

</body>

</html>
