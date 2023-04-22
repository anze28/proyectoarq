//modificacion del login.js e implementacion del patron de diseño en states

$(document).ready(function() {
    // Definimos el estado inicial
    let estado = {
      logueado: false,
      mensaje: ""
    };
  
    // Manejamos el envío del formulario de inicio de sesión
    $("#frmAcceso").on("submit", function(e) {
      e.preventDefault();
      logina = $("#logina").val();
      clavea = $("#clavea").val();
  
      $.post(
        "../ajax/usuario.php?op=5",
        { logina: logina, clavea: clavea },
        function(data) {
          if (data != 0) {
            // Actualizamos el estado en caso de inicio de sesión exitoso
            estado.logueado = true;
            estado.mensaje = "";
  
            // Redirigimos al usuario al escritorio
            $(location).attr("href", "escritorio.php");
          } else {
            // Actualizamos el estado en caso de inicio de sesión fallido
            estado.logueado = false;
            estado.mensaje =
              "Usuario y/o Password incorrectos. Cualquier información consulte con el administrador.";
  
            // Mostramos un mensaje de error al usuario utilizando SweetAlert2
            Swal.fire({
              type: "error",
              title: "Error",
              text: estado.mensaje
            });
          }
  
          console.log(estado);
        }
      );
    });
  });
  