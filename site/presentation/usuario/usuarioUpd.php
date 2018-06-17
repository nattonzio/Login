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

    $id = isset($_GET['idusuario']) ? htmlspecialchars($_GET['idusuario']) : '';

     $rs = $cnn->ejecutar("select us.cUsuCod,cPerNom,cPerApe,co.cConsDesc,us.cUsuNom,cUsuRol from glob_usuario us
                                inner join pla_empleado em on us.cEmpCod=em.cEmpCod
                                inner join glob_persona pe on pe.cPerCod=em.cPerCod
                                inner join glob_constante co on co.nConsValor=us.cUsuRol
             										where REPLACE(us.cUsuCod,0,'') = '$id' ");
     $row = mysqli_fetch_assoc($rs);
    $rs2 = $cnn->ejecutar2("select nConsValor,cConsDesc from glob_constante where nConsGrupo=1001 and nConsValor not in(1001)");
?>
    <!-- common functions -->
    <script src="site/js/common.min.js"></script>
    <script src="site/plugins/ion.rangeslider/js/ion.rangeSlider.min.js"></script>
    <!-- inputmask-->
    <script src="site/plugins/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>

    <!--  forms advanced functions -->
    <script src="site/js/pages/forms_advanced.min.js"></script>

       <!-- kendo UI -->
    <script src="site/js/kendoui_custom.min.js"></script>

    <!--  kendoui functions -->
    <script src="site/js/pages/kendoui.min.js"></script>


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
                    <strong>Modificar Usuario</strong>
                </h2>
            </div>
        </div>
    </div>
    <div class="md-card-content">
        <div class="uk-form-row">
            <div class="uk-width-large-1-2 uk-width-medium-1-2 uk-width-small-1-2 uk-container-center">
                <div class="uk-grid">
                    <div class="uk-input-group">
                       <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-male"></i></span>

                        <input type="text" value="<?php echo $row['CPERNOM'].' '.$row['CPERAPE'];  ?>" placeholder="Escoga el usuario"  readonly class="md-input" name="txtusuario" id="txtusuario" />
                        <input type="text" value="<?php echo $row['CUSUCOD'];  ?>" readonly style="display: none" name="txtidper" id="txtidper" />
                          <span class="uk-input-group-addon">
                              <button type="button" class="uk-button btn-aqua-gradient-b-mini md-btn-mini md-btn-primary md-btn   md-btn-wave-light md-btn-icon"
                                        name="btnBuscar" id="btnBuscar"
                                         data-uk-modal="{target:'#NombredelModal',modal:false}"
                                onclick="$('#modal_body').load('presentation/usuario/personaVis.php')" href="javascript:void(0)">
                                    <i class="uk-icon-search icon-mini" ></i>
                                     </button>
                             </span>
                    </div>
                </div>

                <div class="uk-input-group">
                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-user"></i></span>
                             <input type="text" value="<?php echo $row['CUSUNOM'];  ?>" placeholder="Usuario"  class="md-input" name="txtusuario2" id="txtusuario2" />
                </div>
                 <div class="uk-input-group">
                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-lock"></i></span>
                             <input type="password" placeholder="Contraseña Actual"  class="md-input" name="txtpassac" id="txtpassac" />
                </div>
                 <div class="uk-input-group">
                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-lock"></i></span>
                             <input type="password" placeholder="Contraseña Nueva"  class="md-input" name="txtpass" id="txtpass" />
                </div>
                 <div class="uk-input-group">
                     <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-lock"></i></span>
                     <input type="password" placeholder="Confirmar Contraseña"  class="md-input" name="txtpass2" id="txtpass2" />
                </div>
                <br>
                <div class="uk-input-group">

                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-tasks"></i></span>

                   <select id="kUI_combobox_select" class=" uk-form-width-large" placeholder="Selecciona Tipo Usuario"
                           style="width: 100%;position: absolute;top:px">

                       <?php while ($row2 = mysqli_fetch_assoc($rs2)) {
                            ?>
														<option value="<?php echo $row2['nConsValor'];?>"
                                    <?php if($row2['nConsValor']==$row['CUSUROL']){ ?> selected <?php } ?>>
                                <?php echo $row2['cConsDesc'] ;?>
                            </option>
                          <?php } ?>
                   </select>
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
                                  name="btnRegistrar" id="btnRegistrar" href="javascript:void(0)">
                            Modificar&emsp13;&emsp13;<i class="uk-icon-plus"  ></i>
                            </button>
                    </td>
                    <td>
                        <button type="button" class="uk-button md-btn-danger md-btn  md-btn-small md-btn-wave-light md-btn-icon"
                                name="btnlimpiar" onclick="limpiar()"id="btnlimpiar" href="javascript:void(0)">
                            Cancelar&emsp13;&emsp13;<i class="uk-icon-plus"  ></i>
                            </button>
                    </td>
                </tr>
            </table>
        </center>
    </div>
</div>
<!--<script src="site/js/altair_admin_common.js" type="text/javascript"></script>-->

<!--<script src="site/js/altair_admin_common.min.js"></script>-->
<script>
$(document).ready(function(e) {
     altair_page_heading.init();

        // material design
        altair_md.init();

        // forms
        altair_forms.init();
	$('#txttipoproducto').focus();
	$('#btnList').off('click').click(function(e) {
          $('#contenido').load('presentation/usuario/usuario.php');
	});
        $('#btnRegistrar').off('click').click(function(e) {
            var id_usuario = '<?php echo $id; ?>';
            var idper = $('#txtidper').val();
            var usu = $('#txtusuario2').val();
            var passac = $('#txtpassac').val();
            var pass = $('#txtpass').val();
            var pass2 = $('#txtpass2').val();
            if (idper=='') {
             alert('Escoga el usuario');return false;
            }
            if (usu.length<3) {
             alert('Ingrese el Usuario Correctamente');return false;
            }
             if (passac.length<3) {
             alert('Ingrese la Contraseña Actual Correctamente');return false;
            }
            if (pass.length<3) {
             alert('Ingrese la Contraseña Nueva Correctamente');return false;
            }
             if (pass2.length<3) {
             alert('Ingrese el Confirmar Contraseña Correctamente');return false;
            }
             if (pass!=pass2) {
             alert('No Coinciden las Contraseñas');return false;
            }

            var idcar = $('#kUI_combobox_select').val();
            if (idcar=='') {
             alert('Escoga el Tipo de usuario');return false;
            }

            $.post('negocio/usuario/updusuario.php',{
                    id_usuario : id_usuario,
                    passac : passac,
                    idper : idper,
                    usu : usu,
                    pass : pass,
                    idcar : idcar
             },
             function(data) {
                    if (data==1){
                            alert('El usuario se Actualizo Correctamente');
                            limpiar();
                    } else { alert('Error al registrar. ' + data); }
             });

        });
});


function limpiar() {
        $('#contenido').load('presentation/usuario/usuario.php');
}
</script>
