<?php 
include ("/bd.php");

//recuperar ID del registro para editar
if(isset($_GET['txtID'])){
  
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT * FROM tbl_equipo WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $imagen=$registro['imagen'];
    $nombrecompleto=$registro['nombrecompleto'];
    $puesto=$registro['puesto'];
    $twitter=$registro['twitter'];
    $facebook=$registro['facebook'];
    $linkedin=$registro['linkedin'];
}
if($_POST){
  
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $imagen=(isset($_POST['imagen']))?$_POST['imagen']:"";
    $nombrecompleto=(isset($_POST['nombrecompleto']))?$_POST['nombrecompleto']:"";
    $puesto=(isset($_POST['puesto']))?$_POST['puesto']:"";
    $twitter=(isset($_POST['twitter']))?$_POST['twitter']:"";
    $facebook=(isset($_POST['facebook']))?$_POST['facebook']:"";
    $linkedin=(isset($_POST['linkedin']))?$_POST['linkedin']:"";

    $sentencia=$conexion->prepare("UPDATE tbl_equipo
     SET nombrecompleto=:nombrecompleto,
     puesto=:puesto,
     twitter=:twitter,
     facebook=:facebook,
     linkedin=:linkedin
        WHERE id=:id");

    $sentencia->bindParam(":nombrecompleto",$nombrecompleto);
    $sentencia->bindParam(":puesto",$puesto);
    $sentencia->bindParam(":twitter",$twitter);
    $sentencia->bindParam(":facebook",$facebook);
    $sentencia->bindParam(":linkedin",$linkedin);
   
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $mensaje="registro modificado con exito.";
    header("location:index.php?$mensaje=".$mensaje);

    if($_FILES["imagen"]["tmp_name"]!=""){ 
    $imagen=(isset($_FILES['imagen']['name']))?$_FILES['imagen']['name']:"";
    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen=($imagen!="")?$fecha_imagen->getTimestamp()."_".$imagen:"";

    $tmp_imagen=$_FILES["imagen"]["tmp_name"];
    move_uploaded_file($tmp_imagen,"../img/team/".$nombre_archivo_imagen);
    //borrar imagen
    $sentencia=$conexion->prepare("SELECT imagen FROM tbl_equipo WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_imagen["imagen"])){
        if(file_exists("../img/team/".$registro_imagen["imagen"])){
            unlink("../img/team/".$registro_imagen["imagen"]);
        }
    }

    $sentencia=$conexion->prepare("UPDATE tbl_equipo SET imagen=:imagen WHERE id=:id");
    $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $mensaje="registro modificado con exito.";
    header("location:index.porta.php?mensaje=".$mensaje);
  }
}
include ("cabecera.php");
?>
<div class="card">
    <div class="card-header">
       editar equipo
    </div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
         <div class="mb-3">
              <label for="txtID" class="form-label">ID:</label>
              <input readonly value="<?php echo $txtID;?>" type="text"
                class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="txtID">
            </div>
           <div class="mb-3">
              <label for="imagen" class="form-label">imagen:</label>
              <img width="80"src="../../../assets/img/team/<?php echo $imagen;?>">
              <input type="file" value="<?php echo $imagen;?>"
                class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="imagen">
            </div>
            <div class="mb-3">
              <label for="nombrecompleto" class="form-label">nombrecompleto:</label>
              <input type="text" value="<?php echo $nombrecompleto;?>"
                class="form-control" name="nombrecompleto" id="nombrecompleto" aria-describedby="helpId" placeholder="nombrecompleto">
            </div>
            <div class="mb-3">
              <label for="puesto" class="form-label">puesto:</label>
              <input type="text" value="<?php echo $puesto;?>"
                class="form-control" name="puesto" id="puesto" aria-describedby="helpId" placeholder="puesto">
            </div>
            <div class="mb-3">
              <label for="twitter" class="form-label">twitter:</label>
              <input type="text" value="<?php echo $twitter;?>"
                class="form-control" name="twitter" id="twitter" aria-describedby="helpId" placeholder="twitter">
            </div>
            <div class="mb-3">
              <label for="facebook" class="form-label">facebook:</label>
              <input type="text" value="<?php echo $facebook;?>"
                class="form-control" name="facebook" id="facebook" aria-describedby="helpId" placeholder="facebook">
            </div>
            <div class="mb-3">
              <label for="linkedin" class="form-label">linkedin:</label>
              <input type="text" value="<?php echo $linkedin;?>"
                class="form-control" name="linkedin" id="linkedin" aria-describedby="helpId" placeholder="linkedin">
            </div>
            <button type="submit" class="btn btn-success">agregar</button>
             <a name="" id="" class="btn btn-primary" href="index.equipo.php" role="button">cancelar</a>
        </form>
    </div>
</div>
<?php 
include ("piepagina.php");
?>