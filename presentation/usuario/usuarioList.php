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

    $buscar = isset($_GET['bususuario']) ? htmlspecialchars($_GET['bususuario']) : '';
     $rs = $cnn->ejecutar("select us.cUsuCod,cPerNom,cPerApe,co.cConsDesc,us.cUsuNom from glob_usuario us
                                inner join pla_empleado em on us.cEmpCod=em.cEmpCod
                                inner join glob_persona pe on pe.cPerCod=em.cPerCod
                                inner join glob_constante co on co.nConsValor=us.cUsuRol
                    			      where us.cUsuEstado=1 and pe.cPerApe like '%$buscar%'
                                or pe.cPerNom like '%$buscar%' or us.cUsuNom like '%$buscar%'");

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
                        <th>Empleado</th>
                        <th>Tipo Usuario</th>
                        <th>Usuario</th>
                        <th style="width: 1%">Acciones</th>
                    </tr>
            </thead>
                <tbody>
                    <?php  if ($rs) {
                        $n=1;
        while ($row = mysqli_fetch_assoc($rs)) { ?>
                    <tr>
                        <td><?php echo $n++?></td>
                        <td><?php echo $row['CPERNOM'].' '.$row['CPERAPE'];?></td>
                        <td><?php echo $row['CCONSDESC'] ;?></td>
                        <td><?php echo $row['CUSUNOM'] ;?></td>
                        <td class="uk-text-center">
                            <a style="cursor: pointer" onclick="$('#contenido').load('presentation/usuario/usuarioUpd.php?idusuario='+<?php echo $row['CUSUCOD']; ?>);">
                                 <i class="md-icon material-icons uk-text-bold md-color-cyan-700">&#xE254;</i>
                             </a>
                           <a data-uk-modal="{target:'#NombredelModal',modal:false}"
                                onclick="$('#modal_body').load('presentation/usuario/usuarioDel.php?idusuario='+<?php echo $row['CUSUCOD'];?>)">
                                <i class="md-icon material-icons uk-text-bold md-color-deep-orange-A700">&#xE88F;</i>
                            </a>
                        </td>
                    </tr>
                   <?php }
    } ?>
                </tbody>
            </table>
        </div>
        </div>
<script>
$(document).ready(function(e) {
    altair_datatables.dt_default();
});

</script>
