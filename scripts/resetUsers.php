#!/usr/bin/php
<?php
  echo date('Y-m-d H:i:s') . ' start resetUsers()';
  require_once("/var/www/boyhappy.se/bandybot/init.php");  
  //User::setUsers(User::NOT_REG);
  User::resetUsers();
  echo date('Y-m-d H:i:s') . ' stop resetUsers()';
?>
