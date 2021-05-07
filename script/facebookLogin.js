window.fbAsyncInit = function() {
    FB.init({
      appId      : '365816501531607',
      cookie     : true,                     // Enable cookies to allow the server to access the session.
      xfbml      : true,                     // Parse social plugins on this webpage.
      version    : 'v10.0'           // Use this Graph API version for this call
    });

    FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
        prepWebsite(response);        // Returns the login status.
    });
};

function checkLogin(){
    returnStatement="";
    console.log("checkLogin called");
    FB.getLoginStatus(function(response) {
        console.log(response);
        if(response.status==="connected"){
            alert("Person is connected");
            //now load the person's name and profile image in the nav bar
            FB.api('/me', function(response) {
                console.log("getting profile info");
                console.log(response);
                document.getElementById("profileName").innerHTML= response.name;
                document.getElementById("logOutBtn").classList.remove("collapse");
              });
            returnStatement =  "connected";
        }
        else{
            alert("Person is not connected");
            returnStatement = "not connected";
            if(confirm("Do you want to log into facebook?")){
                logIn();
            }
            else{
                pass;
            }
        }
    });
    return returnStatement;
}


function logOut(){
    FB.logout(function(response) {
        // Person is now logged out
        alert("Logged out from Facebook");
        document.getElementById("logOutBtn").classList.add("collapse");
        document.getElementById("profileName").innerHTML="Not logged in";
     });
}

function logIn(){
    FB.login(function(response) {
        // handle the response
        checkLogin();
      }, {scope: 'public_profile,email'});
}

function prepWebsite(response){
    if(response.status==="connected"){
        FB.api('/me', function(response) {
            console.log("getting profile info");
            console.log(response);
            document.getElementById("profileName").innerHTML= response.name;
            console.log("id = " + response.id);
            document.getElementById("logOutBtn").classList.remove("collapse");
          });
          FB.api(
            '/me/picture/',
            'GET',
            {},
            function(response) {
                // Insert your code here
                console.log(response);
            }
          );

    }
}