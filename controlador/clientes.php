<?php

require_once 'modelo/clientes.php'; 

$objCliente = new Clientes(); 

if(isset($_POST['buscar'])){
    
    $cedula=$_POST['buscar'];

    $result=$objCliente->buscar($cedula);
    header('Content-Type: application/json');
    echo json_encode($result);
    exit;
}else if (isset($_POST['guardar'])) { 
    $errores = []; // Array para almacenar los mensajes de error

    // Validación del campo nombre
    if (empty($_POST["nombre"]) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $_POST["nombre"])) {
        $errores[] = "El nombre solo puede contener letras y espacios.";
    }

    // Validación del campo apellido
    if (empty($_POST["apellido"]) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $_POST["apellido"])) {
        $errores[] = "El apellido solo puede contener letras .";
    }

    // Validación del campo cedula_rif
    if (empty($_POST["cedula_rif"]) || !preg_match("/^[a-zA-Z0-9\-\/]+$/", $_POST["cedula_rif"])) {
        $errores[] = "La cédula/RIF solo puede contener letras, números .";
    }

    // Validación del campo teléfono
    if (!empty($_POST["telefono"]) && !preg_match("/^[0-9\s\-\(\)]+$/", $_POST["telefono"])) {
        $errores[] = "El teléfono solo puede contener números.";
    }

    // Validación del campo email
    if (!empty($_POST["email"]) && !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El email no es válido.";
    }

    $direccion = $_POST["direccion"]; // Se permite cualquier contenido

    // Si hay errores, se muestra el mensaje de error
    if (!empty($errores)) {
        $registrar = [
            "title" => "Error",
            "message" => implode(" ", $errores),
            "icon" => "error"
        ];
    } else {
        $cedula = $_POST["cedula_rif"];
        $dato = $objCliente->buscar($cedula);
        if (!$dato) {
            $objCliente->setNombre($_POST["nombre"]);
            $objCliente->setApellido($_POST["apellido"]);
            $objCliente->setCedula($_POST["cedula_rif"]);
            $objCliente->setTelefono($_POST["telefono"]);
            $objCliente->setEmail($_POST["email"]);
            $objCliente->setDireccion($direccion);

            $result = $objCliente->getRegistrar();
            if ($result == 1) {
                $registrar = [
                    "title" => "Registrado con éxito",
                    "message" => "El cliente ha sido registrado",
                    "icon" => "success"
                ];
            } else {
                $registrar = [
                    "title" => "Error",
                    "message" => "Hubo un problema al registrar el cliente",
                    "icon" => "error"
                ];
            }
        } 
    }
}
else if(isset($_POST['actualizar'])){
    if(!empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["cedula_rif"])){
        
        if($_POST['cedula_rif'] !== $_POST['origin'] && $objCliente->buscar($_POST['cedula_rif'])){

        }else {
            $objCliente->setNombre($_POST["nombre"]);
            $objCliente->setApellido($_POST["apellido"]);
            $objCliente->setCedula($_POST["cedula_rif"]);
            $objCliente->setTelefono($_POST["telefono"]);
            $objCliente->setEmail($_POST["email"]);
            $objCliente->setDireccion($_POST["direccion"]);
            $objCliente->setstatus($_POST["status"]);
            $result = $objCliente->getactualizar($_POST["codigo"]);
                if($result == 1){
                    $editar = [
                        "title" => "Editado con éxito",
                        "message" => "Los datos del cliente han sido actualizados",
                        "icon" => "success"
                    ];
                }else{
                    $editar = [
                        "title" => "Error",
                        "message" => "Hubo un problema al editar los datos del cliente",
                        "icon" => "error"
                    ];
                }
        }
    }
}else if(isset($_POST['borrar'])){
    if(!empty($_POST['clienteCodigo'])){
    $result = $objCliente->geteliminar($_POST["clienteCodigo"]);
    if ($result == 'success') {
        $eliminar = [
            "title" => "Eliminado con éxito",
            "message" => "El cliente ha sido eliminado",
            "icon" => "success"
        ];
    } elseif ($result == 'error_delete') {
        $editar = [
            "title" => "Error",
            "message" => "Hubo un problema al eliminar el cliente",
            "icon" => "error"
        ];
    }
    }
}


$registro = $objCliente->consultar();
if(isset($_POST["vista"])){
    $_GET['ruta'] = 'venta';
    //exit();
}else{
    $_GET['ruta'] = 'clientes';
}
require_once 'plantilla.php';

//Lo actualice en manuela branch, no tenia las alertas etc 
