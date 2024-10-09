<?php
  $num = substr($_REQUEST['num'],0,strpos($_REQUEST['num'],'/'));
  $baseNueva = limpiar($_REQUEST['base']);

  operaciones($num,$baseNueva);

  function operaciones($num,$baseNueva)
  {
    $baseOriginal = substr($_REQUEST['num'],strpos($_REQUEST['num'],'/')+1,strlen($_REQUEST['num']));
    imprimir($num,$baseOriginal,$baseNueva);
  }

  function imprimir($num,$baseOriginal,$baseNueva)
  {
    print "El numero " . $num . " en base " . $baseOriginal . " es " . base_convert($num,$baseOriginal,$baseNueva) . " en la base " . $baseNueva ;
  }

  function limpiar($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>