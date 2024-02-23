<?php 
include ("bd.php");
if($_POST){
    
    //recepcionamos valores
   $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
   $password=(isset($_POST['password']))?$_POST['password']:"";
   $correo=(isset($_POST['correo']))?$_POST['correo']:"";

   $sentencia=$conexion->prepare("INSERT INTO `tbl_usuarios` (`ID`, `usuario`, `password`, `correo`) VALUES (NULL,:usuario , :password, :correo)");

   $sentencia->bindParam(":usuario",$usuario);
   $sentencia->bindParam(":password",$password);
   $sentencia->bindParam(":correo",$correo);
   $sentencia->execute();
   $mensaje="registro creado con exito.";
   header("location:index.usu.php?mensaje=".$mensaje);

 }
include ("cabecera.php");
?>
<div class="card">
    <div class="card-header">
       crear usuario
    </div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-3">
              <label for="usuario" class="form-label">usuario:</label>
              <input type="text"
                class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="usuario">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">password:</label>
              <input type="password"
                class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="password">
            </div>
            <div class="mb-3">
              <label for="correo" class="form-label">correo:</label>
              <input type="email"
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