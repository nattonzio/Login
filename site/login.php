<!doctype html>
  <!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="site/img/icon_agua.png" sizes="16x16">

    <title>Login | AcquaZen</title>

    <link rel="stylesheet" href="site/fonts/fonts.css"/>

    <!-- uikit -->
    <link rel="stylesheet" href="site/plugins/uikit/css/uikit.almost-flat.min.css"/>

    <!-- altair admin login page -->
    <link rel="stylesheet" href="site/css/login_page.min.css" />

</head>
<body class="login_page">


    <div class=" hierarchical_show" >
      <div class="login_page_wrapper" >
        <div class="md-card md-card-primary" id="login_card"style="border-radius: 10px " >
            <div class="md-card-content large-padding" id="login_form" style="border-radius: 10px ">
              <h3 align="center">Inicio de Sesión</h3>
                <form>
                    <div class="uk-form-row">
                        <div class="uk-input-group">
                            <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-user"></i></span>
                            <label for="login_username">Usuario</label>
                            <input class="md-input" type="text" id="txtUsuario" name="txtUsuario" />
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <div class="uk-input-group">
                            <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-lock"></i></span>
                            <label for="login_password">Contraseña</label>
                            <input class="md-input" type="password" id="txtContrasena" name="txtContrasena" />
                        </div>
                    </div>
                    <div class="uk-margin-medium-top">
                        <button type="button"  class="md-btn md-btn-primary md-btn-block md-btn-large " id="btnLogear" name="btnLogear">Acceder</button>
                    </div>


                </form>
            </div>



        </div>
<!--        <div class="uk-margin-top uk-text-center">
            <a href="#" id="signup_form_show">Crear cuenta</a>
        </div>-->
    </div>
            </div>



    <script src="site/js/jquery/jquery.js" type="text/javascript"></script>
    <!-- common functions -->
    <script src="site/js/common.min.js"></script>
    <!-- uikit functions -->
    <script src="site/js/uikit_custom.min.js"></script>
    <!-- altair core functions -->
    <script src="site/js/altair_admin_common.min.js"></script>

    <!-- altair login page functions -->
    <script src="site/js/pages/login.min.js"></script>

    <script>
        // check for theme
        if (typeof(Storage) !== "undefined") {
            var root = document.getElementsByTagName( 'html' )[0],
                theme = localStorage.getItem("altair_theme");
            if(theme == 'app_theme_dark' || root.classList.contains('app_theme_dark')) {
                root.className += ' app_theme_dark';
            }
        }
    </script>

 <!-- Acesso a Login Js -->
        <script>
            $(document).ready(function () {
                $('#txtContrasena').keyup(function (e) {
                    if (e.which == 13) {
                       logear();
                    }
                });

                $('#btnLogear').click(function () {
                   logear();
                });
            });
            function logear(){
                var Nombre = $('#txtUsuario').val();
                var Contrasena = $('#txtContrasena').val();
                if(Nombre.length<3 || Nombre==''){
                    alert('ERROR - EL USUARIO DEBE TENER MAS DE 3 DIGITOS');
                    return false;
                }
                if(Contrasena.length<3 || Contrasena==''){
                    alert('ERROR - LA CONTRASEÑA DEBE TENER MAS DE 3 DIGITOS');
                    return false;
                }
                $.post('negocio/login/logear.php', {
                    Nombre: Nombre,
                    Contrasena: Contrasena
                },
                function (data) {
                    if (data == 'ok') {
                        alert('Bienvenido');
                        window.location = "index.php";
                    } else {
                        alert(data);
                    }
                });
            }
        </script>
</body>
</html>
