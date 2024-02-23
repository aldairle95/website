<?php 
include ("bd.php");
if($_POST){
    
    //recepcionamos valores
    $imagen=(isset($_FILES['imagen']['name']))?$_FILES['imagen']['name']:"";
    $nombrecompleto=(isset($_POST['nombrecompleto']))?$_POST['nombrecompleto']:"";
    $puesto=(isset($_POST['puesto']))?$_POST['puesto']:"";
    $twitter=(isset($_POST['twitter']))?$_POST['twitter']:"";
    $facebook=(isset($_POST['facebook']))?$_POST['facebook']:"";
    $linkedin=(isset($_POST['linkedin']))?$_POST['linkedin']:"";
   
    
    //adjuntado imagen
    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen=($imagen!="")? $fecha_imagen->getTimestamp()."_".$imagen:"";

    $tmp_imagen=$_FILES["imagen"]["tmp_name"];
    if($tmp_imagen!=""){
        move_uploaded_file($tmp_imagen,"../img/team/".$nombre_archivo_imagen);
    }
    $sentencia=$conexion->prepare("INSERT INTO `tbl_equipo` 
    (`ID`, `imagen`, `nombrecompleto`, `puesto`,`twitter`,`facebook`,`linkedin`) VALUES 
    (NULL, :imagen,:nombrecompleto,:puesto,:twitter,:facebook,:linkedin )");

    $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
    $sentencia->bindParam(":nombrecompleto",$nombrecompleto);
    $sentencia->bindParam(":puesto",$puesto);
    $sentencia->bindParam(":twitter",$twitter);
    $sentencia->bindParam(":facebook",$facebook);
    $sentencia->bindParam(":linkedin",$linkedin);
    $sentencia->execute();
    $mensaje="registro creado con exito.";
    header("location:index.equipo.php?mensaje=".$mensaje);
}

include ("cabecera.php");
?>
<div class="card">
    <div class="card-header">
       crear equipo
    </div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
           <div class="mb-3">
              <label for="imagen" class="form-label">imagen:</label>
              <input type="file"
                class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="imagen">
            </div>
            <div class="mb-3">
              <label for="nombrecompleto" class="form-label">nombrecompleto:</label>
              <input type="text"
                class="form-control" name="nombrecompleto" id="nombrecompleto" aria-describedby="helpId" placeholder="nombrecompleto">
            </div>
            <div class="mb-3">
              <label for="puesto" class="form-label">puesto:</label>
              <input type="text"
                class="form-control" name="puesto" id="puesto" aria-describedby="helpId" placeholder="puesto">
            </div>
            <div class="mb-3">
              <label for="twitter" class="form-label">twitter:</label>
              <input type="text"
                class="form-control" name="twitter" id="twitter" aria-describedby="helpId" placeholder="twitter">
            </div>
            <div class="mb-3">
              <label for="facebook" class="form-label">facebook:</label>
              <input type="text"
                class="form-control" name="facebook" id="facebook" aria-describedby="helpId" placeholder="facebook">
            </div>
            <div class="mb-3">
              <label for="linkedin" class="form-label">linkedin:</label>
              <input type="text"
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