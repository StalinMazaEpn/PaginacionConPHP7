<?php
require_once 'config.php';
//require_once 'functions.php';

function db_query($sql, $data=array(), $is_search = false,$search_one=false){
  $db = db_connect();
  $mysql = $db->prepare($sql);
  $mysql->execute($data);

  if($is_search){
    //consultas de tipo READ
    if($search_one){
      //buscar un solo registro
      $result = $mysql->fetch(PDO::FETCH_ASSOC);
    } else{
      //buscar todos los registros
      $result = $mysql->fetchAll(PDO::FETCH_ASSOC);
    }
    $db = null;
    return $result;
  } else{
    /*CONSULTAS DE TIPO CREATE, UPDATE Y DELETE */
    $db = null;
    return true;
  }
}

function db_query_paginacion($sql, $data=array()){
  $db = db_connect();
  $mysql = $db->prepare($sql);
 
  foreach($data as $key => &$dato) {
    $mysql->bindParam($key + 1, $dato, PDO::PARAM_INT);
   // echo $key . " " . $dato . "\n";
  }  
  $mysql->execute();
  $result = $mysql->fetchAll(PDO::FETCH_ASSOC);
  $db = null;
  return $result;
 
}

/*
DEBO LLAMAR A LA FUNCION DBQUERY CON LOS SIGUIENTES CASOS
consultaSQL, datos de la consulta, booleano si es busqueda, booleano si la busqueda solo remite 1 valor

db_query(consulta,datos,true) 
//trae una consulta de varios registros
db_query(consulta,datos,true,true)
//trae una consulta de un solo registro
db_query(consulta,datos)
//ejecuta una accion como eliminar o editar, o crear y devuelve algo

*/

?>