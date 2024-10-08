<?php
    $num = substr($_REQUEST['num'],0,strpos($_REQUEST['num'],'/'));
    $baseOriginal = substr($_REQUEST['num'],strpos($_REQUEST['num'],'/')+1,strlen($_REQUEST['num']));
    $baseNueva = limpiar($_REQUEST['base']);

    echo "EL numero " . $num . " en base " . $baseOriginal . " es " . base_convert($num,$baseOriginal,$baseNueva) . " en la base " . $baseNueva ;

    function limpiar($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
?>