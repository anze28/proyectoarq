// Clase abstracta ValidacionStrategy
class ValidacionStrategy {
	constructor(pattern) {
	  this.pattern = pattern;
	}
  
	validar(valor) {
	  throw new Error("Método 'validar' no implementado");
	}
  }
  
  // Clase concreta NombreValidacion
  class NombreValidacion extends ValidacionStrategy {
	constructor() {
	  super(" abcdefghijklmnñopqrstuvwxyzáéíóú0123456789/-*,.°()$#");
	}
  
	validar(valor) {
	  if (!this.pattern.test(valor)) {
		throw new Error("El valor ingresado no es válido");
	  }
	}
  }
  
  // Clase concreta DescripcionValidacion
  class DescripcionValidacion extends ValidacionStrategy {
	constructor() {
	  super(" abcdefghijklmnñopqrstuvwxyzáéíóú0123456789/-*,.°()$#");
	}
  
	validar(valor) {
	  if (!this.pattern.test(valor)) {
		throw new Error("El valor ingresado no es válido");
	  }
	}
  }
  
  // Función init que utiliza el patrón de diseño Strategy para validar los campos
  function init() {
	const nombreValidacion = new NombreValidacion();
	const descripcionValidacion = new DescripcionValidacion();
  
	// Validación del campo nombre
	$("#nombre").on("input", function () {
	  const valor = $(this).val();
	  try {
		nombreValidacion.validar(valor);
		$(this).removeClass("is-invalid");
		$(this).addClass("is-valid");
	  } catch (error) {
		$(this).removeClass("is-valid");
		$(this).addClass("is-invalid");
	  }
	});
  
	// Validación del campo descripción
	$("#descripcion").on("input", function () {
	  const valor = $(this).val();
	  try {
		descripcionValidacion.validar(valor);
		$(this).removeClass("is-invalid");
		$(this).addClass("is-valid");
	  } catch (error) {
		$(this).removeClass("is-valid");
		$(this).addClass("is-invalid");
	  }
	});
  
  }
  
  var tabla;
  var nNotificaciones=3;

function init(){
    //Para validación
	$('#nombre').validacion(' abcdefghijklmnñopqrstuvwxyzáéíóú0123456789/-*,.°()$#');
    $('#descripcion').validacion(' abcdefghijklmnñopqrstuvwxyzáéíóú0123456789/-*,.°()$#');
    $('#articulo').select2();

	mostrarform(false);
    listar();
    $("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});
    $("#imagenmuestra").hide();
    $.post("../ajax/categoria.php?op=5", function(r){
	    $("#categoria").html(r);
		$('#categoria').trigger('change.select2');
	});
}

// muestra la notificacion al guardar
function notificacionCrear(Tipomensaje)
{	
	nNotificaciones++;
	document.getElementById("nNotificaciones").innerHTML = nNotificaciones;	

	var divElemento = document.getElementById('nuevaNotificacion');	
	divElemento.insertAdjacentHTML
	(
	'beforebegin', 
	'<div class="d-flex"> <div class="flex-shrink-0 me-3"><img src="../public/images/users/avatar-1.jpg" class="rounded-circle avatar-sm" alt="user-pic" </div><div class="flex-grow-1"> <h6 class="mb-1">Grupo 4</h6> <div class="font-size-13 text-muted"> <p id="notificacion" class="mb-1"> El articulo fue registrado</p><p class="mb-0"><i class="mdi mdi-clock-outline">1 minute ago</i> </p></div></div> </div>'
	);

	document.getElementById("notificacion").innerHTML = Tipomensaje;
}

// muestra la notificacion al guardar

function notificacionActivarDesactivar(Tipomensaje)
{	
	nNotificaciones++;
	document.getElementById("nNotificaciones").innerHTML = nNotificaciones;	

	var divElemento = document.getElementById('nuevaNotificacion');	
	divElemento.insertAdjacentHTML
	(
	'beforebegin', 
	'<div class="d-flex"> <div class="flex-shrink-0 me-3"><img src="../public/images/users/avatar-1.jpg" class="rounded-circle avatar-sm" alt="user-pic" </div><div class="flex-grow-1"> <h6 class="mb-1">Grupo 4</h6> <div class="font-size-13 text-muted"> <p id="notificacion" class="mb-1"> El articulo fue desactivado</p><p class="mb-0"><i class="mdi mdi-clock-outline">1 minute ago</i> </p></div></div> </div>'
	);

	document.getElementById("notificacion").innerHTML = Tipomensaje;
}

//Función limpiar
function limpiar()
{
	$("#nombre").val("");
    $("#descripcion").val("");
    $("#stock").val("0");
    $("#codigo").val("0");
	$("#idarticulo").val("");
    $("#imagenmuestra").attr("src","");
    $.post("../ajax/categoria.php?op=5", function(r){
	    $("#categoria").html(r);
		$('#categoria').trigger('change.select2');
	});
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
                        url: '../ajax/articulo.php?op=0',
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

//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/articulo.php?op=1",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {    
			mensaje=datos.split(":");
			if(mensaje[0]=="1"){               
			swal.fire(
				'Mensaje de Confirmación',
				mensaje[1],
				'success'

				);           
	          mostrarform(false);
	          tabla.ajax.reload();
			  notificacionCrear(mensaje[1]);
			}
			else{
				Swal.fire({
					type: 'error',
					title: 'Error',
					text: mensaje[1],
					footer: 'Verifique la información de Registro, en especial que la información no fué ingresada previamente a la Base de Datos.'
				});
			}
	    }

	});
	limpiar();
}

function mostrar(idarticulo)
{
	$.post("../ajax/articulo.php?op=4",{idarticulo : idarticulo}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#nombre").val(data.articulonombre);
        $("#descripcion").val(data.articulodescripcion);
        $("#stock").val(data.articulostock);
        $("#codigo").val(data.articulocodigo);
        $.post("../ajax/categoria.php?op=5", function(r){
            $("#categoria").html(r);
            $('select[name=categoria]').val(data.idcategoria);
            $('#categoria').trigger('change.select2');
        });

        $("#imagenmuestra").show();
		$("#imagenmuestra").attr("src","../file/articulos/"+data.articuloimagen);
		$("#imagenactual").val(data.articuloimagen);

 		$("#idarticulo").val(data.idarticulo);
 	});
}

//Función para desactivar registros
function desactivar(idarticulo)
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
			$.post("../ajax/articulo.php?op=2", {idarticulo : idarticulo}, function(e){
				mensaje=e.split(":");
					if(mensaje[0]=="1"){  
						swal.fire(
							'Mensaje de Confirmación',
							mensaje[1],
							'success'
						);  
						tabla.ajax.reload();
						notificacionActivarDesactivar(mensaje[1]);
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

//Función para activar registros
function activar(idarticulo)
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
			$.post("../ajax/articulo.php?op=3", {idarticulo : idarticulo}, function(e){
				mensaje=e.split(":");
					if(mensaje[0]=="1"){  
						swal.fire(
							'Mensaje de Confirmación',
							mensaje[1],
							'success'
						);  
						tabla.ajax.reload();
						notificacionActivarDesactivar(mensaje[1]);
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

//función para generar el código de barras
function generarbarcode()
{
	codigo=$("#codigo").val();
	JsBarcode("#barcode", codigo);
	$("#print").show();
}

//Función para imprimir el Código de barras
function imprimir()
{
	$("#print").printArea();
}

init();