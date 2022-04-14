<?php
  header('Content-Type: application/json; charset=UTF-8');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET,POST');
  header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods');

  $json = file_get_contents('php://input');
  $arr = json_decode($json, true);

  /*
  $name = $arr['name'];
  $email = $arr['email'];
  $phone = $arr['phone'];
  $website = $arr['website'];
  $message = $arr['message'];

  define('TO', 'mynkbhurani@gmail.com');
  define('SUBJECT', $name);
  define('MESSAGE', "Name: $name\nEmail: $email\nPhone: $phone\nWebsite: $website\n\nMessage:\n$message\n\nRegards,\n$name");
  define('FROM', "$name <$email>");

  $txt = mail(TO, SUBJECT, MESSAGE, FROM) ? 'Your message has been sent' : 'Sorry, failed to send your message!';
  echo $txt;
  */

  // Entry in JSON file
  $file = '../json/msg.json';

  if(file_exists($file)){
    $msgJson = file_get_contents($file);
    $msgArr = json_decode($msgJson, true);
    $arr['id'] = end($msgArr)['id'] + 1;
  }else{
    $arr['id'] = 1;
  }

  date_default_timezone_set('Asia/Kolkata');
  $arr['datetime'] = date('Y-m-d H:i:s');

  $msgArr[] = $arr;
  $json = json_encode($msgArr, JSON_PRETTY_PRINT);
  $txt = file_put_contents($file, $json) ? 'Your message has been sent' : 'Sorry, failed to send your message!';
  echo $txt;
?>