<?php
require_once 'controllerjson.php';
require_once 'modelojson.php';

function ParametrosDisponibles($params){
    $disponible = true;
    $faltantes = "";

    foreach($params as $param){
        if(!isset($_POST[$param]) || strlen($_POST[$param]) <=0){
            $disponible = false;
            $faltantes = $faltantes . ",". $param;
        }
    }

    if(!$disponible){
        $respuesta = array();
        $respuesta['error'] = true;

        $respuesta['mensaje'] = 'Parametro: ' . substr($faltantes, 1, strlen($faltantes)). 'vacio';
        echo json_encode($respuesta);

        // api

        //detener la ejecucion
        die();
    }
}
$respuesta = array();

if(isset($_GET['apicall'])){

    switch($_GET['apicall']){
        case 'createusuario':

            ParametrosDisponibles(array('ID_Tipo_Documento', 'ID_Usuario', 'Primer_Nombre', 'Primer_Apellido',  'fecha_nacimiento', 'Telefono', 'Correo', 'Contrasena', 'confirmar_Contrasena', 'ID_Genero', 'ID_Ciudad', 'direccion', 'ID_Rol'));
            if($_POST["ID_Tipo_Documento"]=="" || $_POST["ID_Usuario"]=="" ||  

            $_POST["Primer_Nombre"]=="" ||  $_POST["Primer_Apellido"]=="" || $_POST["fecha_nacimiento"]=="" ||  

            $_POST["Telefono"]=="" ||  $_POST["Correo"]=="" ||  $_POST["Contrasena"]=="" ||  

            $_POST["confirmar_Contrasena"]=="" ||  $_POST["ID_Genero"]=="" ||  $_POST["ID_Ciudad"]=="" ||  

            $_POST["ID_Rol"]=="" ||  $_POST["direccion"]==""   )

            {
                echo " <h3> Hay Datos Vaciós Por Favor Llenarlos </h3>
                <a href='registrarse.html'> Registrarse </a>
                <a href='index.html'> Ir a la Página Principal </a>
                ";   
            }

            else if ($_POST["Contrasena"] != $_POST["confirmar_Contrasena"]  ){

                echo "<h3> Contraseñas no coinciden por Favor intente de nuevo </h3>
                <a href='registrarse.html'> Registrarse </a>
                <a href='index.html'> Ir a la Página Principal </a>";
            }

            else {

            $ID_Tipo_Documento = $_POST["ID_Tipo_Documento"];


            switch($_POST["ID_Tipo_Documento"]){
                case "Cédula de Ciudadanía" : $ID_Tipo_Documento= "TD01";
            break;
                case "Cédula de Extranjería" : $ID_Tipo_Documento= "TD02";
            break;
                case "Tarjeta de Identidad" : $ID_Tipo_Documento= "TD03";
            break;
                case "Pasaporte Extranjero" : $ID_Tipo_Documento= "TD04";
            break;
                case "Registro Cívil" : $ID_Tipo_Documento= "TD05";
            break;


            default: echo "No es valido Tipo de Documento";
            break;
            }

            $ID_Usuario = $_POST["ID_Usuario"];
            $Primer_Nombre = $_POST["Primer_Nombre"];
            $Segundo_Nombre = $_POST["Segundo_Nombre"];
            $Primer_Apellido = $_POST["Primer_Apellido"];
            $Segundo_Apellido = $_POST["Segundo_Apellido"];
            $fecha_nacimiento = $_POST["fecha_nacimiento"];
            $Telefono = $_POST["Telefono"];
            $Correo = $_POST["Correo"];
            $Contrasena = $_POST["Contrasena"];
            $confirmar_Contrasena = $_POST["confirmar_Contrasena"];
            $ID_Genero = $_POST["ID_Genero"] ;

            if ($ID_Genero == "Masculino"){
                $ID_Genero = "GEN01";
            }else if ($ID_Genero == "Femenino"){
                $ID_Genero= "GEN02";
            }else {
                $ID_Genero = "";
            }

            $ID_Ciudad = $_POST["ID_Ciudad"];

            switch ($_POST["ID_Ciudad"]){
            case "Bogotá":  $ID_Ciudad = "CIU008";
            break;

            case "Cali":  $ID_Ciudad = "CIU012";
            break;

            case "Medellín":  $ID_Ciudad = "CIU039";
            break;
            }
            $direccion = $_POST["direccion"];

            $observaciones = $_POST["observaciones"];

            $ID_Rol = $_POST["ID_Rol"];

            if ($_POST["ID_Rol"] == "Usuario") {

            $ID_Rol= "ROL01";
            }

            else if ($_POST["ID_Rol"] == "Administrador" ){

                $ID_Rol = "ROL02";
            }else {
            }

            $db = new Controllerjson();
            $result = $db->createUsuarioController($ID_Tipo_Documento,$ID_Usuario,$Primer_Nombre,
            $Segundo_Nombre,$Primer_Apellido,$Segundo_Apellido,$fecha_nacimiento,$Telefono,$Correo,$Contrasena,
            $confirmar_Contrasena,$ID_Genero,$ID_Ciudad,$direccion,$observaciones,$ID_Rol);

               
        if($result){
            $respuesta['error'] = false;
            $respuesta['mensaje'] = 'Usuario agregado correctamente';
            
        }else{
            $respuesta['error'] = true;
            $respuesta['mensaje'] = 'Ocurrio un error intenta nuevamente';
        }
    }
    break;

    case 'readusuario':
        ParametrosDisponibles(array('Correo'));
        $db = new Controllerjson();
        $result = $db->readUsuarioController($_POST["Correo"]);
        $respuesta['error'] = false;
        $respuesta['mensaje'] = 'Solicitud completada correctamente';
        $respuesta['contenido'] = $db->readUsuarioController($_POST["Correo"]);

    break;


    case 'loginusuario':
        session_start();
        ParametrosDisponibles(array('Correo', 'Contrasena'));
        $db = new Controllerjson();
        $result = $db->loginUsuarioController($_POST['Correo'], $_POST['Contrasena']);
        


        if(!$result){
            $respuesta['error'] = true;
            $respuesta['mensaje'] = 'Contrasena incorrecta';
        }else{
            $respuesta['error'] = false;
            $respuesta['mensaje'] = 'Bienvenido';
            $respuesta['contenido'] = $result;
        }
    break;

    case 'updateusuario':
 ParametrosDisponibles(array('ID_Tipo_Documento','ID_Usuario','Primer_Nombre', 
 'Primer_Apellido','fecha_nacimiento', 'Telefono', 'Correo', 
 'Contrasena','ID_Genero', 'ID_Ciudad', 'direccion', 'observaciones'));

 


if(($_POST["ID_Tipo_Documento"]=="" || $_POST["ID_Tipo_Documento"]== null ) ||
($_POST["ID_Usuario"]=="" || $_POST["ID_Usuario"]== null ) ||
($_POST["Primer_Nombre"]=="" || $_POST["Primer_Nombre"]== null ) || ($_POST["Primer_Apellido"]==""
|| $_POST["Primer_Apellido"]==null ) || ($_POST["fecha_nacimiento"]=="" || 
$_POST["fecha_nacimiento"]== null ) ||($_POST["Telefono"]=="" ||  $_POST["Telefono"]==null ) 
|| ($_POST["Correo"]=="" || $_POST["Correo"]== null)  || ($_POST["Contrasena"]=="" || 
$_POST["Contrasena"]== null)  || ($_POST["ID_Genero"]=="" || $_POST["ID_Genero"]==null ) 
||($_POST["ID_Ciudad"]=="" || $_POST["ID_Ciudad"]== null  ) || 
  ($_POST["direccion"]=="" || $_POST["direccion"]== null ))
        {
            echo " <h3> Hay Datos Vaciós Por Favor Llenarlos </h3>
            <a href='usuarioactualizar.php'> Volver a Actualizar Datos </a>
            <a href='menuusuario.php'> Ir a Menú Usuario </a>";   
        }
        else {

            $ID_Tipo_Documento = $_POST["ID_Tipo_Documento"];

            switch($_POST["ID_Tipo_Documento"]){
                case "Cedula de Ciudadania" : $ID_Tipo_Documento= "TD01";
            break;
                case "Cedula de Extranjeria" : $ID_Tipo_Documento= "TD02";
            break;
                case "Tarjeta de Identidad" : $ID_Tipo_Documento= "TD03";
            break;
                case "Pasaporte Extranjero" : $ID_Tipo_Documento= "TD04";
            break;
                case "Registro Cívil" : $ID_Tipo_Documento= "TD05";
            break;


            default: echo "No es valido Tipo de Documento";
            break;
            }




     
        $ID_Usuario= $_POST["ID_Usuario"];
        
        $ID_Genero = $_POST["ID_Genero"];
    
        if($ID_Genero == "Masculino"){
            $ID_Genero = "GEN01";
        }
        elseif($ID_Genero == "Femenino"){
            $ID_Genero= "GEN02";
        }
        else{
            $ID_Genero = "";
        };
        $ID_Ciudad=$_POST["ID_Ciudad"];
        switch($_POST["ID_Ciudad"]){
            case "Bogotá":$ID_Ciudad="CIU008";
            break;
        
            case "Cali":$ID_Ciudad="CIU012";
            break;
            
            case "Medellín":$ID_Ciudad="CIU039";
            break;   
            };
        $Primer_Nombre=$_POST["Primer_Nombre"];
        $Segundo_Nombre=$_POST["Segundo_Nombre"];
        $Primer_Apellido=$_POST["Primer_Apellido"];
        $Segundo_Apellido=$_POST["Segundo_Apellido"];
        $fecha_nacimiento=$_POST["fecha_nacimiento"];
        $Telefono=$_POST["Telefono"];
        $Correo=$_POST["Correo"];
        $Contrasena= $_POST["Contrasena"];
        $confirmar_Contrasena = $_POST["Contrasena"];
        $direccion=$_POST["direccion"];
        $observaciones=$_POST["observaciones"];

        $db = new Controllerjson();
        $result = $db->updateUsuariosController($ID_Tipo_Documento,$ID_Usuario,$Primer_Nombre,$Segundo_Nombre,$Primer_Apellido,$Segundo_Apellido,$fecha_nacimiento,$Telefono,$Correo,$Contrasena,$confirmar_Contrasena,$ID_Genero,$ID_Ciudad,$direccion,$observaciones);

        }
        
    break;


    case 'updateadminusuario':
        ParametrosDisponibles(array('ID_Usuario','Primer_Nombre', 
        'Primer_Apellido','fecha_nacimiento', 'Telefono', 'Correo', 
        'ID_Genero', 'ID_Ciudad', 'direccion', 'observaciones'));
       
        
       
       
       if( 
       ($_POST["ID_Usuario"]=="" || $_POST["ID_Usuario"]== null ) ||
       ($_POST["Primer_Nombre"]=="" || $_POST["Primer_Nombre"]== null ) || ($_POST["Primer_Apellido"]==""
       || $_POST["Primer_Apellido"]==null ) || ($_POST["fecha_nacimiento"]=="" || 
       $_POST["fecha_nacimiento"]== null ) ||($_POST["Telefono"]=="" ||  $_POST["Telefono"]==null ) 
       || ($_POST["Correo"]=="" || $_POST["Correo"]== null)  ||   ($_POST["ID_Genero"]=="" || 
       $_POST["ID_Genero"]==null ) 
       ||($_POST["ID_Ciudad"]=="" || $_POST["ID_Ciudad"]== null  ) || 
         ($_POST["direccion"]=="" || $_POST["direccion"]== null ))
               {
                   echo " <h3> Hay Datos Vaciós Por Favor Llenarlos </h3>
                   <a href='usuarioactualizar.php'> Volver a Actualizar Datos </a>
                   <a href='menuusuario.php'> Ir a Menú Usuario </a>";   
               }
               else {
       
        
            
               $ID_Usuario= $_POST["ID_Usuario"];
               
               $ID_Genero = $_POST["ID_Genero"];
           
               if($ID_Genero == "Masculino"){
                   $ID_Genero = "GEN01";
               }
               elseif($ID_Genero == "Femenino"){
                   $ID_Genero= "GEN02";
               }
               else{
                   $ID_Genero = "";
               };
               $ID_Ciudad=$_POST["ID_Ciudad"];
               switch($_POST["ID_Ciudad"]){
                   case "Bogotá":$ID_Ciudad="CIU008";
                   break;
               
                   case "Cali":$ID_Ciudad="CIU012";
                   break;
                   
                   case "Medellín":$ID_Ciudad="CIU039";
                   break;   
                   };
               $Primer_Nombre=$_POST["Primer_Nombre"];
               $Segundo_Nombre=$_POST["Segundo_Nombre"];
               $Primer_Apellido=$_POST["Primer_Apellido"];
               $Segundo_Apellido=$_POST["Segundo_Apellido"];
               $fecha_nacimiento=$_POST["fecha_nacimiento"];
               $Telefono=$_POST["Telefono"];
               $Correo=$_POST["Correo"];
               $direccion=$_POST["direccion"];
               $observaciones=$_POST["observaciones"];
       
               $db = new Controllerjson();
               $result = $db->updateUsuarioAdminiController($ID_Usuario,$Primer_Nombre,$Segundo_Nombre,$Primer_Apellido,$Segundo_Apellido,$fecha_nacimiento,$Telefono,$Correo,$ID_Genero,$ID_Ciudad,$direccion,$observaciones);
       
               }
               
           break;

    case 'mostrarcontrasena':
        ParametrosDisponibles(array('Correo','ID_Usuario'));
        $db = new Controllerjson();
      $result = $db->mostrarcontrasenaController($_POST['Correo'],$_POST['ID_Usuario']);
      
      $respuesta = $result;
    break;
    

    case 'deleteusuario':
        ParametrosDisponibles(array('ID_Usuario','ID_Tipo_Documento'));
        $db = new Controllerjson();
        $result = $db->deleteUsuarioController($_POST['ID_Usuario'], $_POST['ID_Tipo_Documento']);
        
        if(!$result){
            $respuesta['error'] = false;
            $respuesta['mensaje'] = 'Usuario Eliminado';
        }else{
            $respuesta['error'] = true;
            $respuesta['mensaje'] = 'Usuario no Existe';
        }
    break;


   case 'createproducto':
    ParametrosDisponibles(array('ID_Producto', 'Nombre_Producto','Talla', 'Color', 'Material', 'Valor', 'Descripcion', 'ID_categoria', 'ID_clasificacion'));

    $ID_Producto =  $_POST["ID_Producto"];
    $Nombre_Producto =  $_POST["Nombre_Producto"];

    $Imagen_Producto= $_FILES["Imagen_Producto"]["name"];
 
    if(isset($Imagen_Producto) && $Imagen_Producto= $_FILES["Imagen_Producto"]["name"] != ""){
        $Imagen_Producto= $_FILES["Imagen_Producto"]["name"];
      $ruta= $_FILES["Imagen_Producto"]["tmp_name"];
      $destino="../administrador/fotos/".$Imagen_Producto;
     
      copy($ruta,$destino);
      
      }
      else {    
      $destino = $Nombre_Producto;
      }
  
    $Talla=$_POST["Talla"];
    $Color= $_POST["Color"];
    $Material=$_POST["Material"];
    $Valor=$_POST["Valor"];
    $Descripcion=$_POST["Descripcion"];
    $ID_categoria= $_POST["ID_categoria"];
    
    switch ($ID_categoria) {
    
    case "Chaquetas" :    $ID_categoria = "CAT01";
    break;
    
    case"Pantalones" :    $ID_categoria = "CAT02";
    break;
    
    case "Formal" :    $ID_categoria = "CAT03";
    break;
    
    case "Informal" :    $ID_categoria = "CAT04";
    break;
    
    case "Blusa" :    $ID_categoria = "CAT05";
    break;
    
    default: "";
    break;
    
    }
    
    $ID_clasificacion= $_POST['ID_clasificacion'];
    switch ($ID_clasificacion) {
    
      case"Unisex" :    $ID_clasificacion = "CLAS01";
      break;
      
      case "Mujeres" :    $ID_clasificacion = "CLAS02";
      break;
      
      case "Niños" :    $ID_clasificacion = "CLAS03";
      break;
      
      case "Bebes" :    $ID_clasificacion = "CLAS04";
      break;
      
      case "Niñas" :    $ID_clasificacion = "CLAS05";
      break;
    
      case "Hombres" :    $ID_clasificacion = "CLAS06";
      break;
      
      
      default: "";
      break;      
      }
 
      $db = new Controllerjson();
      $result = $db->createProductoController($ID_Producto,$Nombre_Producto,$destino,$Imagen_Producto,$Talla,$Color,$Material,$Valor,$Descripcion,$ID_categoria,$ID_clasificacion);
    
      
    if(!$result){
        $respuesta['error'] = false;
        $respuesta['mensaje'] = 'Producto Agregado';
        header("location:../administrador/crud/administraproducto.php");
    }else{
        $respuesta['error'] = true;
        $respuesta['mensaje'] = 'Producto No Agregado';
     header("location:../administrador/crud/administraproducto.php");
    }
      
    break;


    case 'updateproducto':
    ParametrosDisponibles(array('ID_Producto', 'Nombre_Producto','Talla', 'Color', 'Material', 'Valor', 'Descripcion', 'ID_categoria', 'ID_clasificacion'));

    if($_POST["ID_Producto"]=="" ||  $_POST["Nombre_Producto"]=="" ||  $_POST["Talla"]=="" || $_POST["Color"]=="" ||  

    $_POST["Material"]=="" || $_POST["Valor"]="" || $_POST["ID_categoria"]=="" ||    $_POST["ID_clasificacion"]==""  )
    
    {
    
        echo " <h3> Hay Datos Vaciós Por Favor Llenarlos </h3>
        <a href='administraproducto.php'> Volver a Administrar Productos </a>
        <a href='paneladministrador.php'> Ir a Panel de Administración </a>
        "; 
    }
    else {
        $ID_Producto = $_POST["ID_Producto"];
      
      $Nombre_Producto = $_POST["Nombre_Producto"];
      
      $Imagen_Producto = $_FILES["Imagen_Producto"] ["name"];
      
      if(isset($Imagen_Producto) &&  $Imagen_Producto = $_FILES["Imagen_Producto"] ["name"] != ""){
        $Imagen_Producto = $_FILES["Imagen_Producto"] ["name"];
      $ruta= $_FILES["Imagen_Producto"] ["tmp_name"];
      $destino="../administrador/fotos/".$Imagen_Producto;
      copy($ruta,$destino);
      }

      else {
        $destino = $Imagen_Producto;
      }

      $Talla = $_POST["Talla"];

      $Color = $_POST["Color"];
      
      $Material = $_POST["Material"];
      
      $Valor = $_POST["Valor"];
      
       $ID_categoria = $_POST["ID_categoria"];
      
      switch($ID_categoria) {
      
      case "Chaquetas": $ID_categoria = "CAT01";
      break;
      
      case "pantalones": $ID_categoria = "CAT02";
      break;
      
      case "Formal": $ID_categoria = "CAT03";
      break;
      
      case "Informal": $ID_categoria = "CAT04";
      break;
      
      case "blusa": $ID_categoria = "CAT05";
      break;
      
      default: "";
      break;
      }
      
      $ID_clasificacion = $_POST["ID_clasificacion"];
      
      switch($ID_clasificacion) {
      
      case "Unisex":  $ID_clasificacion = "CLAS01";
      break;
      
      case "Mujeres":  $ID_clasificacion = "CLAS02";
      break;
      
      case "Niños":  $ID_clasificacion = "CLAS03";
      break;
      
      case "Bebes":  $ID_clasificacion = "CLAS04";
      break;
      
      case "Niñas":  $ID_clasificacion = "CLAS05";
      break;
      
      case "Hombres":  $ID_clasificacion = "CLAS06";
      break;
      
      default: "";
      break;
      
      }
      
      $Descripcion = $_POST["Descripcion"];
    }      
    
    $db =new Controllerjson();
 $result = $db->updateProductoController($ID_Producto,$Nombre_Producto,$destino,$Imagen_Producto,$Talla,$Color,$Material,$Valor,$Descripcion,$ID_categoria,$ID_clasificacion);


 if(!$result){
    $respuesta['error'] = false;
    $respuesta['mensaje'] = 'Producto No Existe';
    header("location:../administrador/crud/administraproducto.php");
}else{
    $respuesta['error'] = true;
    $respuesta['mensaje'] = 'Producto Eliminado';
   header("location:../administrador/crud/administraproducto.php");
}

break;

case 'deleteproducto':
    ParametrosDisponibles(array('ID_Producto'));
    $db = new Controllerjson();
    $result = $db->deleteProductoController($_POST["ID_Producto"]);
    
    if(!$result){
        $respuesta['error'] = false;
        $respuesta['mensaje'] = 'Producto No Existe';
        header("location:../administrador/crud/administraproducto.php");
    }else{
        $respuesta['error'] = true;
        $respuesta['mensaje'] = 'Producto Eliminado';
        header("location:../administrador/crud/administraproducto.php");
    }
break;

    }
}else{
    $respuesta['error'] = true;
    $respuesta['mensaje'] = 'Llamado invalido del API!';
}
echo json_encode($respuesta);
?>