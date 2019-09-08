<?php


function db_connect () {
  $dsn = 'mysql:host=localhost;dbname=yt_colores';
  $user = 'root';
  $pass = '';
  $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

  try{
    $db = new PDO($dsn,$user,$pass,$options);
    // echo '<script>alert("Conectado")</script>';
    return $db;
  } catch( PDOException $e){
    echo '<p>!Error!: <mark>' . $e->getMessage() . '</mark></p>';
    die();
  }


}


?>