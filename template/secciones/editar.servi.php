<?php 
include ("bd.php");
//recuperar ID del registro para editar
if(isset($_GET['txtID'])){

    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT * FROM tbl_servicios WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $icono=$registro['icono'];
    $titulo=$registro['titulo'];
    $descripcion=$registro['descripcion'];
}
if($_POST){
    
    $icono=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $icono=(isset($_POST['icono']))?$_POST['icono']:"";
    $titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";

    $sentencia=$conexion->prepare("UPDATE tbl_servicios
     SET icono=:icono,
        titulo=:titulo,
        descripcion=:descripcion
        WHERE id=:id");

    $sentencia->bindParam(":icono",$icono);
    $sentencia->bindParam(":titulo",$titulo);
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $mensaje="registro modificado con exito.";
    header("location:index.servi.php?mensaje=".$mensaje);
}


include ("cabecera.php");
?>
<div class="card">
    <div class="card-header">
    editar servicio
    </div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
            
        <div class="mb-3">
              <label for="txtID" class="form-label">ID:</label>
              <input readonly value="<?php echo $txtID;?>" type="text"
                class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="txtID">
            </div>
        <div class="mb-3">
              <label for="icono" class="form-label">Icono:</label>
              <input value="<?php echo $icono;?>" type="text"
                class="form-control" name="icono" id="icono" aria-describedby="helpId" placeholder="icono">
            </div>
            <div class="mb-3">
              <label for="titulo" class="form-label">titulo:</label>
              <input value="<?php echo $titulo;?>" type="text"
                class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="titulo">
            </div>
            <div class="mb-3">
              <label for="descripcion" class="form-label">descripcion:</label>
              <input value="<?php echo $descripcion;?>" type="text"
                class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="descripcion">
            </div>
            <button type="submit" class="btn btn-success">actualizar</button>
             <a name="" id="" class="btn btn-primary" href="index.servi.php" role="button">cancelar</a>
        </form>
    </div>
</div>
<?php 
include ("piepagina.php");
?>