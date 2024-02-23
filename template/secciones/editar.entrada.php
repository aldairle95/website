<?php 
include ("bd.php");
//recuperar ID del registro para editar
if(isset($_GET['txtID'])){
  
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT * FROM tbl_entradas WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $fecha=$registro['fecha'];
    $titulo=$registro['titulo'];
    $descripcion=$registro['descripcion'];
    $imagen=$registro['imagen'];
}
if($_POST){
  
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $fecha=(isset($_POST['fecha']))?$_POST['fecha']:"";
    $titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
  

    $sentencia=$conexion->prepare("UPDATE tbl_entradas
     SET titulo=:titulo,
        fecha=:fecha,
        descripcion=:descripcion
        WHERE id=:id");

    $sentencia->bindParam(":titulo",$titulo);
    $sentencia->bindParam(":fecha",$fecha);
    $sentencia->bindParam(":descripcion",$descripcion);
   
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $mensaje="registro modificado con exito.";
    header("location:index.php?$mensaje=".$mensaje);

    if($_FILES["imagen"]["tmp_name"]!=""){ 
    $imagen=(isset($_FILES['imagen']['name']))?$_FILES['imagen']['name']:"";
    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen=($imagen!="")?$fecha_imagen->getTimestamp."_".$imagen:"";

    $tmp_imagen=$_FILES["imagen"]["tmp_name"];
    move_uploaded_file($tmp_imagen,"../img/about/".$nombre_archivo_imagen);
    //borrar imagen
    $sentencia=$conexion->prepare("SELECT imagen FROM tbl_entradas WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_imagen["imagen"])){
        if(file_exists("../img/about/".$registro_imagen["imagen"])){
            unlink("../img/about/".$registro_imagen["imagen"]);
        }
    }

    $sentencia=$conexion->prepare("UPDATE tbl_entradas SET imagen=:imagen WHERE id=:id");
    $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $mensaje="registro modificado con exito.";
    header("location:index.entrada.php?mensaje=".$mensaje);
  }
}
include ("cabecera.php");
?>
editar entrada
<div class="card">
    <div class="card-header">
    editar servicios
    </div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
            
        <div class="mb-3">
              <label for="txtID" class="form-label">ID:</label>
              <input readonly value="<?php echo $txtID;?>" type="text"
                class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="txtID">
            </div>
        <div class="mb-3">
              <label for="fecha" class="form-label">fecha:</label>
              <input value="<?php echo $fecha;?>" type="date"
                class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="fecha">
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
            <div class="mb-3">
              <label for="imagen" class="form-label">imagen:</label>
              <img width="80"src="../img/about/<?php echo $imagen;?>">
              <input type="file"
                class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="imagen">
            </div>
            <button type="submit" class="btn btn-success">actualizar</button>
             <a name="" id="" class="btn btn-primary" href="index.entrada.php" role="button">cancelar</a>
        </form>
    </div>
</div>
<?php 
include ("piepagina.php");
?>