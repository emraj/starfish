<?php
 
require 'gapi.class.php';
 
/* Set your Google Analytics credentials */
define('ga_account'     ,'analyticsumi@gmail.com');
define('ga_password'    ,'124adigital');
 
$ga = new gapi(ga_account,ga_password);
 
$gaResult = $ga->requestAccountData();
 
foreach($gaResult as $result)
{
  printf("%-30s %15d\n", $result, $result->getProfileId());
}
 
?>