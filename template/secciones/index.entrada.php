<?php 
include ("bd.php");
//borrar registro
if(isset($_GET['txtID'])){

    //borrar imagen
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT imagen FROM tbl_entradas WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_imagen["imagen"])){
        if(file_exists("../img/about/".$registro_imagen["imagen"])){
            unlink("../img/about/".$registro_imagen["imagen"]);
        }
    }

    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("DELETE FROM tbl_entradas WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
}

//listar registros de entradas
$sentencia=$conexion->prepare("SELECT * FROM tbl_entradas");
$sentencia->execute();
$lista_entradas=$sentencia->fetchAll(PDO::FETCH_ASSOC);
include ("cabecera.php");
?>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.entrada.php" role="button">agregar registro </a>
    </div>
    <div class="card-body">
       <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($lista_entradas as $registro){ ?>
                <tr class="">
                    <td><?php echo $registro['ID']; ?></td>
                    <td><?php echo $registro['fecha']; ?></td>
                    <td><?php echo $registro['titulo']; ?></td>
                    <td><?php echo $registro['descripcion']; ?></td>
                    <td><img width="80"src="../img/about/<?php echo $registro['imagen']; ?>"></td>
                    <td>
                        <a name="" id="" class="btn btn-primary" href="editar.entrada.php?txtID=<?php echo $registro['ID'];?>" role="button">editar</a>
                        |
                        <a name="" id="" class="btn btn-danger" href="index.entrada.php?txtID=<?php echo $registro['ID'];?>" role="button">eliminar</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
       </div>
       
    </div>
</div>
<?php 
include ("piepagina.php");
?>