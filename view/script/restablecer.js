//Función que se ejecuta al inicio
function init(){
	token = $("#token").val();
    idusuario = $("#idusuario").val();

    $("#frmRestablecer").on("submit",function(e)
	{
        guardaryeditar(e);	
	});

    $.post("../ajax/usuario.php?op=9", {"idusuariox":idusuario, "token":token},
    function(data){
        if(data>0){
            $("#clave").prop('disabled', false);
            $("#clave1").prop('disabled', false);
            $("#submit").hide();
            $("#idusuario").val(data);
        }
        else{
            $("#clave").prop('disabled', true);
            $("#clave1").prop('disabled', true);
            $("#submit").hide();
            swal.fire({
                type: 'error',
                title: 'respuesta',
                text: 'Se venció la sesión para recuperación.'
            });
        }
    });

}

$("#clave").keyup(function(){
    clave=$("#clave").val();
    clave1=$("#clave1").val();
    if(clave==clave1){
        $("#submit").show();
    }
    else{
        $("#submit").hide();
    }
});

$("#clave1").keyup(function(){
    clave=$("#clave").val();
    clave1=$("#clave1").val();
    if(clave==clave1){
        $("#submit").show();
    }
    else{
        $("#submit").hide();
    }
});

window.addEventListener('load', function() {
    init();
});

//Función verificar correo
function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#submit").prop("disabled",true);
	var formData = new FormData($("#frmRestablecer")[0]);

	$.ajax({
		url: "../ajax/usuario.php?op=10",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {    
			mensaje=datos.split(":");
			if(mensaje[0]=="1"){               
				Swal.fire({
					type: 'error',
					title: 'Error',
					text: mensaje[1],
					footer: 'Verifique la información de Registro, en especial que la información no fué ingresada previamente a la Base de Datos.'
				});
                    
			}
			else{


                let timerInterval
                Swal.fire({
                title: 'Mensaje de Confirmación',
                html: mensaje[1]+'<br>El mensaje se cerrará y direccionará al ingreso del sistema en <b></b> milisegundos.',
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
                }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                      $(location).attr("href","login.php");   
                }
                })
			}
	    }

	});
}
