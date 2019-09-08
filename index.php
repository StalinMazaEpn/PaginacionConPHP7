<?php
require_once('mio/db.php');

$sql = "SELECT * FROM articulos;";
$data = array();
$listadoProductos = db_query($sql,$data,true);

// echo "Datos Traidos Correctamente";
// var_dump($result);
$articulos_x_pagina = 5;
//contar articulos
$total_articulos_db = count($listadoProductos);


$numero_paginas = ceil($total_articulos_db/$articulos_x_pagina);
//echo $numero_paginas;

?>
  <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Paginación</title>
    <style>
    h1{
        margin: 1rem 0;
        font-size: 1.8em;
        text-align: center;
    }
    </style>
  </head>
  <body>
   

    <div class="container-fluid my-5">
      <h1> <h1>Paginación con PHP</h1></h1>
      <?php 
      if(!$_GET){
        header('Location:index.php?pagina=1');
      }

      if($_GET['pagina']> $numero_paginas || $_GET['pagina'] <= 0){
        header('Location:index.php?pagina=1');
      }

      $limite_minimo = ($_GET['pagina']-1)* $articulos_x_pagina;
      
      $sentenciaPaginacion = "SELECT * FROM articulos LIMIT ?,?";
      $data = array($limite_minimo,$articulos_x_pagina);
      $articulosPaginados = db_query_paginacion($sentenciaPaginacion,$data);

      ?>
      <?php foreach($articulosPaginados as $articulo){?>
        <div class="alert alert-primary" role="alert">
        <?php echo $articulo['nombre'];?>
        </div>
      <?php }?>
      <nav aria-label="...">
        <ul class="pagination">
          <li class="page-item
          <?php echo $_GET['pagina']<=1?'disabled': '';?>">
            <a class="page-link" 
            href="index.php?pagina=<?php echo $_GET['pagina']-1;?>" 
            tabindex="-1">Anterior</a>
          </li>
          <?php for($i = 0; $i < $numero_paginas; $i++){?>
            <li class="page-item 
            <?php echo $_GET['pagina']==$i+1?'active': '';?>">
              <a class="page-link" href="index.php?pagina=<?php echo $i+1;?>"><?php echo $i+1;?></a>
            </li>
          <?php }?>
          <li class="page-item
          <?php echo $_GET['pagina']>=$numero_paginas?'disabled': '';?>">
            <a class="page-link" 
            href="index.php?pagina=<?php echo $_GET['pagina']+1;?>"
            >Siguiente</a>
          </li>
        </ul>
      </nav>
    </div>
  </body>
</html>