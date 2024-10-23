<?php

function errores ($error_level,$error_message)
{
  echo "Codigo error: </b> $error_level  - <b> Mensaje: $error_message </b><br>";
  echo "Finalizando script <br>";
  die();  
}

set_error_handler("errores");
?>