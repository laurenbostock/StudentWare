/**
 * Created by fmerzadyan on 21/11/15.
 */

function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName(0));
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail());
    var google_user_id = profile.getId();
    var google_user_name = profile.getName(0);
    var google_user_email = profile.getEmail();
    var social_network = 'google';
    social_network.toLowerCase();
    document.cookie='verified_google_user_id'+'='+google_user_id;
    document.cookie='verified_google_user_name'+'='+google_user_name;
    document.cookie='verified_google_user_email'+'='+google_user_email;
    document.cookie='social_network'+'='+social_network;
    window.location.href='modulePage.php';

    /**
     * Need to connect to backend to verify so replace yourbackend.example/tokensignin
     * edit: I changed it to point to register.php
     * with appropriate PHP file
     */
    //var id_token = googleUser.getAuthResponse().id_token;
    //var x = new XMLHttpRequest();
    //x.open('POST', 'http://localhost:63342/studentware/register.php');
    //x.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    //x.onload = function () {
    //    console.log('Signed in as: ' + x.responseText);
    //};
    //x.send('idtoken=' + id_token);
}


function onSuccess(googleUser) {
    console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
}
function onFailure(error) {
    console.log(error);
}
function renderButton() {
    gapi.signin2.render('g-signin2', {
        'scope': 'https://www.googleapis.com/auth/plus.login',
        'width': 200,
        'height': 50,
        'longtitle': true,
        'theme': 'dark',
        'onsuccess': onSuccess,
        'onfailure': onFailure
    });
}


//use <a href="#" onclick="signOut();">Sign out</a> in html file to call this
function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
        console.log('User signed out.');
    });
}

function getUserData() {
    // auth2 is initialized with gapi.auth2.init() and a user is signed in.
    if (auth2.isSignedIn.get()) {
        var profile = auth2.currentUser.get().getBasicProfile();
        console.log('ID: ' + profile.getId());
        console.log('Name: ' + profile.getName());
        console.log('Image URL: ' + profile.getImageUrl());
        console.log('Email: ' + profile.getEmail());
    }

}


