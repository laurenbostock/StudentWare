// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
        // Logged into your app and Facebook.
        LoginProcedure();
    } else if (response.status === 'not_authorized') {
        // The person is logged into Facebook, but not your app.

    } else {
        // The person is not logged into Facebook, so we're not sure if
        // they are logged into this app or not.

    }
}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
    FB.getLoginStatus(function (response) {
        statusChangeCallback(response);
    });
}

window.fbAsyncInit = function () {
    FB.init({
        appId: '1251676381515866', //our studentware app ID
        cookie: true, //enable data access to server session
        xfbml: true, //parse social plugins on this page
        version: 'v2.5' //use version 2.5
    });

    // Now that we've initialized the JavaScript SDK, we call
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.
    FB.getLoginStatus(function (response) {
        statusChangeCallback(response);
    });

};


//Loads FB SDK asynchronously
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Here we run a very simple test of the Graph API after login is
// successful.  See statusChangeCallback() for when this call is made.
function LoginProcedure() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function (response) {
        var fb_user_id = response.id;
        var fb_user_name = response.name;
        var social_network = 'facebook';
        social_network.toLowerCase();
        console.log('Successful login for: ' + fb_user_name);
        console.log('this is the facebook id ' + fb_user_id);
        document.cookie='verified_fb_user_id'+'='+fb_user_id;
        document.cookie='verified_fb_user_name'+'='+fb_user_name;
        document.cookie='social_network'+'='+social_network;
        //redirect to modules page
        window.location.href='modulePage.php';
    });


}

