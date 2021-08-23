<?php

session_start();

$recipient = "tristan.conde95@gmail.com";

if($_POST) {
  $visitor_name = "";
  $visitor_email= "";
  $email_title= "";
  $visitor_message = "";

  if(isset($_POST['captcha_challenge']) && $_POST['captcha_challenge'] == $_SESSION ['captcha_text']) {
    if(isset($_POST['Visitor_Name'])) {
      $visitor_name = filter_var($_POST['Visitor_Name'], FILTER_SANITIZE_STRING);
    }

  if(isset($_POST['Visitor_Email'])) {
    $visitor_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['Visitor_Email']);
    $visitor_email = filter_var($visitor_email, FILTER_VALIDATE_EMAIL);
    }

  if(isset($_POST['email_title'])) {
    $email_title = filter_var($_POST['email_title'], FILTER_SANITIZE_STRING);
  }

  if(isset($_POST['visitor_message'])) {
    $visitor_message = htmlspecialchars($_POST['visitor_message']);
  }

  $headers = 'MIME-Version: 1.0' . "\r\n"
  .'Content-type: text/html; charset=utf-8' . "\r\n"
  .'From ' . $visitor_email . "\r\n";

  if(mail($recipient, $email_title, $visitor_message, $headers)) {
    echo '<h2> Thank you for contacting us. We hope to reply to you as soon as possible. You may now close the webpage. </h2>';
  } else {
    echo '<h2> We are sorry. The e-mail did not go through.</h2>';
  }
} else {
  echo '<h2>You entered an incorrect Captcha. Please try again.</h2>';
}

} else {
  echo '<h2> Something went amiss.</h2>';
}

?>
