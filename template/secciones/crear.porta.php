<?php 
include ("bd.php");
if($_POST){
    
    //recepcionamos valores
    $titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
    $subtitulo=(isset($_POST['subtitulo']))?$_POST['subtitulo']:"";
    $imagen=(isset($_FILES['imagen']['name']))?$_FILES['imagen']['name']:"";
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
    $cliente=(isset($_POST['cliente']))?$_POST['cliente']:"";
    $categoria=(isset($_POST['categoria']))?$_POST['categoria']:"";
    $url=(isset($_POST['url']))?$_POST['url']:"";
    
    //adjuntado imagen
    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen=($imagen!="")? $fecha_imagen->getTimestamp."_".$imagen:"";

    $tmp_imagen=$_FILES["imagen"]["tmp_name"];
    if($tmp_imagen!=""){
        move_uploaded_file($tmp_imagen,"../img/portfolio/".$nombre_archivo_imagen);
    }


    $sentencia=$conexion->prepare("INSERT INTO `tbl_portafolio` 
    (`ID`, `titulo`, `subtitulo`, `imagen`, `descripcion`, `cliente`, `categoria`, `url`) VALUES 
    (NULL, :titulo,:subtitulo, :imagen, :descripcion, :cliente, :categoria,:url )");

    $sentencia->bindParam(":titulo",$titulo);
    $sentencia->bindParam(":subtitulo",$subtitulo);
    $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":cliente",$cliente);
    $sentencia->bindParam(":categoria",$categoria);
    $sentencia->bindParam(":url",$url);
    $sentencia->execute();
    $mensaje="registro creado con exito.";
    header("location:index.porta.php?mensaje=".$mensaje);
}
include "cabecera.php";
?>
<div class="card">
    <div class="card-header">
       crear portafolio
    </div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-3">
              <label for="titulo" class="form-label">titulo</label>
              <input type="text"
                class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="titulo">
            </div>
            <div class="mb-3">
              <label for="subtitulo" class="form-label">subtitulo:</label>
              <input type="text"
                class="form-control" name="subtitulo" id="subtitulo" aria-describedby="helpId" placeholder="subtitulo">
            </div>
            <div class="mb-3">
              <label for="imagen" class="form-label">imagen:</label>
              <input type="file"
                class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="imagen">
            </div>
            <div class="mb-3">
              <label for="descripcion" class="form-label">descripcion:</label>
              <input type="text"
                class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="descripcion">
            </div>
            <div class="mb-3">
              <label for="cliente" class="form-label">cliente:</label>
              <input type="text"
                class="form-control" name="cliente" id="cliente" aria-describedby="helpId" placeholder="cliente">
            </div>
            <div class="mb-3">
              <label for="categoria" class="form-label">categoria:</label>
              <input type="text"
                class="form-control" name="categoria" id="categoria" aria-describedby="helpId" placeholder="categoria">
            </div>
            <div class="mb-3">
              <label for="url" class="form-label">url:</label>
              <input type="text"
                class="form-control" name="url" id="url" aria-describedby="helpId" placeholder="url">
            </div>
            <button type="submit" class="btn btn-success">agregar</button>
             <a name="" id="" class="btn btn-primary" href="index.porta.php" role="button">cancelar</a>
        </form>
    </div>
</div>
<?php 
include "piepagina.php";
?>