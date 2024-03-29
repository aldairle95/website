<?php
include ("bd.php"); 
if($_POST){
    
    //recepcionamos valores
    $fecha=(isset($_POST['fecha']))?$_POST['fecha']:"";
    $titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
    $imagen=(isset($_FILES['imagen']['name']))?$_FILES['imagen']['name']:"";
    
    //adjuntado imagen
    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen=($imagen!="")? $fecha_imagen->getTimestamp()."_".$imagen:"";

    $tmp_imagen=$_FILES["imagen"]["tmp_name"];
    if($tmp_imagen!=""){
        move_uploaded_file($tmp_imagen,"../img/about/".$nombre_archivo_imagen);
    }
    $sentencia=$conexion->prepare("INSERT INTO `tbl_entradas` 
    (`ID`, `fecha`, `titulo`, `descripcion`,`imagen`) VALUES 
    (NULL, :fecha,:titulo,:descripcion, :imagen )");

    $sentencia->bindParam(":fecha",$fecha);
    $sentencia->bindParam(":titulo",$titulo);
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
    $sentencia->execute();
    $mensaje="registro creado con exito.";
    header("location:index.php?mensaje=".$mensaje);
}
include ("cabecera.php");
?>
<div class="card">
    <div class="card-header">
       crear entrada
    </div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-3">
              <label for="fecha" class="form-label">fecha:</label>
              <input type="date"
                class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="fecha">
            </div>
            <div class="mb-3">
              <label for="titulo" class="form-label">titulo:</label>
              <input type="text"
                class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="titulo">
            </div>
            <div class="mb-3">
              <label for="descripcion" class="form-label">descripcion:</label>
              <input type="text"
                class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="descripcion">
            </div>
            <div class="mb-3">
              <label for="imagen" class="form-label">imagen:</label>
              <input type="file"
                class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="imagen">
            </div>
            <button type="submit" class="btn btn-success">agregar</button>
             <a name="" id="" class="btn btn-primary" href="index.entrada.php" role="button">cancelar</a>
        </form>
    </div>
</div>
<?php 
include ("piepagina.php");
?>