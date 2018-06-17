<?php
  session_start();
    $fecha_antigua = $_SESSION['UltimoIngreso'];
    $hora = date("Y-n-j H:i:s");
    $tiempo = (strtotime($hora) - strtotime($fecha_antigua));
      if($tiempo >= 60){
          session_destroy();
          echo "<script> alert('Su session ha sido caducada');
          self.location='index.php';  </script> ";
      }else{
          $_SESSION['UltimoIngreso']=$hora;
        }

    $usuarioID = 0;
    if (isset($_SESSION['Auth.UsuarioID'])) {
        $usuarioID = $_SESSION['Auth.UsuarioID'];
        $Nombres  = $_SESSION['eNombres'];
        $Apellido = $_SESSION['eApellido'];
        $Cargo = $_SESSION['eCargo'];
    } else {
        header('location:login.php');
        exit();
    }
    $page = '';
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }
?>


<html lang="es" dir="ltr">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

      <link rel="icon" type="image/png" href="site/img/icon_agua.png" sizes="16x16">

    <title> AcquaZen</title>
    <!-- uikit -->
    <link rel="stylesheet" href="site/plugins/uikit/css/uikit.almost-flat.min.css" media="all">

    <!-- flag icons -->
    <link rel="stylesheet" href="site/icons/flags/flags.min.css" media="all">

    <!-- style switcher -->
    <link rel="stylesheet" href="site/css/style_switcher.min.css" media="all">

    <!-- altair admin -->
    <link rel="stylesheet" href="site/css/main.min.css" media="all">

    <!-- themes -->
    <link rel="stylesheet" href="site/css/themes/themes_combined.min.css" media="all">

    <link rel="stylesheet" href="site/plugins/kendo-ui/styles/kendo.common-material.min.css"/>
    <link rel="stylesheet" href="site/plugins/kendo-ui/styles/kendo.material.min.css" id="kendoCSS"/>

    <!-- btn style -->
    <link rel="stylesheet" href="site/css/btn-style.css" media="all">
    <!-- btn style -->
    <link rel="stylesheet" href="site/css/title-style.css" media="all">
    <link href="site/plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">

    <style>

	.seleccionada{
		background-color: #0585C0;
		color: white;
	}
</style>
    </head>
<body class=" sidebar_main_open sidebar_main_swipe">
    <!-- main header -->
    <header id="header_main">
        <div class="header_main_content">
            <nav class="uk-navbar">

                <!-- main sidebar switch -->
                <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                    <span class="sSwitchIcon"></span>
                </a>

                <!-- secondary sidebar switch -->
                <a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check">
                    <span class="sSwitchIcon"></span>
                </a>



                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav user_actions">

                        <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                            <a href="#" class="user_action_image">
                                <span class="hidden-xs"> <?php echo $Nombres ?> </span> &nbsp
                                <img class="md-user-image" src="site/img/avatars/user-512.png" alt=""/>
                                 <span class="hidden-xs" title="<?php echo $Nombres ?>">Salir</span>
                            </a>
                            <div class="uk-dropdown uk-dropdown-small">
                                <ul class="uk-nav js-uk-prevent">


                                    <li><a id="btnCerrar" name="btnCerrar">Cerrar Sessión</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="header_main_search_form">
            <i class="md-icon header_main_search_close material-icons">&#xE5CD;</i>
            <form class="uk-form uk-autocomplete" data-uk-autocomplete="{source:'data/search_data.json'}">
                <input type="text" class="header_main_search_input" />
                <button class="header_main_search_btn uk-button-link"><i class="md-icon material-icons">&#xE8B6;</i></button>
                <script type="text/autocomplete">
                    <ul class="uk-nav uk-nav-autocomplete uk-autocomplete-results">
                        {{~items}}
                        <li data-value="{{ $item.value }}">
                            <a href="{{ $item.url }}">
                                {{ $item.value }}<br>
                                <span class="uk-text-muted uk-text-small">{{{ $item.text }}}</span>
                            </a>
                        </li>
                        {{/items}}
                    </ul>
                </script>
            </form>
        </div>
    </header><!-- main header end -->
    <!-- main sidebar -->
    <aside id="sidebar_main">

        <div class="sidebar_main_header"><div style="height: 6px"></div>
            <div class="sidebar_logo">
                <a href="index.php" class="sSidebar_hide sidebar_logo_large">
                </a>
                <a href="index.html" class="sSidebar_show sidebar_logo_small">
                    <img class="logo_regular" src="site/img/logo_main_small.png" alt="" height="32" width="32"/>
                    <img class="logo_light" src="site/img/logo_main_small_light.png" alt="" height="32" width="32"/>
                </a>
            </div><div style="height: 5px"></div>
            <div class="sidebar_actions">
                 <h5 class="uk-text-muted"></h5>
            </div>
        </div>
        <?php //if ($Cargo=='ADMINISTRADOR') {?>
             <div class="menu_section">
            <ul>
                <li title="Inicio">
                    <a href="index.php">
                        <span class="menu_icon"><i class="material-icons">&#xE871;</i></span>
                        <span class="menu_title">Inicio</span>
                    </a>
                </li>
                <li title="Forms">
                   <a href="#">
                       <span class="menu_icon"><i class="material-icons">person_pin</i></span>
                       <span class="menu_title">Usuarios</span>
                   </a>
                   <ul>
                        <li  class=""><a href="#Registrar Cargo" onclick ="load_div('contenido', 'presentation/cargo/cargoReg.php')"> Cargo</a></li>
                        <li  class=""><a href="#Registrar Usuario" onclick ="load_div('contenido', 'presentation/usuario/usuarioReg.php')"> Usuario</a></li>                           </ul>

               </li>

    </aside><!-- main sidebar end -->

<div id="page_content">
    <div id="page_content_inner">

        <br> <br>


        <div class="md-card" id="contenido">
            <center>
                <div>
                    <h1 style="font-family: 'Trebuchet MS'; color: #0000C0; font-weight: bold">
                       ¡ Bienvenido <?php echo $Nombres?> -  <?php echo $Cargo?> !
                    </h1>
                    <hr style="position: relative; bottom: 10px; width: 20%; color: #0000C0; border: 2px solid  #0000C0;"></div>
                </div>
            </center>

        </div>

    </div>

<div  class="uk-modal "   id="NombredelModal" >
        <div class="uk-modal-dialog uk-modal-dialog-large " >
            <button type="button" class="uk-modal-close uk-close"></button>

            <center>
                <div  id="modal_body" class="modal-body"></div>
            </center>

            <div class="uk-modal-footer uk-text-right ">
                <button type="button" class="uk-button uk-modal-close">Cancel</button>

             </div>
        </div>
    </div>

    <!-- google web fonts -->
    <script>
        WebFontConfig = {
            google: {
                families: [
                    'Source+Code+Pro:400,700:latin',
                    'Roboto:400,300,500,700,400italic:latin'
                ]
            }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>

    <!-- common functions -->
    <script src="site/js/common.min.js"></script>
    <!-- uikit functions -->
    <script src="site/js/uikit_custom.min.js"></script>
    <!-- altair common functions/helpers -->
    <script src="site/js/altair_admin_common.min.js"></script>
    <!-- AJAX Funciones-->
    <script src="site/js/ajax_funciones.js" type="text/javascript"></script>
    <script src="site/js/validation.js" type="text/javascript"></script>


    <!-- DataTables -->
    <script src="site/plugins/datatables/media/js/jquery.dataTables.js"></script>
    <script src="site/plugins/datatables/media/js/dataTables.bootstrap.js"></script>

  <!-- page specific plugins -->

<!--      page specific plugins
     DataTables
    <script src="site/plugins/datatables/media/js/jquery.dataTables.min.js"></script>

     datatables custom integration
    <script src="site/js/custom/datatables/datatables.uikit.min.js"></script>

      datatables functions
    <script src="site/js/pages/plugins_datatables.min.js"></script>-->

    <script>
        $(function() {
            if(isHighDensity()) {
                $.getScript( "site/plugins/dense/src/dense.js", function() {
                    // enable hires images
                    altair_helpers.retina_images();
                });
            }
            if(Modernizr.touch) {
                // fastClick (touch devices)
                FastClick.attach(document.body);
            }
        });
        $window.load(function() {
            // ie fixes
            altair_helpers.ie_fix();
        });
    </script>











    <script>
        $(function() {
            var $switcher = $('#style_switcher'),
                $switcher_toggle = $('#style_switcher_toggle'),
                $theme_switcher = $('#theme_switcher'),
                $mini_sidebar_toggle = $('#style_sidebar_mini'),
                $slim_sidebar_toggle = $('#style_sidebar_slim'),
                $boxed_layout_toggle = $('#style_layout_boxed'),
                $accordion_mode_toggle = $('#accordion_mode_main_menu'),
                $html = $('html'),
                $body = $('body');


            $switcher_toggle.click(function(e) {
                e.preventDefault();
                $switcher.toggleClass('switcher_active');
            });

            $theme_switcher.children('li').click(function(e) {
                e.preventDefault();
                var $this = $(this),
                    this_theme = $this.attr('data-app-theme');

                $theme_switcher.children('li').removeClass('active_theme');
                $(this).addClass('active_theme');
                $html
                    .removeClass('app_theme_a app_theme_b app_theme_c app_theme_d app_theme_e app_theme_f app_theme_g app_theme_h app_theme_i app_theme_dark')
                    .addClass(this_theme);

                if(this_theme == '') {
                    localStorage.removeItem('altair_theme');
                    $('#kendoCSS').attr('href','site/plugins/kendo-ui/styles/kendo.material.min.css');
                } else {
                    localStorage.setItem("altair_theme", this_theme);
                    if(this_theme == 'app_theme_dark') {
                        $('#kendoCSS').attr('href','site/plugins/kendo-ui/styles/kendo.materialblack.min.css')
                    } else {
                        $('#kendoCSS').attr('href','site/plugins/kendo-ui/styles/kendo.material.min.css');
                    }
                }

            });

            // hide style switcher
            $document.on('click keyup', function(e) {
                if( $switcher.hasClass('switcher_active') ) {
                    if (
                        ( !$(e.target).closest($switcher).length )
                        || ( e.keyCode == 27 )
                    ) {
                        $switcher.removeClass('switcher_active');
                    }
                }
            });

            // get theme from local storage
            if(localStorage.getItem("altair_theme") !== null) {
                $theme_switcher.children('li[data-app-theme='+localStorage.getItem("altair_theme")+']').click();
            }


        // toggle mini sidebar

            // change input's state to checked if mini sidebar is active
            if((localStorage.getItem("altair_sidebar_mini") !== null && localStorage.getItem("altair_sidebar_mini") == '1') || $body.hasClass('sidebar_mini')) {
                $mini_sidebar_toggle.iCheck('check');
            }

            $mini_sidebar_toggle
                .on('ifChecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.setItem("altair_sidebar_mini", '1');
                    localStorage.removeItem('altair_sidebar_slim');
                    location.reload(true);
                })
                .on('ifUnchecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.removeItem('altair_sidebar_mini');
                    location.reload(true);
                });

        // toggle slim sidebar

            // change input's state to checked if mini sidebar is active
            if((localStorage.getItem("altair_sidebar_slim") !== null && localStorage.getItem("altair_sidebar_slim") == '1') || $body.hasClass('sidebar_slim')) {
                $slim_sidebar_toggle.iCheck('check');
            }

            $slim_sidebar_toggle
                .on('ifChecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.setItem("altair_sidebar_slim", '1');
                    localStorage.removeItem('altair_sidebar_mini');
                    location.reload(true);
                })
                .on('ifUnchecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.removeItem('altair_sidebar_slim');
                    location.reload(true);
                });

        // toggle boxed layout

            if((localStorage.getItem("altair_layout") !== null && localStorage.getItem("altair_layout") == 'boxed') || $body.hasClass('boxed_layout')) {
                $boxed_layout_toggle.iCheck('check');
                $body.addClass('boxed_layout');
                $(window).resize();
            }

            $boxed_layout_toggle
                .on('ifChecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.setItem("altair_layout", 'boxed');
                    location.reload(true);
                })
                .on('ifUnchecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.removeItem('altair_layout');
                    location.reload(true);
                });

        // main menu accordion mode
            if($sidebar_main.hasClass('accordion_mode')) {
                $accordion_mode_toggle.iCheck('check');
            }

            $accordion_mode_toggle
                .on('ifChecked', function(){
                    $sidebar_main.addClass('accordion_mode');
                })
                .on('ifUnchecked', function(){
                    $sidebar_main.removeClass('accordion_mode');
                });


        });
    </script>

    <script>
           var espacio_blanco    = /[a-z]/i;
              var espacio_blanco2    = /[0-9]/i;
        $(document).ready(function(e) {

            $('#btnCerrar').click(function () {
                $.post('presentation/usuario/proceso/cerrarsesion.php', {},
                        function (data) {
                            alert('Tu session fue cerrada satisfactoriamente');
                            window.location = "login.php";
                        });
            });

    });


    </script>
</body>
</html>
