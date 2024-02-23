<?php 
include "bd.php";
//borrar registro
if(isset($_GET['txtID'])){

    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("DELETE FROM tbl_usuarios WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
}
//listar registros de servicios
$sentencia=$conexion->prepare("SELECT * FROM tbl_usuarios");
$sentencia->execute();
$lista_usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);
include ("cabecera.php");
?>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.usu.php" role="button">agregar registro </a>
    </div>
    <div class="card-body">
       <div class="table-responsive-sm">
        <table class="table" id="#table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">usuario</th>
                    <th scope="col">password</th>
                    <th scope="col">correo</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($lista_usuarios as $registro){ ?>
                <tr class="">
                    <td><?php echo $registro['ID']; ?></td>
                    <td><?php echo $registro['usuario']; ?></td>
                    <td><?php echo $registro['password']; ?></td>
                    <td><?php echo $registro['correo']; ?></td>
                    <td>
                        <a name="" id="" class="btn btn-primary" href="editar.usu.php?txtID=<?php echo $registro['ID'];?>" role="button">editar</a>
                        |
                        <a name="" id="" class="btn btn-danger" href="index.usu.php?txtID=<?php echo $registro['ID'];?>" role="button">eliminar</a>
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