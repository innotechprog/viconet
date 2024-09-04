<?php
   include '../include/connect.php';
   //include 'assets/classes/auth.php';
   include 'assets/classes/audio_content_class.php';
  $content = new Audio_content($db);
  $enemail = $_GET['enemail'];
  $podcast_name = $_GET['ep'];
  $content->addOpenedEmail($enemail,$podcast_name);
?>