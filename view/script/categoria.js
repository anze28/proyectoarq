var tabla;

function init(){
    //Para validación
	$('#nombre').validacion(' abcdefghijklmnñopqrstuvwxyzáéíóú0123456789/-*,.°()$#');
	mostrarform(false);
    listar();
    $("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});
}

//Función limpiar
function limpiar()
{
	$("#nombre").val("");
	$("#idcategoria").val("");
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

function listar(){
    tabla=$('#tbllistado').DataTable(
        {
            "lengthMenu": [ 10, 25, 50, 75, 100 ],//mostramos el menú de registros a revisar
            "Processing": true,//Activamos el procesamiento del datatables
            "ServerSide": true,//Paginación y filtrado realizados por el servidor
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
            dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [		          
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdf'
                    ],
            "ajax":
                    {
                        url: '../ajax/categoria.php?op=0',
                        type : "get",
                        dataType : "json",						
                        error: function(e){
                            console.log(e.responseText);	
                        }
                    },
            "Destroy": true,
            "iDisplayLength": 10,//Paginación
            "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
        });
}

////En este punto se le manda una notificacion la cual comprueba la eliminacion o insersion de articulos

// Clase Observador para actualizar los elementos de la interfaz de usuario
class Observador {
	actualizar() {
	  // Implementar la lógica para actualizar los elementos de la interfaz de usuario
	}
  }
  
  function guardaryeditar(e) {
	e.preventDefault(); // No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled", true);
	var formData = new FormData($("#formulario")[0]);
  
	$.ajax({
	  url: "../ajax/categoria.php?op=1",
	  type: "POST",
	  data: formData,
	  contentType: false,
	  processData: false,
  
	  success: function(datos) {
		mensaje = datos.split(":");
		if (mensaje[0] == "1") {
		  swal.fire(
			"Mensaje de Confirmación",
			mensaje[1],
			"success"
		  );
  
		  // Notificar a los observadores registrados
		  notificarObservadores();
  
		  // Limpiar el formulario
		  limpiar();
		} else {
		  Swal.fire({
			type: "error",
			title: "Error",
			text: mensaje[1],
			footer:
			  "Verifique la información de Registro, en especial que la información no fue ingresada previamente a la Base de Datos."
		  });
  
		  // Habilitar el botón de guardar
		  $("#btnGuardar").prop("disabled", false);
		}
	  }
	});
  }
  
  // Lista de observadores registrados
  const observadores = [];
  
  // Método para registrar un observador
  function agregarObservador(observador) {
	observadores.push(observador);
  }
  
  // Método para notificar a todos los observadores registrados
  function notificarObservadores() {
	for (const observador of observadores) {
	  observador.actualizar();
	}
  }
  

function mostrar(idcategoria)
{
	$.post("../ajax/categoria.php?op=4",{idcategoria : idcategoria}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#nombre").val(data.categorianombre);
 		$("#idcategoria").val(data.idcategoria);
 	});
}

//todo cambio que sea realizado a nnuestro objeto observable debe ser notificado para poder aplicar el patron observer 

function desactivar(idcategoria)
{
	swal.fire({
		title: 'Mensaje de Confirmación',
		text: "¿Desea desactivar el Registro?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Desactivar'
	}).then((result) => {
		if (result.value) {
			$.post("../ajax/categoria.php?op=2", {idcategoria : idcategoria}, function(e){
				mensaje=e.split(":");
					if(mensaje[0]=="1"){  
						swal.fire(
							'Mensaje de Confirmación',
							mensaje[1],
							'success'
						);  
						tabla.ajax.reload();
					}	
					else{
						Swal.fire({
							type: 'error',
							title: 'Error',
							text: mensaje[1],
							footer: 'Verifique la información de Registro, en especial que la información no fué ingresada previamente a la Base de Datos.'
						});
					}			
        	});	
		}
	});   
}

//De igual manera aqui el cambio que se realiza debe ser notificado para cumplir con los parametros del patron observer
function activar(idcategoria)
{
	swal.fire({
		title: 'Mensaje de Confirmación',
		text: "¿Desea activar el Registro?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Activar'
	}).then((result) => {
		if (result.value) {
			$.post("../ajax/categoria.php?op=3", {idcategoria : idcategoria}, function(e){
				mensaje=e.split(":");
					if(mensaje[0]=="1"){  
						swal.fire(
							'Mensaje de Confirmación',
							mensaje[1],
							'success'
						);  
						tabla.ajax.reload();
					}	
					else{
						Swal.fire({
							type: 'error',
							title: 'Error',
							text: mensaje[1],
							footer: 'Verifique la información de Registro, en especial que la información no fué ingresada previamente a la Base de Datos.'
						});
					}			
        	});	
		}
	}); 
}

init();