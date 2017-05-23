<?php
# /js-login.php
require_once 'php-graph-sdk-5.5/src/Facebook/autoload.php';

if(!session_id()){
	session_start();
}

$fb = new Facebook\Facebook([
  'app_id' => '228450964309010',
  'app_secret' => '8bc98f4053d8f24558bfdc78f951e9f1',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getJavaScriptHelper();

$permissions = ['email', 'user_friends'];

$cilent = $fb->getOAuth2Client(); // OAuth 2.0 client handler

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
	$loginUrl = $helper->getLoginUrl('http://localhost/fbapp/callback.php', $permissions);
	echo "<script>window.top.location.href='".$loginUrl."'</script>"; //no cookie set or no OAuth data could be obtained from cookie
  exit;
}
else {
	if (isset($_SESSION['fb_access_token'])) {
		$fb->setDefaultAccessToken($_SESSION['fb_access_token']);
	} else {
		$_SESSION['fb_access_token'] = (string) $accessToken;
		// Exchanges a short-lived access token for a long-lived one
		$longLivedAccessToken = $cilent->getLongLivedAccessToken($_SESSION['fb_access_token']);
		$_SESSION['fb_access_token'] = (string) $longLivedAccessToken;
		$fb->setDefaultAccessToken($_SESSION['fb_access_token']);
	}
}

// Logged in

//Retrieve user profile
	 try {
	  // Returns a `Facebook\FacebookResponse` object
			$requestPicture = $fb->get('/me/picture?redirect=false&width=125&height=125',$accessToken->getValue()); //getting user picture
			$requestProfile = $fb->get('/me',$accessToken->getValue()); // getting basic info
			$requestBirthday = $fb->get('me?fields=birthday',$accessToken->getValue());
			$requestFriends = $fb->get('/me/taggable_friends?fields=picture.width(100).height(100)&limit=5000',$accessToken->getValue());
			
			$picture = $requestPicture->getGraphUser();
			$profile = $requestProfile->getGraphUser();
			$birthday = $requestBirthday->getGraphUser();
			$friends = $requestFriends->getGraphEdge()->asArray();
			
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
	  echo 'Graph returned an error: ' . $e->getMessage();
	  exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
	  echo 'Facebook SDK returned an error: ' . $e->getMessage();
	  exit;
	}
	
	$url = array();
	$i = 0;
	foreach ($friends as $friend) {
		$url[$i++] = $friend['picture']['url'];
	}
	$random_keys = array_rand($url ,8);
	// showing picture on the screen

// User is logged in!
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Your Best Friends</title>
    <meta charset="utf-8"/>
    <link href="bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="fbapp.css" type="text/css">
    <meta property="fb:app_id" content="448744028643597" />
    <meta property="fb:admins" content="100000030817144" />
</head>
<body>
    <header class="navbar navbar-static-top" id="top" role="banner" style="padding:0px; margin:0px;background-color:#FFF">
        <div class="" style="height:44px; box-shadow: 0 4px 8px -2px gray;margin-bottom:5px;">
            <div class="container">
                <div class="logo" style="float:left; margin-top:2px;">
                    <a href="#"><img src="anonymous.png" height="40px" /></a>
                </div>
                <div style="float:left; border-left: 2px solid #FDDC56; line-height: 40px;margin: 2px 20px ; padding-left: 20px;font-size:24px; font-family: Libel Suit; letter-spacing: 4px;"><a href="#">FSocietyLK</a></div>
                <div class="navbar-header">
                    <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar" aria-controls="bs-navbar" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <nav id="bs-navbar" class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="menu-item" style="height:43px;font-family: Libel Suit; letter-spacing: 4px; color:#000;font-size:21px;font-weight: normal;">Home</a>
                        </li>
                        <li><a href="#" class='menu-item' style='height:43px;font-family: Libel Suit; letter-spacing: 4px; color:#000;font-size:21px; font-weight: normal !important;'>Logout</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <div id="non-loading-block" style="display: block">
        <div style='text-align: center;padding: 0px;margin-top: 15px;margin-bottom: 15px;'>
            <div style='text-align: center;padding-top: 10px'></div>
        </div>

        <div class='container content-container'>

            <section class='col-xs-12 col-sm-12 col-md-12'>

                <article class='row main-content-wrapper'>

                    <div class='col-xs-12 col-sm-8 col-md-8'>
                        <section class='col-xs-12 col-sm-12 col-md-12'>

                            <div id='result-loading-div' style='display: none'>
                                <article class='row answer-row'>
                                    <div class='col-xs-12 col-sm-12 col-md-12'>
                                        <div class='jumbotron loading-jumbotron'>
                                            <article class='row'>
                                            </article>
                                        </div>
                                    </div>
                                </article>
                            </div>


                            <div id='result-jumbotron-div' style='display: block'>
                                <article class='row answer-row'>
                                    <div class='col-xs-12 col-sm-12 col-md-12'>

                                        <div class='jumbotron answer-activity-jumbotron' style='background-color: #ffffff;'>

                                            <article class='row answer-question-wrapper text-center' style='padding: 15px'>
                                                <div class='col-xs-12 col-sm-12 col-md-12'>
                                                    <div class='answer-question'>
                                                        <span style='font-size: 17px;color: #000000'>
                                                            Your Best friends on a canvas!
                                                        </span>
                                                    </div>
                                                </div>
                                            </article>


                                            <article class='row answer-share-wrapper' id='share-facebook-wrapper-1'>
                                            </article>
                                            <article class='row answer-picture-wrapper' style='padding: 0px 0px 15px'>
                                                <div class='col-sm-12 col-md-12' id='canvas-div'>
                                                    <div class='answer-picture col-xs-12' style="width:100%">
														<canvas id="canvas">
															<script type="text/javascript">
																var img1 = new Image();
																var img2 = new Image();
																var img3 = new Image();
																var img4 = new Image();
																var img5 = new Image();
																var img6 = new Image();
																var img7 = new Image();
																var img8 = new Image();
																var img9 = new Image();
																var img10 = new Image();
																var canvas = document.getElementById('canvas');
																var context = canvas.getContext('2d');

																img1.onload = function() {
																	canvas.width = document.getElementById("canvas-div").offsetWidth;
																	canvas.height = img1.height;
																	img2.src = "<?php echo $picture['url'] ?>";
																	img3.src = "<?php echo $url[$random_keys[0]] ?>";
																	img4.src = "<?php echo $url[$random_keys[1]] ?>";
																	img5.src = "<?php echo $url[$random_keys[2]] ?>";
																	img6.src = "<?php echo $url[$random_keys[3]] ?>";
																	img7.src = "<?php echo $url[$random_keys[4]] ?>";
																	img8.src = "<?php echo $url[$random_keys[5]] ?>";
																	img9.src = "<?php echo $url[$random_keys[6]] ?>";
																	img10.src = "<?php echo $url[$random_keys[7]] ?>";
																};
																img2.onload = function() {
																	context.globalAlpha = 1.0;
																	context.drawImage(img1, 0, 0);
																	context.drawImage(img2, 280, 135);
																	context.font = "bold 20px Arial";
																	context.fillStyle = 'white';
																	context.textAlign="center"; 
																	context.fillText("<?php echo $profile['name']; ?>", 340, 285);
																};
																img3.onload = function() {
																	context.globalAlpha = 1.0;
																	context.drawImage(img3, 70, 10);
																};
																img4.onload = function() {
																	context.globalAlpha = 1.0;
																	context.drawImage(img4, 530, 155);
																};
																img5.onload = function() {
																	context.globalAlpha = 1.0;
																	context.drawImage(img5, 530, 10);
																};
																img6.onload = function() {
																	context.globalAlpha = 1.0;
																	context.drawImage(img6, 70, 155);
																};
																img7.onload = function() {
																	context.globalAlpha = 1.0;
																	context.drawImage(img7, 70, 300);
																};
																img8.onload = function() {
																	context.globalAlpha = 1.0;
																	context.drawImage(img8, 530, 300);
																};
																img9.onload = function() {
																	context.globalAlpha = 1.0;
																	context.drawImage(img9, 295, 10);
																};
																img10.onload = function() {
																	context.globalAlpha = 1.0;
																	context.drawImage(img10, 295, 300);
																};

																img1.src = 'image2.jpg';
															</script>
														</canvas>
                                                    </div>
                                                </div>
                                            </article>


                                            <article class='row answer-description-wrapper' style='padding-top: 0px;padding-bottom: 15px'>
                                                <div class='col-xs-12 col-sm-12 col-md-12'>
                                                    <div class='answer-description'>
                                                        <span style='font-size: 16px; line-height: 1.4; font-weight: 200; color: #333333'>
                                                            Share with the world a canvas of your friendship. The canvas has all your Best friends and family in it. Have paintful day!
                                                        </span>
                                                    </div>
                                                </div>
                                            </article>


                                            <article class='row question-app-page-button-wrapper' style='padding: 0px 5px 15px;' id='result-jumbotron-fb-like-button'>
                                            </article>
                                            <!-- End of App Page Buttons Wrapper -->
                                            <!-- Start of Answer Share Wrapper -->
                                            <article class='row answer-share-wrapper' id='share-facebook-wrapper-2' style='padding-top: 0px;padding-bottom: 15px'>
                                                <div class='col-xs-12 col-sm-12 col-md-12'>
                                                    <table style='width:100%'>
                                                        <tr>
                                                            <td class='share-call-td'>
                                                                <a class='fb-blue-button answer-share-button' style='display: inline-block;padding: 15px 18px;box-shadow: 0 2px 2px #A5ADC9;border: 1px solid #3d518b;border-radius: 50px' onclick='check_if_fb_is_defined();'>
                                                                    <img src='http://cdn.meaww.com/media/images/facebookf.png' />
                                                                    <span id='share-on-facebook-inner'>Share on my Facebook</span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </article>
                                            <!-- End of Answer Share Wrapper -->
                                        </div>
                                        <!-- End of Answer Jumbotron -->
                                        <!-- Start of Sidebar Header Text -->
                                        
                                        <!-- End of Sidebar Header Text -->
                                        <!-- Start of Display other Activities -->
                                        
                                        <!-- End of Display other Activities -->
                                    </div>
                                </article>
                                
                                <!-- Start of Footer Next Activities -->                                
                                <!-- End of Footer Next Activities -->
                            </div>
                            <!-- End of Result Div Container -->
                            <!-- Google ads Desktop bottom code Start -->                            
                            <!-- Google ads Desktop bottom code End -->

                        </section>
                    </div>
                    <!-- End of Left Page Section -->
                    <!-- Start of Right Page Section -->
                                     
                    <!-- End of Right Page Section -->

                </article>
                <!-- End of Main Content Article -->
            </section>
            <!-- End of Main Content Section -->
        </div>
        <!-- End of Main Container -->
        <!-- Start of Pagination -->
        
        <!-- End of Pagination -->
    </div>


    <div style="margin-top:50px;"></div>
    <div class="footer" style="background-color: #3A3A3C">
        <div class="text-center">
            <a href="#"><img src="anonymous.png" width="70px" style="margin-top: -60px;" /></a>
        </div>
        <div class="container">
            <p class="muted">
                <a href="#">Home</a>
            </p>
            <p class="muted">
                Disclaimer: All content is provided for fun and entertainment purposes only.
            </p>
        </div>
    </div>

    <!-- End of Modals -->

    <div id="fb-root"></div>
</body>
</html>