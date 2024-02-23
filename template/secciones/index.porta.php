<?php 
include ("bd.php");

//borrar registro
if(isset($_GET['txtID'])){

    //borrar imagen
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT imagen FROM tbl_portafolio WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_imagen["imagen"])){
        if(file_exists("../../../assets/img/portfolio/".$registro_imagen["imagen"])){
            unlink("../../../assets/img/portfolio/".$registro_imagen["imagen"]);
        }
    }

    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("DELETE FROM tbl_portafolio WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
}

//listar registros de portafolio
$sentencia=$conexion->prepare("SELECT * FROM tbl_portafolio");
$sentencia->execute();
$lista_portafolio=$sentencia->fetchAll(PDO::FETCH_ASSOC);

include ("cabecera.php");
?>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.porta.php" role="button">agregar registro </a>
    </div>
    <div class="card-body">
       <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">subtitulo</th>
                    <th scope="col">imagen</th>
                    <th scope="col">descripcion</th>
                    <th scope="col">cliente</th>
                    <th scope="col">categoria</th>
                    <th scope="col">url</th>
                    <th scope="col">accion</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($lista_portafolio as $registro){ ?>
                <tr class="">
                    <td><?php echo $registro['ID']; ?></td>
                    <td><?php echo $registro['titulo']; ?></td>
                    <td><?php echo $registro['subtitulo']; ?></td>
                    <td><img width="80"src="../img/portfolio/<?php echo $registro['imagen']; ?>"></td>
                    <td><?php echo $registro['descripcion']; ?></td>
                    <td><?php echo $registro['cliente']; ?></td>
                    <td><?php echo $registro['categoria']; ?></td>
                    <td><?php echo $registro['url']; ?></td>
                    <td>
                        <a name="" id="" class="btn btn-primary" href="editar.porta.php?txtID=<?php echo $registro['ID'];?>" role="button">editar</a>
                        |
                        <a name="" id="" class="btn btn-danger" href="index.porta.php?txtID=<?php echo $registro['ID'];?>" role="button">eliminar</a>
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