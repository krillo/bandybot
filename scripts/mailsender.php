#!/usr/bin/php
<?php
require_once("/var/www/boyhappy.se/bandybot/init.php");

$to = User::getAllEmailAdresses();


switch ($argv[1]) {
  case 1:
    $subject = 'Innebandy vecka ' . date('W') . ", Betala 300:-";
    break;
  case 2:
    $subject = 'Innebandypåminnelse vecka ' .date('W') . ", Betala 300:-";
    break;
  case 3:
    $subject = 'Innebandystatus kl 19, vecka ' . date('W') . ", Betala 300:-";
    break;
  default:
    $subject = 'Innebandy vecka ' . date('W') . ", Betala 300:-";
    break;
}

if(isset($argv[2])){
  $param = $argv[2];
} else {
  $param = '';
}
switch ($param) {
  case 'test':
    $to = User::getAllEmailAdresses(true);  //get only a test address
    break;
  default:   //mail will be sent everybody
    break;
}


$resArray = User::getUsersByStatus((int) User::ATTENDING);
$message = 'Vecka ' . date('W');
$message .= " \n \n";
$message .= "KOMMER (" . count($resArray) . ")\n";
$message .= "------ \n";
foreach ($resArray as $user) {
  $message .= $user['name'] . " -  " . $user['comment'] . "\n";
}

$resArray = User::getUsersByStatus((int) User::MABY);
$message .= " \n \n";
$message .= "KANSKE (" . count($resArray) . ")\n";
$message .= "------ \n";
foreach ($resArray as $user) {
  $message .= $user['name'] . " -  " . $user['comment'] . "\n";
}


$resArray = User::getUsersByStatus((int) User::NOT_ATTENDING);
$message .= " \n \n";
$message .= "KOMMER INTE (" . count($resArray) . ")\n";
$message .= "----------- \n";
foreach ($resArray as $user) {
  $message .= $user['name'] . " -  " . $user['comment'] . "\n";
}


$resArray = User::getUsersByStatus((int) User::NOT_REG);
$message .= " \n \n";
$message .= "ÄNNU INTE REGGADE (" . count($resArray) . ")\n";
$message .= "----------- \n";
foreach ($resArray as $user) {
  $message .= $user['name'] . " -  " . $user['comment'] . "\n";
}


if ($argv[1] < 3) {
  $message .= " \n \n";
  $message .= "Nu är det dax att betala 300 kr perman  \n"; 



$message .= "Cash eller på mitt konto: \n";
$message .= "SEB 5365-0245787  \n\n";

$message .= "Putti - 300kr \n";
$message .= "Fredrik - BET \n";
$message .= "Anders O - 300kr \n";
$message .= "Robban - 300kr \n";
$message .= "Deffe - 300kr \n";
$message .= "Niklas - 300kr \n";
$message .= "Staffan - 300kr \n";
$message .= "Rickard - 300kr \n";
$message .= "Björn - BET \n";
$message .= "Anders N -  BET \n";
$message .= "Frippe - 300kr \n";


  $message .= "Regga er på: \n";
  $message .= "http://bandybot.boyhappy.se \n";
  $message .= " \n";
  $message .= "Alla uppdateringas twittras ut av bandybot, så följ bandybot på twitter \n";
  $message .= "http://twitter.com/bandybot \n";
  $message .= " \n";
  $message .= " \n";
  $message .= "Plats och datumen för denna omgång: \n";
  $message .= "Tis 20-21,  Elinebergskolan \n";
  $message .= "2011-08-23  -  2011-12-20     2520:- \n";
  $message .= "2012-01-10  -  2012-05-29     2940:- \n";
  $message .= " \n";
  $message .= " \n";
  $message .= "/Putti \n";
}

$headers = 'From: bandybot@boyhappy.se' . "\r\n";
$headers .= 'Reply-To: bandybot@boyhappy.se' . "\r\n";
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/plain; charset=iso-8859-1' . "\r\n";

//echo $message;
mail($to, $subject, $message, $headers);
?>
