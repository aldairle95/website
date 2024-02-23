<?php 
include ("bd.php");
//borrar registro
if(isset($_GET['txtID'])){

    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("DELETE FROM tbl_servicios WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
}

//listar registros de servicios
$sentencia=$conexion->prepare("SELECT * FROM tbl_servicios");
$sentencia->execute();
$lista_servicios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

include ("cabecera.php");
?>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.servi.php" role="button">agregar registro </a>
    </div>
    <div class="card-body">
       <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Icono</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($lista_servicios as $registro){ ?>
                <tr class="">
                    <td><?php echo $registro['ID']; ?></td>
                    <td><?php echo $registro['icono']; ?></td>
                    <td><?php echo $registro['titulo']; ?></td>
                    <td><?php echo $registro['descripcion']; ?></td>
                    <td>
                        <a name="" id="" class="btn btn-primary" href="editar.servi.php?txtID=<?php echo $registro['ID'];?>" role="button">editar</a>
                        |
                        <a name="" id="" class="btn btn-danger" href="index.servi.php?txtID=<?php echo $registro['ID'];?>" role="button">eliminar</a>
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