<?php
include ("bd.php"); 
if($_POST){
    
    //recepcionamos valores
    $nombreconfiguracion=(isset($_POST['nombreconfiguracion']))?$_POST['nombreconfiguracion']:"";
    $valor=(isset($_POST['valor']))?$_POST['valor']:"";

    $sentencia=$conexion->prepare("INSERT INTO `tbl_configuraciones` (`ID`, `nombreconfiguracion`, `valor`) VALUES (NULL,:nombreconfiguracion ,:valor)");

    $sentencia->bindParam(":nombreconfiguracion",$nombreconfiguracion);
    $sentencia->bindParam(":valor",$valor);
    $sentencia->execute();
    $mensaje="registro creado con exito.";
    header("location:index.config.php?mensaje=".$mensaje);

}
include ("cabecera.php");
?>
<div class="card">
    <div class="card-header">
    crear configuracion
    </div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-3">
              <label for="nombreconfiguracion" class="form-label">nombre de la configuracion:</label>
              <input type="text"
                class="form-control" name="nombreconfiguracion" id="nombreconfiguracion" aria-describedby="helpId" placeholder="nombreconfiguracion">
            </div>
            <div class="mb-3">
              <label for="valor" class="form-label">valor:</label>
              <input type="text"
                class="form-control" name="valor" id="valor" aria-describedby="helpId" placeholder="valor">
            </div>
            <button type="submit" class="btn btn-success">agregar</button>
             <a name="" id="" class="btn btn-primary" href="index.config.php" role="button">cancelar</a>
        </form>
    </div>
</div>

<?php 
include ("piepagina.php");
?>