<?php
	session_start();
	if (!isset ($_SESSION['Auth.UsuarioID'])) {
		echo "<script>window.location='login.php';</script>";
		exit();
	}
?>

 
<div class="md-card  md-card-overlay">
    <!--<div class="md-card md-card-hover md-card-overlay">-->
    <div class="md-card-toolbar">
        <div class="uk-grid " >
            <div class="uk-width-3-10">
                <button type="button" class="uk-button btn-aqua-gradient-cabezera-mini md-btn-mini md-btn-primary md-btn   md-btn-wave-light md-btn-icon" 
                                    name="btnNuevo" id="btnNuevo" href="javascript:void(0)">
                   <i class="uk-icon-plus icon-mini" ></i>
                </button>
               
            </div>
            <div class="uk-width-large-5-10 uk-width-6-10 uk-container-center uk-text-left">
                <h2 class="md-card-toolbar-heading-text-cabecera " id="title-cabecera">
                    <strong>   Listar Usuario</strong> 
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
                        <label>Apellidos</label>
                        <input type="text" class="md-input" name="txtNombre" id="txtNombre" />
                        <span class="uk-input-group-addon">
                            <button type="button" class="uk-button btn-aqua-gradient-b-mini md-btn-mini md-btn-primary md-btn   md-btn-wave-light md-btn-icon" 
                                    name="btnBuscar" id="btnBuscar" href="javascript:void(0)">
                   <i class="uk-icon-search icon-mini" ></i>
                </button>
                        </span>
                    </div>
                      
                </div>
            </div>
        </div>
        <form class="from_cargo">
                    <div class="uk-form-row" >
                    </div><div style="height:5px"></div>
                    <div class="uk-width-large-10-10" id="datos"> 
                    </div>
                </form>
    </div>
  
</div>
<!--<script src="site/js/altair_admin_common.js" type="text/javascript"></script>-->

<!--<script src="site/js/altair_admin_common.min.js"></script>-->

    <!-- common functions -->
    <script src="site/js/common.min.js"></script>
   
   
     <!-- page specific plugins -->
    <!-- DataTables -->
    <script src="site/plugins/datatables/media/js/jquery.dataTables.js"></script>
 
    <!-- datatables custom integration -->
    <script src="site/js/custom/datatables/datatables.uikit.min.js"></script>

    <!--  datatables functions -->
    <script src="site/js/pages/plugins_datatables.min.js"></script>
    
<script>
$(document).ready(function(e) {
   // page heading
    altair_page_heading.init();
   // material design
    altair_md.init();
   // material design
    altair_page_heading.init();
   // material design
    altair_md.init();
   // forms
    altair_forms.init();
     mostrarDatos();
    $('#txtNombre').focus();
    $('#btnNuevo').off('click').click(function(e) {
      $('#contenido').load('presentation/usuario/usuarioReg.php');
    });
    $('#btnBuscar').off('click').click(function(e) {
            mostrarDatos();
    });
});
function mostrarDatos() {
	$('#datos').load('presentation/usuario/usuarioList.php?bususuario='+encodeURIComponent($('#txtNombre').val()));
}
</script>