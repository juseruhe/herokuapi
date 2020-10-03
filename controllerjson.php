<?php
require_once ('modelojson.php');

class Controllerjson{

    public function createUsuarioController($ID_Tipo_Documento, $ID_Usuario, $Primer_Nombre, $Segundo_Nombre, $Primer_Apellido, $Segundo_Apellido, $fecha_nacimiento, $Telefono, $Correo, $Contrasena, $confirmar_Contrasena, $ID_Genero, $ID_Ciudad, $direccion, $observaciones, $ID_Rol){
        $datosController = array("ID_Tipo_Documento"=>$ID_Tipo_Documento,
        "ID_Usuario"=>$ID_Usuario,
        "Primer_Nombre"=>$Primer_Nombre,
        "Segundo_Nombre"=>$Segundo_Nombre,
        "Primer_Apellido"=>$Primer_Apellido,
        "Segundo_Apellido"=>$Segundo_Apellido,
        "fecha_nacimiento"=>$fecha_nacimiento,
        "Telefono"=>$Telefono,
        "Correo"=>$Correo,
        "Contrasena"=>$Contrasena,
        "confirmar_Contrasena"=>$confirmar_Contrasena,
        "ID_Genero"=>$ID_Genero,
        "ID_Ciudad"=>$ID_Ciudad,
        "direccion"=>$direccion,
        "observaciones"=>$observaciones,
        "ID_Rol"=>$ID_Rol); 

        $respuesta = Datos::createUsuarioModel($datosController,"usuario");
        return $respuesta;
    }

    public function readUsuarioController($Correo){
        $respuesta = Datos::readUsuarioModel($Correo,"usuario");
        return $respuesta;
    }

    public function updateUsuariosController($ID_Tipo_Documento,$ID_Usuario,$Primer_Nombre,$Segundo_Nombre,
    $Primer_Apellido,$Segundo_Apellido,$fecha_nacimiento,$Telefono,$Correo,$Contrasena,
    $confirmar_Contrasena,$ID_Genero,$ID_Ciudad,$direccion,$observaciones)
    {
    $datosController = array("ID_Tipo_Documento" => $ID_Tipo_Documento,"ID_Usuario"=>$ID_Usuario,
    "Primer_Nombre"=>$Primer_Nombre,"Segundo_Nombre" =>$Segundo_Nombre,
    "Primer_Apellido" =>$Primer_Apellido,"Segundo_Apellido"=>$Segundo_Apellido,
    "fecha_nacimiento" =>$fecha_nacimiento,"Telefono" =>$Telefono,"Correo"=>$Correo,
    "Contrasena" =>$Contrasena,"confirmar_Contrasena"=>$confirmar_Contrasena,"ID_Genero"=>$ID_Genero,
    "ID_Ciudad" =>$ID_Ciudad,"direccion" =>$direccion,"observaciones"=>$observaciones);
    $respuesta= Datos::updateUsuarioModel($datosController,"usuario");
    return $respuesta;
    }

   public function updateUsuarioAdminiController($ID_Usuario,$Primer_Nombre,$Segundo_Nombre,$Primer_Apellido,
   $Segundo_Apellido,$fecha_nacimiento,$Telefono,$Correo,$ID_Genero,$ID_Ciudad,$direccion,$observaciones)
   {

    $datosController = array("ID_Usuario"=>$ID_Usuario,
    "Primer_Nombre"=>$Primer_Nombre,"Segundo_Nombre" =>$Segundo_Nombre,
    "Primer_Apellido" =>$Primer_Apellido,"Segundo_Apellido"=>$Segundo_Apellido,
    "fecha_nacimiento" =>$fecha_nacimiento,"Telefono" =>$Telefono,"Correo"=>$Correo,
    "ID_Genero"=>$ID_Genero,"ID_Ciudad" =>$ID_Ciudad,"direccion" =>$direccion,"observaciones"=>$observaciones);
    $respuesta= Datos::updateUsuarioAdminModel($datosController,"usuario");
    return $respuesta;




   }






    public function deleteUsuarioController($ID_Usuario,$ID_Tipo_Documento){
        $respuesta = Datos::deleteUsuarioModel($ID_Usuario,$ID_Tipo_Documento, "usuario");
        return $respuesta;
    }

    public function loginUsuarioController($Correo, $Contrasena){
        $datosController = array("Correo"=>$Correo, "Contrasena"=>$Contrasena);
        $respuesta = Datos::loginUsuarioModel($datosController, "usuario");
        return $respuesta;
    }

    public function mostrarcontrasenaController($Correo,$ID_Usuario){
        $respuesta = Datos::mostrarcontrasenaModel($Correo,$ID_Usuario,"usuario");

        return $respuesta;

    }


    public function createProductoController($ID_Producto,$Nombre_Producto,$destino,$Imagen_Producto,$Talla,$Color,$Material,$Valor,$Descripcion,$ID_categoria,$ID_clasificacion){

        $datosController = array("ID_Producto"=>$ID_Producto,
        "Nombre_Producto"=>$Nombre_Producto,
        "Imagen_Producto"=>$destino,
        "IMG"=> $Imagen_Producto,
        "Talla"=>$Talla,
        "Color"=>$Color,
        "Material"=>$Material,
        "Valor"=>$Valor,
        "Descripcion"=>$Descripcion,
        "ID_categoria"=>$ID_categoria,
        "ID_clasificacion"=>$ID_clasificacion);
        
        $respuesta = Datos::createProductoModel($datosController,"producto");
        return $respuesta;


    }

  public function updateProductoController($ID_Producto,$Nombre_Producto,$destino,$Imagen_Producto,
  $Talla,$Color,$Material,$Valor,$Descripcion,$ID_categoria,$ID_clasificacion){

    $datosController = array("ID_Producto"=>$ID_Producto,
    "Nombre_Producto"=>$Nombre_Producto,
    "Imagen_Producto"=>$destino,
    "IMG"=> $Imagen_Producto,
    "Talla"=>$Talla,
    "Color"=>$Color,
    "Material"=>$Material,
    "Valor"=>$Valor,
    "Descripcion"=>$Descripcion,
    "ID_categoria"=>$ID_categoria,
    "ID_clasificacion"=>$ID_clasificacion);


    $respuesta = Datos::updateProductoModel($datosController,"producto");
   
    return $respuesta;
  }
  public function deleteProductoController($ID_Producto){

    $respuesta = Datos::deleteProductoModel($ID_Producto, "producto");
    return $respuesta;

  }
}
?>