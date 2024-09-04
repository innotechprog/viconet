<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <meta name="google-signin-client_id" content="748757386943-mpirvpftkeop6qvds0i81dsjjhlqms99.apps.googleusercontent.com">
</head>
<body>
<div class="g-signin2" data-onsuccess="onSignIn"></div>
</body>
</html>
<script>
function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
}
//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
</script>
