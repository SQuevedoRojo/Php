<?php
    include_once "funciones_comunes.php";
    include_once "funciones_session.php";
    include_once "tpv/apiRedsys.php";

    function imprimirPedido()
    {
        if(isset($_SESSION["cliente"]["pedido"]))
        {
            $pedido = $_SESSION["cliente"]["pedido"];
            print "<div id='pedido'><h2>Pedido</h2>";
            print "<table border='1'><tr><th>Numero Producto</th><th>Nombre Producto</th><th>Cantidad Producto</th></tr>";
            foreach ($pedido as $idProd => &$contenido) {
                print "<tr><td>$idProd</td><td>".$contenido["nombre"]."</td><td>".$contenido["cantidad"]."</td></tr>";
            }
            print "</table></div>";
        }
    }

    function eliminarPedido()
    {
        unset($_SESSION["cliente"]["pedido"]);
    }

    function imprimirProductos()
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT productCode,productName from products where quantityInStock >=0 LIMIT 20");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            foreach ($resultado as $row)
                print "<option value=".$row["productCode"].">".$row["productName"]."</option>";
        }
        catch(PDOException $e)
        {
            $conn -> rollBack();
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    function recogerDatos()
    {
        $producto = limpiar($_POST["productos"]);
        $cantidad = intval(limpiar($_POST["cantidad"]));
        return [$producto,$cantidad];
    }

    function obtenerNombreProducto($producto)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT productName from products where productCode = :producto");
            $stmt->bindParam(':producto', $producto);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            $nombre = $resultado[0]["productName"];
        }
        catch(PDOException $e)
        {
            $conn -> rollBack();
            echo "Error: " . $e->getMessage();
        }
        return $nombre;
        $conn = null;
    }

    function annadirAlPedido($producto,$cantidad)
    {
        $nombre = obtenerNombreProducto($producto);
        annadirPedido($producto,$cantidad,$nombre);
    }

    function obtenerNumeroPedido()
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT max(orderNumber) as orderNumber from orders");
            $stmt->bindParam(':producto', $producto);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            $numeroPedido = intval($resultado[0]["orderNumber"]) + 1;
        }
        catch(PDOException $e)
        {
            $conn -> rollBack();
            echo "Error: " . $e->getMessage();
        }
        return $numeroPedido;
        $conn = null;
    }

    function realizarPedido()
    {
        if(isset($_SESSION["cliente"]["pedido"]))
        {
            $numeroPedido = obtenerNumeroPedido();

            $conn = conexionBBDD();
            try
            {
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->beginTransaction();
                $stmt = $conn->prepare("INSERT INTO orders (orderNumber,orderDate,requiredDate,shippedDate,status,comments,customerNumber) values (:numeroPedido,curdate(),curdate(),null,'In Process',null,:numeroCliente)");
                $stmt->bindParam(':numeroPedido', $numeroPedido);
                $stmt->bindParam(':numeroCliente', $_SESSION["cliente"]["id"]);
                $stmt -> execute();
                $conn -> commit();
            }
            catch(PDOException $e)
            {
                $conn -> rollBack();
                echo "Error: " . $e->getMessage();
            }
            $conn = null;

            $pedido = $_SESSION["cliente"]["pedido"];
            $precioTotal = null;
            foreach ($pedido as $idProd => &$contenido) {
                $precioTotal += realizarPedidoPorProducto($idProd,$contenido["cantidad"],$numeroPedido);
            }
            list($parametros,$firma) = redireccionarPago($precioTotal);
            //insertarPago($precioTotal);
            return [$parametros,$firma];
        }
        else
            trigger_error("No hay ningun producto en el pedido para procesar");
    }

    function realizarPedidoPorProducto($producto,$cantidad,$numeroPedido)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT MSRP from products where productCode = :prod and (quantityInStock - :cantidad) >= 0");
            $stmt->bindParam(':prod', $producto);
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            if($resultado != null)
            {
                $precio = $resultado[0]["MSRP"];
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->beginTransaction();
                $stmt = $conn->prepare("UPDATE products set quantityInStock = quantityInStock - :cantidad where productCode = :producto");
                $stmt->bindParam(':producto', $producto);
                $stmt->bindParam(':cantidad', $cantidad);
                $stmt -> execute();
                $conn -> commit();
                /*****************************************************************************************************************************/
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->beginTransaction();
                $stmt = $conn->prepare("INSERT INTO orderdetails (orderNumber,productCode,quantityOrdered,priceEach,orderLineNumber) values (:numeroPedido,:producto,:cantidad,:precio,2)");
                $stmt->bindParam(':numeroPedido', $numeroPedido);
                $stmt->bindParam(':producto', $producto);
                $stmt->bindParam(':cantidad', $cantidad);
                $stmt->bindParam(':precio', $precio);
                $stmt -> execute();
                $conn -> commit();
                /*****************************************************************************************************************************/

                quitarProductoDelPedido($producto);
                print "<h2>$producto Procesado Perfectamente</h2>";
            }
            else
            {
                trigger_error("No Se Puede Procesar El Producto $producto Porque No Hay Suficiente Stock");
            }
        }
        catch(PDOException $e)
        {
            $conn -> rollBack();
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return intval($precio);
    }

    function insertarPago($precioTotal)
    {
        $conn = conexionBBDD();
        try
        {
            $stmt = $conn->prepare("SELECT checkNumber from payments");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_NUM);
            $resultado=$stmt->fetchAll();
            do{
                $cadena = generarCheckNumber();
            }while(in_array($cadena,$resultado));

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->beginTransaction();
            $stmt = $conn->prepare("INSERT INTO payments (customerNumber, checkNumber, paymentDate, amount) VALUES (:numCli, :checknumber, curdate(),:cantidad )");
            $stmt->bindParam(':numCli', $_SESSION["cliente"]["id"]);
            $stmt->bindParam(':checknumber', $cadena);
            $stmt->bindParam(':cantidad', $precioTotal);
            $stmt -> execute();
            $conn -> commit();

        }
        catch(PDOException $e)
        {
            $conn -> rollBack();
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    function generarCheckNumber()
    {
        $letras_mayusculas = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        $numeros = ["0","1","2","3","4","5","6","7","8","9"];
        $cadenaGenerada = null;
        for ($i=0; $i < 2; $i++) { 
            shuffle($letras_mayusculas);
            $cadenaGenerada = $cadenaGenerada .$letras_mayusculas[0];
        }
        for ($i=0; $i < 5; $i++) { 
            shuffle($numeros);
            $cadenaGenerada = $cadenaGenerada .$numeros[0];
        }
        return $cadenaGenerada;
    }

    function redireccionarPago($cantidadTotal)
    {
        // Se crea Objeto
        $miObj = new RedsysAPI;

        // Valores de entrada que no hemos cmbiado para ningun ejemplo
        $fuc="263100000";
        $terminal="11";
        $moneda="978";
        $trans="0";
        $url="";
        $urlOKKO="192.168.206.222/Php/Ejercicios/BBDD/Web_Pedidos/tpv/ejemploRecepcionaPet.php";
        $id=time();
        $amount=strval($cantidadTotal);	
        
        // Se Rellenan los campos
        $miObj->setParameter("DS_MERCHANT_AMOUNT",$amount);
        $miObj->setParameter("DS_MERCHANT_ORDER",$id);
        $miObj->setParameter("DS_MERCHANT_MERCHANTCODE",$fuc);
        $miObj->setParameter("DS_MERCHANT_CURRENCY",$moneda);
        $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$trans);
        $miObj->setParameter("DS_MERCHANT_TERMINAL",$terminal);
        $miObj->setParameter("DS_MERCHANT_MERCHANTURL",$url);
        $miObj->setParameter("DS_MERCHANT_URLOK",$urlOKKO);
        $miObj->setParameter("DS_MERCHANT_URLKO",$urlOKKO);

        //Datos de configuración
        $version="HMAC_SHA256_V1";
        $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';//Clave recuperada de CANALES
        // Se generan los parámetros de la petición
        $request = "";
        $params = $miObj->createMerchantParameters();
        $signature = $miObj->createMerchantSignature($kc);
        return [$params,$signature];
    }
?>