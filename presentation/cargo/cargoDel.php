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
        $id = 0;
	if (isset($_GET['idcargo'])) {
		$id = $_GET['idcargo'];
                $rs = $cnn->ejecutar("SELECT nConsValor,cConsDesc FROM glob_constante
                        where nConsValor= '$id'");
                $row = mysqli_fetch_assoc($rs);
	}

?>
<div class="md-card  md-card-overlay">
    <!--<div class="md-card md-card-hover md-card-overlay">-->
    <div class="md-card-toolbar">
        <div class="uk-grid " >

            <div class="uk-width-large-5-10 uk-width-6-10 uk-container-center uk-text-center">
                <h2 class="md-card-toolbar-heading-text-cabecera " id="title-cabecera">

                                 Eliminar Cargo

                </h2>
            </div>
        </div>
    </div>
    <div class="md-card-content">
        <div class="uk-form-row">
            <div class="uk-width-large-1-2 uk-width-medium-1-2 uk-width-small-1-2 uk-container-center">
                <div class="uk-grid">
                    <div class="uk-input-group">
               <p class="text-red"><b>¿Desea eliminar el Cargo : <label class="uk-text-bold md-color-deep-orange-A700">"<?php if($id) { echo htmlspecialchars($row['CCONSDESC']); } ?>"</label> completamente?</b></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="md-card-overlay-content">
        <div style="height:7px"></div>
        <center>
            <table style="border-spacing:10px 0px;; border-collapse: separate">
                <tr>
                    <td>
                        <button type="button" class="uk-button uk-button-success  md-btn-wave-light md-btn-icon uk-modal-close"
                                name="btnSi" id="btnSi" href="javascript:void(0)">
                            SI&emsp13;&emsp13;<i class="uk-icon-plus"  ></i>
                            </button>
                        <button type="button" class="uk-button uk-button-danger md-btn-wave-light md-btn-icon uk-modal-close"
                                name="btnNo" id="btnNo" href="javascript:void(0)">
                            NO&emsp13;&emsp13;<i class="uk-icon-plus"  ></i>
                            </button>
                    </td>
                </tr>
            </table>
        </center>
    </div>
</div>
<script>
$(document).ready(function(e) {
        $('#btnSi').off('click').click(function(e) {
            var id_cargo = '<?php echo $id; ?>';

		$.post('negocio/cargo/delcargo.php',{
                id_cargo : id_cargo
                },
                function(data) {
                if (data=='1'){
                     alert('El Cargo se elimino correctamente');
                     mostrarDatos();
                        $('#NombredelModal').modal('hide');

                }else{
                    alert(data);
                    }
                });
	});
});
</script>
<script src="site/system/validacion/select2.js" type="text/javascript"></script>
