<!DOCTYPE html>
<html lang="en">
<head>
    <title>Your Best Friends</title>
    <meta charset="utf-8" />
    <link href="bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="fbapp.css" type="text/css">
    <meta property="fb:app_id" content="228450964309010" />
    <meta property="fb:admins" content="100000030817144" />
</head>
<body>
	<script>
        logInWithFacebook = function () {
            FB.login(function (response) {
                if (response.authResponse) {
                    //alert('You are logged in &amp; cookie set!');
					window.location.href = "fbapp.php";
                    // Now you can redirect the user or do an AJAX request to
                    // a PHP script that grabs the signed request from the cookie.
                } else {
                    //alert('User cancelled login or did not fully authorize.');
                }
            });
            return false;
        };
        window.fbAsyncInit = function () {
            FB.init({
                appId: '228450964309010',
                cookie: true, // This is important, it's not enabled by default
                version: 'v2.2'
            });
        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) { return; }
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
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
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <div style='text-align: center;padding: 0px;margin-top: 15px;margin-bottom: 15px;'>
    </div>
    <div class='container content-container question-container' style="margin-top: 25px">

        <section class='col-xs-12 col-sm-12 col-md-12'>

            <article class='row main-content-wrapper'>

                <div class='col-xs-12 col-sm-8 col-md-8'>
                    <section class='col-xs-12 col-sm-12 col-md-12'>
                        <article class='row question-row'>
                            <div class='col-xs-12 col-sm-12 col-md-12' id='question-activity-container'>
                                <!-- Start of Question Jumbotron -->
                                <div class='jumbotron question-activity-jumbotron' id='question-activity-jumbotron-section' style='background-color: #ffffff'>
                                    <!-- Start of Question Question Wrapper -->
                                    <article class='row question-question-wrapper' style='text-align: middle;'>
                                        <div class='col-xs-12 col-sm-12 col-md-12'>
                                            <div class='question-question' style='font-size: 20px'>
                                                <span style='font-size: 20px;color: #000000'>
                                                    <a onclick="fblogin();" style='color: #000000' href="#">
                                                        Your Best friends on a canvas!
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </article>
                                    <!-- End of Question Question Wrapper -->
                                    <!-- Start of Question Picture Wrapper -->
                                    <article class='row question-picture-wrapper'>
                                        <div class='col-xs-12 col-sm-12 col-md-12'>
                                            <div>
                                                <a class='question-picture' href="#">
                                                    <img src='image2.jpg' alt='Your Best friends on a canvas!' onclick="logInWithFacebook();" />
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                    <!-- End of Question Picture Wrapper -->
                                    <!-- Start of App Page Buttons Wrapper -->
                                    <article class='row question-app-page-button-wrapper' style='padding: 15px 10px 15px;' id='question-jumbotron-fb-like-button'>
                                    </article>
                                    <!-- End of App Page Buttons Wrapper -->
                                    <article class='row answer-share-wrapper text-center' id='share-facebook-wrapper-2' style='padding-top: 0px;padding-bottom: 15px'>
                                        <div class='col-xs-12 col-sm-12 col-md-12'>
                                            <table style='width:100%'>
                                                <tr>
                                                    <td class='share-call-td'>

                                                        <a href="#" onclick="logInWithFacebook();">
                                                            <div style='border: 2px solid #3d518b; background: #46629c; color: #fff; margin: 0px auto; width: 300px; padding: 10px; border-radius: 50px; '>
                                                                <div style="margin:0px auto;width:276px;" class="text-center">
                                                                    <img src='http://cdn.meaww.com/media/f_logo_with_white_back.png' />
                                                                    <span style="margin-left:10px;font-size: 15px;font-weight: bold;">Login with Facebook</span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </article>
                                    <div class="text-center" style="font-size: 15px;font-weight: normal;color: #222222;font-family: Sans-serif;line-height: 1.4; padding: 0 5px 5px 5px;">What a group of friends you have! Amazing paintings of your friendship.</div>



                                </div>
                                <!-- End of Question Jumbotron -->

                            </div>
                        </article>

                        <!-- Start of Sidebar Header Text -->
                        <!-- End of Sidebar Header Text -->
                        <!-- Start of Display other Activities -->
                        <!-- End of Display other Activities -->
                        <!-- Start of Footer Next Activities -->
                        <!-- End of Footer Next Activities -->
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
</body>
</html>