<?php 
include ("bd.php");

//recuperar ID del registro para editar
if(isset($_GET['txtID'])){
   
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT * FROM tbl_portafolio WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $titulo=$registro['titulo'];
    $subtitulo=$registro['subtitulo'];
    $imagen=$registro['imagen'];
    $descripcion=$registro['descripcion'];
    $cliente=$registro['cliente'];
    $categoria=$registro['categoria'];
    $url=$registro['url'];
}
if($_POST){

    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
    $subtitulo=(isset($_POST['subtitulo']))?$_POST['subtitulo']:"";
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
    $cliente=(isset($_POST['cliente']))?$_POST['cliente']:"";
    $categoria=(isset($_POST['categoria']))?$_POST['categoria']:"";
    $url=(isset($_POST['url']))?$_POST['url']:"";;

    $sentencia=$conexion->prepare("UPDATE tbl_portafolio
     SET titulo=:titulo,
        subtitulo=:subtitulo,
        descripcion=:descripcion,
        cliente=:cliente,
        categoria=:categoria,
        url=:url
        WHERE id=:id");

    $sentencia->bindParam(":titulo",$titulo);
    $sentencia->bindParam(":subtitulo",$subtitulo);
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":cliente",$cliente);
    $sentencia->bindParam(":categoria",$categoria);
    $sentencia->bindParam(":url",$url);
    
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $mensaje="registro modificado con exito.";
    header("location:index.php?$mensaje=".$mensaje);

    if($_FILES["imagen"]["tmp_name"]!=""){ 
    $imagen=(isset($_FILES['imagen']['name']))?$_FILES['imagen']['name']:"";
    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen=($imagen!="")?$fecha_imagen->getTimestamp."_".$imagen:"";

    $tmp_imagen=$_FILES["imagen"]["tmp_name"];
    move_uploaded_file($tmp_imagen,"../img/portfolio/".$nombre_archivo_imagen);
    //borrar imagen
    $sentencia=$conexion->prepare("SELECT imagen FROM tbl_portafolio WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_imagen["imagen"])){
        if(file_exists("../img/portfolio/".$registro_imagen["imagen"])){
            unlink("../img/portfolio/".$registro_imagen["imagen"]);
        }
    }

    $sentencia=$conexion->prepare("UPDATE tbl_portafolio SET imagen=:imagen WHERE id=:id");
    $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $mensaje="registro modificado con exito.";
    header("location:index,porta.php?mensaje=".$mensaje);
  }

}

include ("cabecera.php");
?>
<div class="card">
    <div class="card-header">
    Editar portafolio
    </div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
        <div class="mb-3">
              <label for="txtID" class="form-label">ID</label>
              <input value="<?php echo $txtID;?>" type="text"
                class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="txtID">
            </div>
            <div class="mb-3">
              <label for="titulo" class="form-label">titulo</label>
              <input value="<?php echo $titulo;?>" type="text"
                class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="titulo">
            </div>
            <div class="mb-3">
              <label for="subtitulo" class="form-label">subtitulo:</label>
              <input value="<?php echo $subtitulo;?>" type="text"
                class="form-control" name="subtitulo" id="subtitulo" aria-describedby="helpId" placeholder="subtitulo">
            </div>
            <div class="mb-3">
              <label for="imagen" class="form-label">imagen:</label>
              <img width="80"src="../../../assets/img/portfolio/<?php echo $imagen;?>">
              <input  type="file"
                class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="imagen">
            </div>
            <div class="mb-3">
              <label for="descripcion" class="form-label">descripcion:</label>
              <input  value="<?php echo $descripcion;?>" type="text"
                class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="descripcion">
            </div>
            <div class="mb-3">
              <label for="cliente" class="form-label">cliente:</label>
              <input  value="<?php echo $cliente;?>" type="text"
                class="form-control" name="cliente" id="cliente" aria-describedby="helpId" placeholder="cliente">
            </div>
            <div class="mb-3">
              <label for="categoria" class="form-label">categoria:</label>
              <input value="<?php echo $categoria;?>" type="text"
                class="form-control" name="categoria" id="categoria" aria-describedby="helpId" placeholder="categoria">
            </div>
            <div class="mb-3">
              <label for="url" class="form-label">url:</label>
              <input   value="<?php echo $url;?>" type="text"
                class="form-control" name="url" id="url" aria-describedby="helpId" placeholder="url">
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
             <a name="" id="" class="btn btn-primary" href="index.porta.php" role="button">cancelar</a>
        </form>
    </div>
</div>
<?php 
include ("piepagina.php");
?>