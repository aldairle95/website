<?php 
include ("bd.php");
//recuperar ID del registro para editar
if(isset($_GET['txtID'])){

    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT * FROM tbl_usuarios WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $usuario=$registro['usuario'];
    $password=$registro['password'];
    $correo=$registro['correo'];
}
if($_POST){
    
    $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
    $password=(isset($_POST['password']))?$_POST['password']:"";
    $correo=(isset($_POST['correo']))?$_POST['correo']:"";


    $sentencia=$conexion->prepare("UPDATE tbl_usuarios
     SET usuario=:usuario,
     password=:password,
     correo=:correo
        WHERE id=:id");

    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":password",$password);
    $sentencia->bindParam(":correo",$correo);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $mensaje="registro modificado con exito.";
    header("location:index.usu.php?mensaje=".$mensaje);
}

include ("cabecera.php");
?>
<div class="card">
    <div class="card-header">
       editar usuario
    </div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-3">
              <label for="usuario" class="form-label">usuario:</label>
              <input  value="<?php echo $usuario;?>" type="text"
                class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="usuario">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">password:</label>
              <input value="<?php echo $password;?>" type="password"
                class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="password">
            </div>
            <div class="mb-3">
              <label for="correo" class="form-label">correo:</label>
              <input value="<?php echo $correo;?>" type="email"
                class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="correo">
            </div>
            <button type="submit" class="btn btn-success">agregar</button>
             <a name="" id="" class="btn btn-primary" href="index.usu.php" role="button">cancelar</a>
        </form>
    </div>
</div>

<?php 
include ("piepagina.php");
?>