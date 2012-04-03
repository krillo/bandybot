<?php
  require_once 'settings.php';

  function __autoload($class_name) {
    $class = DOC_ROOT."/classes/$class_name.php";
    echo $class;
    require_once $class;
  }

  $db =& new Db;
  $dbc = $db->connect();

/*
  If(!$twitterCacheArray){
    $twitterCacheArray = Twitter::getInitialTwitterStatus();
  }
*/
?>
