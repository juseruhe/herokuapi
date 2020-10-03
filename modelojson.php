<?php
require_once 'database.php';

class Datos extends Database{

    //METODOS

    // Usuarios
    public function createUsuarioModel($datosModel,$tabla){
        $stmt = Database::getconectar()->prepare("INSERT INTO $tabla(ID_Tipo_Documento,ID_Usuario,Primer_Nombre,Segundo_Nombre,Primer_Apellido,Segundo_Apellido,fecha_nacimiento,Telefono,Correo,Contrasena,confirmar_Contrasena,ID_Genero,ID_Ciudad,direccion,observaciones,ID_Rol) 
        VALUES(:ID_Tipo_Documento,:ID_Usuario,:Primer_Nombre,:Segundo_Nombre,:Primer_Apellido,:Segundo_Apellido,:fecha_nacimiento,:Telefono,:Correo,:Contrasena,:confirmar_Contrasena,:ID_Genero,:ID_Ciudad,:direccion,:observaciones,:ID_Rol)");

        $stmt->bindParam(":ID_Tipo_Documento", $datosModel["ID_Tipo_Documento"],PDO::PARAM_STR);
        $stmt->bindParam(":ID_Usuario", $datosModel["ID_Usuario"],PDO::PARAM_STR);
        $stmt->bindParam(":Primer_Nombre", $datosModel["Primer_Nombre"],PDO::PARAM_STR);
        $stmt->bindParam(":Segundo_Nombre", $datosModel["Segundo_Nombre"],PDO::PARAM_STR);
        $stmt->bindParam(":Primer_Apellido", $datosModel["Primer_Apellido"],PDO::PARAM_STR);
        $stmt->bindParam(":Segundo_Apellido", $datosModel["Segundo_Apellido"],PDO::PARAM_STR);
        $stmt->bindParam(":fecha_nacimiento", $datosModel["fecha_nacimiento"],PDO::PARAM_STR);
        $stmt->bindParam(":Telefono", $datosModel["Telefono"],PDO::PARAM_STR);
        $stmt->bindParam(":Correo", $datosModel["Correo"],PDO::PARAM_STR);
        $stmt->bindParam(":Contrasena", $datosModel["Contrasena"],PDO::PARAM_STR);
        $stmt->bindParam(":confirmar_Contrasena", $datosModel["confirmar_Contrasena"],PDO::PARAM_STR);
        $stmt->bindParam(":ID_Genero", $datosModel["ID_Genero"],PDO::PARAM_STR);
        $stmt->bindParam(":ID_Ciudad", $datosModel["ID_Ciudad"],PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datosModel["direccion"],PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datosModel["observaciones"],PDO::PARAM_STR);
        $stmt->bindParam(":ID_Rol", $datosModel["ID_Rol"],PDO::PARAM_STR);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        } 
    }

    public function readUsuarioModel($Correo,$tabla){
        $stmt = Database::getconectar()->prepare("SELECT Nombre,ID_Usuario,Nombre_Rol,Nombre_Genero,Nombre_Ciudad,Primer_Nombre,
        Segundo_Nombre,Primer_Apellido,Segundo_Apellido,fecha_nacimiento,Telefono,
        Correo,confirmar_Contrasena,Contrasena,direccion,observaciones from $tabla
        join tipo_documento on tipo_documento.ID_Tipo_Documento = $tabla.ID_Tipo_Documento
        join genero on genero.ID_Genero = $tabla.ID_Genero
        join ciudad on ciudad.ID_Ciudad =$tabla.ID_Ciudad
        join rol on rol.ID_Rol = $tabla.ID_Rol
        where Correo = :Correo");

  

$stmt->bindParam(":Correo", $Correo,PDO::PARAM_STR);
        $stmt->execute();

        $stmt->bindParam(":Nombre", $Nombre,PDO::PARAM_STR);
        $stmt->bindParam(":ID_Usuario", $ID_Usuario,PDO::PARAM_STR);
        $stmt->bindParam(":Primer_Nombre", $Primer_Nombre,PDO::PARAM_STR);
        $stmt->bindParam(":Segundo_Nombre", $Segundo_Nombre,PDO::PARAM_STR);
        $stmt->bindParam(":Primer_Apellido", $Primer_Apellido,PDO::PARAM_STR);
        $stmt->bindParam(":Segundo_Apellido", $Segundo_Apellido,PDO::PARAM_STR);
        $stmt->bindParam(":fecha_nacimiento", $fecha_nacimiento,PDO::PARAM_STR);
        $stmt->bindParam(":Telefono", $Telefono,PDO::PARAM_STR);
        $stmt->bindParam(":Correo", $Correo,PDO::PARAM_STR);
        $stmt->bindParam(":Contrasena", $Contrasena,PDO::PARAM_STR);
        $stmt->bindParam(":confirmar_Contrasena", $confirmar_Contrasena,PDO::PARAM_STR);
        $stmt->bindParam(":Nombre_Genero", $Nombre_Genero,PDO::PARAM_STR);
        $stmt->bindParam(":Nombre_Ciudad", $Nombre_Ciudad,PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $direccion,PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $observaciones,PDO::PARAM_STR);
        $stmt->bindParam(":Nombre_Rol", $Nombre_Rol,PDO::PARAM_STR);
        $usuarios = array();

    return  $stmt->fetchAll();




  }

  public function readUsuariosModel(){
    $stmt = Database::getconectar()->prepare("SELECT ID_Tipo_Documento,ID_Usuario, Primer_Nombre, Segundo_Nombre, Primer_Apellido, 
    Segundo_Apellido,fecha_nacimiento, Telefono, Correo, Nombre_Genero, Nombre_Ciudad, direccion, observaciones 
    FROM usuario
    join genero on genero.ID_Genero = usuario.ID_Genero
    join ciudad on ciudad.ID_Ciudad = usuario.ID_Ciudad");


$stmt->execute();


$stmt->bindParam(":ID_Usuario", $ID_Usuario,PDO::PARAM_STR);
$stmt->bindParam(":Primer_Nombre", $Primer_Nombre,PDO::PARAM_STR);
$stmt->bindParam(":Segundo_Nombre", $Segundo_Nombre,PDO::PARAM_STR);
$stmt->bindParam(":Primer_Apellido", $Primer_Apellido,PDO::PARAM_STR);
$stmt->bindParam(":Segundo_Apellido", $Segundo_Apellido,PDO::PARAM_STR);
$stmt->bindParam(":fecha_nacimiento", $fecha_nacimiento,PDO::PARAM_STR);
$stmt->bindParam(":Telefono", $Telefono,PDO::PARAM_STR);
$stmt->bindParam(":Correo", $Correo,PDO::PARAM_STR);
$stmt->bindParam(":Nombre_Genero", $Nombre_Genero,PDO::PARAM_STR);
$stmt->bindParam(":Nombre_Ciudad", $Nombre_Ciudad,PDO::PARAM_STR);
$stmt->bindParam(":direccion", $direccion,PDO::PARAM_STR);
$stmt->bindParam(":observaciones", $observaciones,PDO::PARAM_STR);



return  $stmt->fetchAll();




}


public function readUsuarioAdminModel($ID_Usuario,$tabla){
    $stmt = Database::getconectar()->prepare("SELECT ID_Tipo_Documento,ID_Usuario,Nombre_Genero,Nombre_Ciudad,
    Primer_Nombre,Segundo_Nombre,Primer_Apellido,Segundo_Apellido,fecha_nacimiento,Telefono,
    Correo,direccion,observaciones from $tabla
    
    join genero on genero.ID_Genero = $tabla.ID_Genero
    join ciudad on ciudad.ID_Ciudad =$tabla.ID_Ciudad
    
    where ID_Usuario = :ID_Usuario");



$stmt->bindParam(":ID_Usuario", $ID_Usuario,PDO::PARAM_STR);
    $stmt->execute();

    $stmt->bindParam(":ID_Usuario", $ID_Usuario,PDO::PARAM_STR);
    $stmt->bindParam(":Primer_Nombre", $Primer_Nombre,PDO::PARAM_STR);
    $stmt->bindParam(":Segundo_Nombre", $Segundo_Nombre,PDO::PARAM_STR);
    $stmt->bindParam(":Primer_Apellido", $Primer_Apellido,PDO::PARAM_STR);
    $stmt->bindParam(":Segundo_Apellido", $Segundo_Apellido,PDO::PARAM_STR);
    $stmt->bindParam(":fecha_nacimiento", $fecha_nacimiento,PDO::PARAM_STR);
    $stmt->bindParam(":Telefono", $Telefono,PDO::PARAM_STR);
    $stmt->bindParam(":Correo", $Correo,PDO::PARAM_STR);
    $stmt->bindParam(":Nombre_Genero", $Nombre_Genero,PDO::PARAM_STR);
    $stmt->bindParam(":Nombre_Ciudad", $Nombre_Ciudad,PDO::PARAM_STR);
    $stmt->bindParam(":direccion", $direccion,PDO::PARAM_STR);
    $stmt->bindParam(":observaciones", $observaciones,PDO::PARAM_STR);
    

return  $stmt->fetchAll();




}












     public function updateUsuarioModel($datosModel,$tabla){
        $stmt = Database::getconectar()->prepare("UPDATE $tabla set ID_Genero=:ID_Genero,
ID_Ciudad=:ID_Ciudad,Primer_Nombre=:Primer_Nombre,Segundo_Nombre=:Segundo_Nombre,
Primer_Apellido=:Primer_Apellido,Segundo_Apellido=:Segundo_Apellido,fecha_nacimiento=:fecha_nacimiento,
Telefono=:Telefono,Correo=:Correo,Contrasena=:Contrasena,confirmar_Contrasena=:confirmar_Contrasena,
direccion=:direccion,observaciones=:observaciones
where ID_Tipo_Documento= :ID_Tipo_Documento and ID_Usuario = :ID_Usuario");

     $stmt->bindParam(":ID_Tipo_Documento", $datosModel["ID_Tipo_Documento"],PDO::PARAM_STR);
        $stmt->bindParam(":ID_Usuario", $datosModel["ID_Usuario"],PDO::PARAM_STR);
        $stmt->bindParam(":Primer_Nombre", $datosModel["Primer_Nombre"],PDO::PARAM_STR);
        $stmt->bindParam(":Segundo_Nombre", $datosModel["Segundo_Nombre"],PDO::PARAM_STR);
        $stmt->bindParam(":Primer_Apellido", $datosModel["Primer_Apellido"],PDO::PARAM_STR);
        $stmt->bindParam(":Segundo_Apellido", $datosModel["Segundo_Apellido"],PDO::PARAM_STR);
        $stmt->bindParam(":fecha_nacimiento", $datosModel["fecha_nacimiento"],PDO::PARAM_STR);
        $stmt->bindParam(":Telefono", $datosModel["Telefono"],PDO::PARAM_STR);
        $stmt->bindParam(":Correo", $datosModel["Correo"],PDO::PARAM_STR);
        $stmt->bindParam(":Contrasena", $datosModel["Contrasena"],PDO::PARAM_STR);
        $stmt->bindParam(":confirmar_Contrasena", $datosModel["confirmar_Contrasena"],PDO::PARAM_STR);
        $stmt->bindParam(":ID_Genero", $datosModel["ID_Genero"],PDO::PARAM_STR);
        $stmt->bindParam(":ID_Ciudad", $datosModel["ID_Ciudad"],PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datosModel["direccion"],PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datosModel["observaciones"],PDO::PARAM_STR);
        if($stmt->execute()){
            echo "Actualizacion Exitosa";
        }else{
            echo "No se pudo hacer la Actualizacion";
        }
    }

     public function updateUsuarioAdminModel($datosModel,$tabla){


        $stmt = Database::getconectar()->prepare("UPDATE $tabla set ID_Genero=:ID_Genero,
        ID_Ciudad=:ID_Ciudad,Primer_Nombre=:Primer_Nombre,Segundo_Nombre=:Segundo_Nombre,
        Primer_Apellido=:Primer_Apellido,Segundo_Apellido=:Segundo_Apellido,fecha_nacimiento=:fecha_nacimiento,
        Telefono=:Telefono,Correo=:Correo,
        direccion=:direccion,observaciones=:observaciones
        where ID_Usuario = :ID_Usuario");


$stmt->bindParam(":ID_Usuario", $datosModel["ID_Usuario"],PDO::PARAM_STR);
$stmt->bindParam(":Primer_Nombre", $datosModel["Primer_Nombre"],PDO::PARAM_STR);
$stmt->bindParam(":Segundo_Nombre", $datosModel["Segundo_Nombre"],PDO::PARAM_STR);
$stmt->bindParam(":Primer_Apellido", $datosModel["Primer_Apellido"],PDO::PARAM_STR);
$stmt->bindParam(":Segundo_Apellido", $datosModel["Segundo_Apellido"],PDO::PARAM_STR);
$stmt->bindParam(":fecha_nacimiento", $datosModel["fecha_nacimiento"],PDO::PARAM_STR);
$stmt->bindParam(":Telefono", $datosModel["Telefono"],PDO::PARAM_STR);
$stmt->bindParam(":Correo", $datosModel["Correo"],PDO::PARAM_STR);
$stmt->bindParam(":ID_Genero", $datosModel["ID_Genero"],PDO::PARAM_STR);
$stmt->bindParam(":ID_Ciudad", $datosModel["ID_Ciudad"],PDO::PARAM_STR);
$stmt->bindParam(":direccion", $datosModel["direccion"],PDO::PARAM_STR);
$stmt->bindParam(":observaciones", $datosModel["observaciones"],PDO::PARAM_STR);
if($stmt->execute()){
    echo "Actualizacion Exitosa";
}else{
    echo "No se pudo hacer la Actualizacion";
}











     }










    public function deleteUsuarioModel($ID_Usuario,$ID_Tipo_Documento, $tabla){
        $stmt = Database::getconectar()->prepare("DELETE FROM $tabla WHERE ID_Usuario=:ID_Usuario and ID_Tipo_Documento
        = :ID_Tipo_Documento");

        $stmt->bindParam(":ID_Usuario",$ID_Usuario, PDO::PARAM_STR);
        $stmt->bindParam(":ID_Tipo_Documento",$ID_Tipo_Documento, PDO::PARAM_STR);

        $stmt->execute();
    }

    public function loginUsuarioModel($datosModel, $tabla){
        $stmt = Database::getconectar()->prepare("SELECT Correo,Contrasena,Nombre_Rol from $tabla 
        join rol on $tabla.ID_Rol = rol.ID_Rol
        where Correo = :Correo and (Contrasena = :Contrasena) AND (Nombre_Rol = 'Usuario' or Nombre_Rol = 'Administrador')");

        $stmt->bindParam(":Correo",$datosModel["Correo"]);
        $stmt->bindParam(":Contrasena",$datosModel["Contrasena"]);

        $stmt->execute();

       
        $stmt->bindColumn("Correo", $Correo);
        $stmt->bindColumn("Contrasena", $Contrasena);
        $stmt->bindColumn("Nombre_Rol", $Nombre_Rol);

        while($fila = $stmt->fetch(PDO::FETCH_BOUND)){
            $user = array();
            $user["Correo"] = utf8_encode($Correo);
            $user["Contrasena"] = utf8_encode($Contrasena);
            $user["Nombre_Rol"] = utf8_encode($Nombre_Rol);

            if(isset($user["Nombre_Rol"]) &&  $user["Nombre_Rol"] == "Usuario") {  

                $_SESSION["usuario"]=$Correo;
                header("location:../menuusuario.php");
               
               }else if(isset($user["Nombre_Rol"]) && $user["Nombre_Rol"] == "Administrador") {  
                   
                $_SESSION["usuario"]=$Correo;
                header("location:../administrador/crud/paneladministrador.php");
                
               }else {
                   echo "Datos Incorrectos";
               }
        }
        if(!empty($user)){
            return $user;
        }else{
            return false;
        }      
    }


    public function mostrarcontrasenaModel($Correo,$ID_Usuario,$tabla){
     
        $stmt = Database::getconectar()->prepare("SELECT Correo,ID_Usuario,Contrasena FROM $tabla where Correo=:Correo and ID_Usuario=:ID_Usuario");
        
        $stmt->bindParam(":Correo",$Correo);
        $stmt->bindParam(":ID_Usuario",$ID_Usuario);
       
        $stmt->execute();

       
        $stmt->bindColumn("Correo",$Correo);
        $stmt->bindColumn("ID_Usuario",$ID_Usuario);

        $stmt->bindColumn("Contrasena",$Contrasena); 
        //$usuarios = array();
     

    



        while($fila = $stmt->fetch(PDO::FETCH_BOUND)){
                       
            $user["Correo"] = utf8_encode($Correo);
            $user["ID_Usuario"] = utf8_encode($ID_Usuario);
            $user["Contrasena"] = utf8_encode($Contrasena);
          
         if($user["Correo"] != null and $user["ID_Usuario"] != null) {

         return "La contrasena del Correo del $user[Correo] es $user[Contrasena]<br>
         <a href='../index.html'> Volver ";}
           else {
               return "El Correo no existe";
           }       
        }
        
    }


 public function todoGeneroModel($Nombre_Genero,$tabla){

    $stmt = Database::getconectar()->prepare("SELECT Nombre_Genero from $tabla where Nombre_Genero
    <> :Nombre_Genero");

$stmt->bindParam(":Nombre_Genero",$Nombre_Genero,PDO::PARAM_STR);

$stmt->execute();

$stmt->bindParam(":Nombre_Genero",$Nombre_Genero,PDO::PARAM_STR);

return $stmt->fetchAll();

 }

 
 public function mostrarCiudades($Nombre_Ciudad,$tabla){

    $stmt = Database::getconectar()->prepare("SELECT Nombre_Ciudad from $tabla
    where Nombre_Ciudad = :Nombre_Ciudad");

$stmt->bindParam(":Nombre_Ciudad",$Nombre_Ciudad,PDO::PARAM_STR);

$stmt->execute();

$stmt->bindParam(":Nombre_Ciudad",$Nombre_Ciudad,PDO::PARAM_STR);

return $stmt->fetchAll();

 }


 // Productos

 public function mostrarProductos(){
 
    $stmt = Database::getconectar()->prepare("SELECT ID_Producto, Nombre_Producto, Imagen_Producto,
     Talla, Color, Material, Valor, Nombre_Categoria, Nombre_Clasificacion,Descripcion 
    FROM producto
    join categoria on producto.ID_categoria = categoria.ID_Categoria
    join clasificacion on producto.ID_clasificacion = clasificacion.ID_Clasificacion");

$stmt->execute();

        $stmt->bindParam(":ID_Producto", $ID_Producto,PDO::PARAM_STR);
        $stmt->bindParam(":Nombre_Producto", $Nombre_Producto,PDO::PARAM_STR);
        $stmt->bindParam(":Imagen_Producto", $Imagen_Producto,PDO::PARAM_LOB);
        $stmt->bindParam(":Talla", $Talla,PDO::PARAM_STR);
        $stmt->bindParam(":Color", $Color,PDO::PARAM_STR);
        $stmt->bindParam(":Material", $Material,PDO::PARAM_STR);
        $stmt->bindParam(" Valor",  $Valor,PDO::PARAM_INT);
        $stmt->bindParam(":Nombre_Categoria", $Nombre_Categoria,PDO::PARAM_STR);
        $stmt->bindParam(":Nombre_Clasificacion", $Nombre_Clasificacion,PDO::PARAM_STR);
        $stmt->bindParam(":Descripcion", $Descripcion,PDO::PARAM_STR);
        
        return $stmt->fetchAll();




 }

 public function createProductoModel($datosModel,$tabla){

$IMG="../fotos/".$datosModel["IMG"];

$stmt = Database::getconectar()->prepare("INSERT into $tabla(ID_Producto,Nombre_Producto,
Imagen_Producto,Talla,Color,Material,Valor,Descripcion,ID_categoria,ID_clasificacion) 
values (:ID_Producto,:Nombre_Producto,:Imagen_Producto,:Talla,:Color,:Material,:Valor,:Descripcion,
:ID_categoria,:ID_clasificacion)");

$stmt->bindParam(":ID_Producto", $datosModel["ID_Producto"],PDO::PARAM_STR);
        $stmt->bindParam(":Nombre_Producto", $datosModel["Nombre_Producto"],PDO::PARAM_STR);
        $stmt->bindParam(":Imagen_Producto", $IMG,PDO::PARAM_STR);
        $stmt->bindParam(":Talla", $datosModel["Talla"],PDO::PARAM_STR);
        $stmt->bindParam(":Color", $datosModel["Color"],PDO::PARAM_STR);
        $stmt->bindParam(":Material", $datosModel["Material"],PDO::PARAM_STR);
        $stmt->bindParam(":Valor", $datosModel["Valor"],PDO::PARAM_STR);
        $stmt->bindParam(":Descripcion", $datosModel["Descripcion"],PDO::PARAM_STR);
        $stmt->bindParam(":ID_categoria", $datosModel["ID_categoria"],PDO::PARAM_STR);
        $stmt->bindParam(":ID_clasificacion", $datosModel["ID_clasificacion"],PDO::PARAM_STR);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        } 


 }

 public function editarproducto($ID_Producto,$tabla){
    $stmt = Database::getconectar()->prepare("SELECT ID_Producto, Nombre_Producto, Imagen_Producto, 
    Talla, Color, Material, Valor, Nombre_Categoria, Nombre_Clasificacion,
    Descripcion 
    FROM $tabla
    join categoria on producto.ID_categoria = categoria.ID_Categoria
    join clasificacion on producto.ID_clasificacion = clasificacion.ID_Clasificacion
    where ID_Producto=:ID_Producto");

$stmt->bindParam(":ID_Producto", $ID_Producto,PDO::PARAM_STR);
        $stmt->execute();

        $stmt->bindParam(":ID_Producto", $ID_Producto,PDO::PARAM_STR);
        $stmt->bindParam(":Nombre_Producto", $Nombre_Producto,PDO::PARAM_STR);
        $stmt->bindParam(":Imagen_Producto", $Imagen_Producto,PDO::PARAM_LOB);
        $stmt->bindParam(":Talla", $Talla,PDO::PARAM_STR);
        $stmt->bindParam(":Color", $Color,PDO::PARAM_STR);
        $stmt->bindParam(":Material", $Material,PDO::PARAM_STR);
        $stmt->bindParam(" Valor",  $Valor,PDO::PARAM_INT);
        $stmt->bindParam(":Descripcion", $Descripcion,PDO::PARAM_STR);
        $stmt->bindParam(":ID_categoria", $ID_categoria,PDO::PARAM_STR);
        $stmt->bindParam(":ID_clasificacion", $ID_clasificacion,PDO::PARAM_STR);
      

return $stmt->fetchAll();




 }

 public function mostrarCategoria($Nombre_Categoria,$tabla){

    $stmt = Database::getconectar()->prepare("SELECT Nombre_Categoria from $tabla
    where Nombre_Categoria <> :Nombre_Categoria");

$stmt->bindParam(":Nombre_Categoria", $Nombre_Categoria,PDO::PARAM_STR);
$stmt->execute();

$stmt->bindParam(":Nombre_Categoria", $Nombre_Categoria,PDO::PARAM_STR);
        
return $stmt->fetchAll();


 }

 public function mostrarClasificacion($Nombre_Clasificacion,$tabla){

    $stmt = Database::getconectar()->prepare("SELECT Nombre_Clasificacion from $tabla
    where Nombre_Clasificacion <> :Nombre_Clasificacion");

$stmt->bindParam(":Nombre_Clasificacion", $Nombre_Clasificacion,PDO::PARAM_STR);
$stmt->execute();

$stmt->bindParam(":Nombre_Clasificacion", $Nombre_Clasificacion,PDO::PARAM_STR);
        
return $stmt->fetchAll();


 }

 public function volverImagen($ID_Producto,$tabla){

$stmt = Database::getconectar()->prepare("SELECT ID_Producto, Nombre_Producto, Imagen_Producto, 
Talla, Color, Material, Valor, Nombre_Categoria, Nombre_Clasificacion,
Descripcion 
FROM $tabla
join categoria on producto.ID_categoria = categoria.ID_Categoria
join clasificacion on producto.ID_clasificacion = clasificacion.ID_Clasificacion
where ID_Producto=:ID_Producto");

$stmt->bindParam(":ID_Producto", $ID_Producto,PDO::PARAM_STR);
$stmt->execute();

$stmt->bindParam(":ID_Producto", $ID_Producto,PDO::PARAM_STR);
        $stmt->bindParam(":Nombre_Producto", $Nombre_Producto,PDO::PARAM_STR);
        $stmt->bindParam(":Imagen_Producto", $IMG,PDO::PARAM_STR);
        $stmt->bindParam(":Talla", $Talla,PDO::PARAM_STR);
        $stmt->bindParam(":Color", $Color,PDO::PARAM_STR);
        $stmt->bindParam(":Material", $Material,PDO::PARAM_STR);
        $stmt->bindParam(" Valor",  $Valor,PDO::PARAM_INT);
        $stmt->bindParam(":Descripcion", $Descripcion,PDO::PARAM_STR);
        $stmt->bindParam(":Nombre_Categoria", $ID_categoria,PDO::PARAM_STR);
        $stmt->bindParam(":Nombre_Clasificacion", $ID_clasificacion,PDO::PARAM_STR);

        return $stmt->fetchAll();


 }


 public function updateProductoModel($datosModel,$tabla){

if($datosModel["Imagen_Producto"] == "../administrador/fotos/".$datosModel["IMG"])

 {
    $IMG="../fotos/".$datosModel["IMG"];
 }
 else {
    $VolverImagen = new Datos();
    $MostrarImagen= $VolverImagen->volverImagen($datosModel["ID_Producto"],"producto");

    if($MostrarImagen){
      foreach($MostrarImagen as $rowimagen => $itemimagen){
      
     $IMG = $itemimagen["Imagen_Producto"];

      }}      
 }

$stmt = Database::getconectar()->prepare("UPDATE $tabla set 
Nombre_Producto=:Nombre_Producto,
Imagen_Producto = :Imagen_Producto,Talla=:Talla,Color=:Color,Material=:Material,Valor=:Valor,
Descripcion=:Descripcion,
ID_categoria=:ID_categoria,ID_clasificacion = :ID_clasificacion
where ID_Producto = :ID_Producto");

$stmt->bindParam(":ID_Producto", $datosModel["ID_Producto"],PDO::PARAM_STR);
 $stmt->bindParam(":Nombre_Producto", $datosModel["Nombre_Producto"],PDO::PARAM_STR);
        $stmt->bindParam(":Imagen_Producto",$IMG,PDO::PARAM_STR);
        $stmt->bindParam(":Talla", $datosModel["Talla"],PDO::PARAM_STR);
        $stmt->bindParam(":Color", $datosModel["Color"],PDO::PARAM_STR);
        $stmt->bindParam(":Material", $datosModel["Material"],PDO::PARAM_STR);
        $stmt->bindParam(":Valor", $datosModel["Valor"],PDO::PARAM_STR);
        $stmt->bindParam(":Descripcion", $datosModel["Descripcion"],PDO::PARAM_STR);
        $stmt->bindParam(":ID_categoria", $datosModel["ID_categoria"],PDO::PARAM_STR);
        $stmt->bindParam(":ID_clasificacion", $datosModel["ID_clasificacion"],PDO::PARAM_STR);

        if($stmt->execute()){
            return true;
        
        }else{
            return false;
        } 
 }
   
 public function deleteProductoModel($ID_Producto, $tabla){

    $stmt = Database::getconectar()->prepare("DELETE  FROM $tabla WHERE ID_Producto=:ID_Producto");

    $stmt->bindParam(":ID_Producto",$ID_Producto, PDO::PARAM_STR);
    $stmt->execute();
}
 }
?>