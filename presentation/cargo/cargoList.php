<?php

       session_start();
    if (!isset ($_SESSION['Auth.UsuarioID'])) {
            echo "<script>window.location='login.php';</script>";
            exit();
    }
    include_once '../../datos/conexion.php';
    $cnn = new conexion();

?>
<?php

    $nomtipo = isset($_GET['buscargo']) ? htmlspecialchars($_GET['buscargo']) : '';
     $rs = $cnn->ejecutar("select nConsValor,cConsDesc from glob_constante
             where cConsDesc like '%$nomtipo%' and nConsGrupo=1001 and nConsValor not in(1001)");

?>
<div class="md-card uk-margin-medium-bottom" >
                <div class="md-card-content" style=' overflow-x: auto;
    overflow-y: scroll;
    max-height:600px;
    white-space:nowrap'>
            <table id="dt_default" class="uk-table" >
                <thead>
                    <tr>
                        <th>N</th>
                        <th>Nombre</th>
                        <th style="width: 1%">Acciones</th>
                    </tr>
            </thead>
                <tbody>
                    <?php $i=1;
                    while ($row = mysqli_fetch_assoc($rs)) {
                    ?>
                    <tr>
                        <td><?php echo $i++?></td>
                        <td><?php echo $row['CCONSDESC'] ;?></td>
                        <td class="uk-text-center">
                            <a style="cursor: pointer" onclick="$('#contenido').load('presentation/cargo/cargoUpd.php?idcargo='+<?php echo $row['NCONSVALOR']; ?>);">
                                 <i class="md-icon material-icons uk-text-bold md-color-cyan-700">&#xE254;</i>
                             </a>
                            <a data-uk-modal="{target:'#NombredelModal',modal:false}"
                                onclick="$('#modal_body').load('presentation/cargo/cargoDel.php?idcargo='+<?php echo $row['NCONSVALOR']; ?>)">
                                <i class="md-icon material-icons uk-text-bold md-color-deep-orange-A700">&#xE88F;</i>
                            </a>
                        </td>
                    </tr>
                   <?php }?>
                </tbody>
            </table>
        </div>
        </div>

<script>
$(document).ready(function(e) {
    altair_datatables.dt_default();
    $('#txtcargo').focus();
});

</script>
