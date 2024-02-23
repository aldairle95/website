<?php 
include ("bd.php");
//borrar registro
if(isset($_GET['txtID'])){

    //borrar imagen
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT imagen FROM tbl_equipo WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_imagen["imagen"])){
        if(file_exists("../img/team/".$registro_imagen["imagen"])){
            unlink("../img/team/".$registro_imagen["imagen"]);
        }
    }

    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("DELETE FROM tbl_equipo WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
}
//listar registros de entradas
$sentencia=$conexion->prepare("SELECT * FROM tbl_equipo");
$sentencia->execute();
$lista_equipo=$sentencia->fetchAll(PDO::FETCH_ASSOC);

include ("cabecera.php");
?>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.equipo.php" role="button">agregar registro </a>
    </div>
    <div class="card-body">
       <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">nombrecompleto</th>
                    <th scope="col">puesto</th>
                    <th scope="col">twitter</th>
                    <th scope="col">facebook</th>
                    <th scope="col">linkedin</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($lista_equipo as $registro){ ?>
                <tr class="">
                    <td><?php echo $registro['ID']; ?></td>
                    <td><img width="80"src="../img/team/<?php echo $registro['imagen']; ?>"></td>
                    <td><?php echo $registro['nombrecompleto']; ?></td>
                    <td><?php echo $registro['puesto']; ?></td>
                    <td><?php echo $registro['twitter']; ?></td>
                    <td><?php echo $registro['facebook']; ?></td>
                    <td><?php echo $registro['linkedin']; ?></td>
                    
                    <td>
                        <a name="" id="" class="btn btn-primary" href="editar.equipo.php?txtID=<?php echo $registro['ID'];?>" role="button">editar</a>
                        |
                        <a name="" id="" class="btn btn-danger" href="index.equipo.php?txtID=<?php echo $registro['ID'];?>" role="button">eliminar</a>
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