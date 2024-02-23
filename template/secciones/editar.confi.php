<?php 
include ("bd.php");
//recuperar ID del registro para editar
if(isset($_GET['txtID'])){

    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT * FROM tbl_configuraciones WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $nombreconfiguracion=$registro['nombreconfiguracion'];
    $valor=$registro['valor'];

}
if($_POST){
    $icono=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $nombreconfiguracion=(isset($_POST['nombreconfiguracion']))?$_POST['nombreconfiguracion']:"";
    $valor=(isset($_POST['valor']))?$_POST['valor']:"";

    $sentencia=$conexion->prepare("UPDATE tbl_configuraciones
     SET nombreconfiguracion=:nombreconfiguracion,
     valor=:valor
        WHERE id=:id");

    $sentencia->bindParam(":nombreconfiguracion",$nombreconfiguracion);
    $sentencia->bindParam(":valor",$valor);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $mensaje="registro modificado con exito.";
    header("location:index.config.php?mensaje=".$mensaje);
}
include ("cabecera.php");
?>

<div class="card">
    <div class="card-header">
    editar configuracion
    </div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
        <div class="mb-3">
              <label for="txtID" class="form-label">ID:</label>
              <input readonly value="<?php echo $txtID;?>" type="text"
                class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="txtID">
            </div>
            <div class="mb-3">
              <label for="nombreconfiguracion" class="form-label">nombre de la configuracion:</label>
              <input type="text" value="<?php echo $nombreconfiguracion;?>"
                class="form-control" name="nombreconfiguracion" id="nombreconfiguracion" aria-describedby="helpId" placeholder="nombreconfiguracion">
            </div>
            <div class="mb-3">
              <label for="valor" class="form-label">valor:</label>
              <input type="text" value="<?php echo $valor;?>"
                class="form-control" name="valor" id="valor" aria-describedby="helpId" placeholder="valor">
            </div>
            <button type="submit" class="btn btn-success">agregar</button>
             <a name="" id="" class="btn btn-primary" href="index.config.php" role="button">cancelar</a>
        </form>
    </div>
</div>

<?php include ("piepagina.php");?>
