<?php
	session_start();
	session_destroy();
        echo "<script> alert('Cerraste Sesion Satisfactoriamente');   
            self.location='../../../index.php';  </script> ";
?>