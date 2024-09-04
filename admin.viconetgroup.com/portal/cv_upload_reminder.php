#!/usr/bin/php
<?php

include 'assets/classes/connect.php';
require_once "assets/classes/reminders_class.php";
require_once "assets/classes/functions.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'assets/PHPMailer/Exception.php';
require 'assets/PHPMailer/PHPMailer.php';
require 'assets/PHPMailer/SMTP.php';

// Variable declaring and assigning
$reminder = new Reminder($db);
$candidate = new Candidates($db);
$query = $reminder->getAllTalentWithoutCV();
$emailType = 'CV upload reminder';

for ($x = 0; $rows = $query->fetch(); $x++) {
    if ($rows['num_reminder'] == 0) {
        $mail = new PHPMailer(true);
        $userName = $rows['c_name'];
        $userEmail = $rows['email'];
        $encryEmail = md5($userEmail);
        include "cv reminders/reminder_0.php";
        $candidate->incrementNumRem($userEmail);
        $candidate->trackEmailSentout($userEmail,$emailType,1);
        //echo "1";
    } else if ($rows['num_reminder'] == 1) {
        $mail = new PHPMailer(true);
        $userName = $rows['c_name'];
        $userEmail = $rows['email'];
        $encryEmail = md5($userEmail);
        include "cv reminders/reminder_1.php";
        $candidate->incrementNumRem($userEmail);
        $candidate->trackEmailSentout($userEmail,$emailType,2);
        //echo "2";
    } else if ($rows['num_reminder'] == 2) {
        $mail = new PHPMailer(true);
        $userName = $rows['c_name'];
        $userEmail = $rows['email'];
        $encryEmail = md5($userEmail);
        include "cv reminders/reminder_2.php";
        $candidate->incrementNumRem($userEmail);
        $candidate->trackEmailSentout($userEmail,$emailType,3);
       // echo "3";
    }
}
echo "Reminder Email sent";