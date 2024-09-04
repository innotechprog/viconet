<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Disappearing Pop-up</title>
  <style type="text/css">
      body {
    font-family: Arial, sans-serif;
    
}

.notification-popup {
    background-color: #3498db;
    color: #fff;
    position: absolute;
    right: 0;
    padding: 15px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    display: none;
}

.notification-popup.show {
    display: block;
    animation: fadeOut 5s ease-in-out;
}

@keyframes fadeOut {
    0% {
        opacity: 1;
    }
    100% {
        opacity: 0;
    }
}

  </style>
</head>
<body>

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Notification Popup</title>
</head>
<body>
    <div class="notification-popup" id="popup">
        <p>This is a notification message!</p>
    </div>

   
</body>
</html>


  <script src="script.js"></script>
</body>
</html>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function () {
    // Display the notification popup
    showNotification();

    // Function to show the notification popup
    function showNotification() {
        var popup = document.getElementById('popup');
        popup.classList.add('show');

        // Hide the notification after 5 seconds
        setTimeout(function () {
            popup.classList.remove('show');
        }, 5000);
    }
});

</script>