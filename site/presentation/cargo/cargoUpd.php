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

    $id = isset($_GET['idcargo']) ? htmlspecialchars($_GET['idcargo']) : '';

     $rs = $cnn->ejecutar2("select nConsValor,cConsDesc from glob_constante
             where nConsValor = '$id'");
     $row = mysqli_fetch_assoc($rs)

?>
<script src="site/js/common.min.js"></script>

<div class="md-card  md-card-overlay">
    <!--<div class="md-card md-card-hover md-card-overlay">-->
    <div class="md-card-toolbar">
        <div class="uk-grid " >
            <div class="uk-width-3-10">

                <button type="button" class="uk-button btn-aqua-gradient-cabezera-mini md-btn-mini md-btn-primary md-btn   md-btn-wave-light md-btn-icon"
                                    name="btnList" id="btnList" href="javascript:void(0)">
                   <i class="uk-icon-list icon-mini" ></i>
                </button>
            </div>
            <div class="uk-width-large-5-10 uk-width-6-10 uk-container-center uk-text-left">
                <h2 class="md-card-toolbar-heading-text-cabecera " id="title-cabecera">
                    Actualizar Cargo
                </h2>
            </div>
        </div>
    </div>
    <div class="md-card-content">
        <div class="uk-form-row">
            <div class="uk-width-large-1-2 uk-width-medium-1-2 uk-width-small-1-2 uk-container-center">
                <div class="uk-grid">
                    <div class="uk-input-group">
                        <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-briefcase"></i></span>
                        <label>Descripcion</label>
                        <input type="text" class="md-input" name="txtcargo" id="txtcargo" maxlength="25" onkeypress="return ValLet(event)"
                               value="<?php echo $row['cConsDesc']; ?>" />
                    </div>
                </div>
            </div>
        </div>
        <form class="from_buscar">
                    <div class="uk-form-row" >
                    </div><div style="height:5px"></div>
                    <div class="uk-width-large-10-10" id="datos">
                    </div>
                </form>
    </div>
    <div class="md-card-overlay-content">
        <div style="height:7px"></div>
        <center>
            <table style="border-spacing:10px 0px;; border-collapse: separate">
                <tr>
                    <td>
                        <button type="button" class="uk-button md-btn-success md-btn  md-btn-small md-btn-wave-light md-btn-icon"
                                name="btnModificar" id="btnModificar" href="javascript:void(0)">
                            Modificar&emsp13;&emsp13;<i class="uk-icon-plus"  ></i>
                            </button>
                    </td>
                    <td>
                        <button type="button" class="uk-button md-btn-danger md-btn  md-btn-small md-btn-wave-light md-btn-icon"
                                name="btnCle" id="btnCle" href="javascript:void(0)">
                            Cancelar&emsp13;&emsp13;<i class="uk-icon-plus"  ></i>
                            </button>
                    </td>
                </tr>
            </table>
        </center>
    </div>
</div>

<script>
$(document).ready(function(e) {
    altair_page_heading.init();
    // material design
    altair_md.init();
    // forms
    altair_forms.init();

    $('#txtcargo').focus();
    // EVENTO MODIFICAR
    $('#btnModificar').off('click').click(function(e) {
            var id_cargo = '<?php echo $id; ?>';
            var descripcion = $('#txtcargo').val();
        if (!espacio_blanco.test(descripcion) || descripcion.length<3) {
         alert('El Nombre del Cargo tiene que ser un dato real');
        }
        else
        {
            $.post('negocio/cargo/updcargo.php',{
                id_cargo : id_cargo,
                descripcion : descripcion
            },
            function(data) {
                if (data==1){
                        alert('Actualizacion correcta');
                        $('#contenido').load('presentation/cargo/cargo.php');
                } else { alert('Error al actualizar. ' + data); }
            });
        }
    });
    // EVENTO VOLVER
    $('#btnList').off('click').click(function(e) {
      $('#contenido').load('presentation/cargo/cargo.php');
    });

    // EVENTO LIMPIAR
    $('#btnCle').off('click').click(function(e) {
      $('#contenido').load('presentation/cargo/cargo.php');
    });
});
</script>
