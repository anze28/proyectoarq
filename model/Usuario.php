<?php 

/**En este ejemplo, se puede ver cómo el objeto User tiene responsabilidades bien definidas y cohesivas, siguiendo los patrones GRASP de Expert y Low Coupling. El objeto User es experto en la información personal de un usuario, y tiene métodos para permitir que un usuario inicie sesión, verifique su información y acceda a las funcionalidades disponibles, así como para permitir que un usuario edite su información personal. Además, el objeto User tiene bajo acoplamiento, ya que no depende de otros objetos para llevar a cabo sus responsabilidades. */
//Incluímos inicialmente la conexión a la base de datos
require_once "../config/Conexion.php";
require_once "../public/PHPMailer/src/PHPMailer.php";
require_once "../public/PHPMailer/src/SMTP.php";
require_once "../public/PHPMailer/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

Class usuario
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM persona p, usuario r WHERE p.idpersona=r.idpersona";
		return ejecutarConsulta($sql);		
	}

	//Implementamos un método para insertar registros
	public function insertar($nombre, $apellidop, $apellidom, $tipo_documento,$num_documento,$direccion,$email, $imagen, $usuariox, $clavehash, $rol)
	{
		$validacion=$this->comprueba_duplicados($num_documento,0);
		if($validacion==0){

            $sql="INSERT INTO persona (personanombre, personaap, personaam, personatipo_documento, personanum_documento, personadireccion, personaemail, personaimagen)
		    VALUES ('$nombre','$apellidop','$apellidom','$tipo_documento','$num_documento', '$direccion', '$email', '$imagen') RETURNING idpersona;";
            $idpersona = ejecutarConsulta_retornarID($sql);
            $sqlx="INSERT INTO usuario(usuarionombre, usuarioclave, usuariointentos, usuariocondicion, idrol, idpersona)
                VALUES ('$usuariox', '$clavehash', '0', '1', '$rol', '$idpersona') RETURNING idusuario";
			return ejecutarConsulta($sqlx);

		}
		else{return 0;}
	}

	//Implementamos un método para editar registros
	public function editar($idusuario,$nombre, $apellidop, $apellidom, $tipo_documento,$num_documento,$direccion,$email, $imagen, $usuariox, $clavehash, $rol)
	{
		$validacion=$this->comprueba_duplicados($num_documento,$idusuario);
		if($validacion==0){
            
            $idpersona=$this->idpersona_usuario($idusuario);
            $sql="UPDATE persona SET personanombre='$nombre', personaap='$apellidop', personaam='$apellidom',personatipo_documento='$tipo_documento',personanum_documento='$num_documento',personadireccion='$direccion',personaemail='$email',personaimagen='$imagen' WHERE idpersona='$idpersona'";
			ejecutarConsulta($sql);

            $sqlx="UPDATE usuario SET usuarionombre='$usuariox', usuarioclave='$clavehash', idrol='$rol'
            WHERE idusuario = '$idusuario'";
			return ejecutarConsulta($sqlx);

        }
		else{return 0;}
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idusuario)
	{
		$sql="UPDATE usuario SET usuariocondicion='0' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idusuario)
	{
		$sql="UPDATE usuario SET usuariocondicion='1' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idusuario)
	{
		$sql="SELECT * FROM persona p, usuario r WHERE p.idpersona=r.idpersona AND (r.idusuario='$idusuario')";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function select()
	{
		$sql="SELECT idusuario, usuarionombre FROM usuario 
		WHERE (usuariocondicion=1) ORDER BY usuarionombre ASC";
		return ejecutarConsulta($sql);		
	}

    //Implementar un método para mostrar los datos de un registro a modificar
	public function idpersona_usuario($idusuario)
	{
		$sql="SELECT p.idpersona FROM persona p, usuario c WHERE p.idpersona=c.idpersona AND c.idusuario='$idusuario'";
		$idpersona = ejecutarConsultaSimpleFila($sql);
		return $idpersona["idpersona"];
	}

	//Implementar un método para listar los registros
	public function comprueba_duplicados($nombre,$id)
	{
		$resultado=0;
		$sql="SELECT COUNT(p.idpersona) AS idpersona FROM persona p, usuario u WHERE (p.personanum_documento='$nombre')AND(u.idpersona=p.idpersona) AND (u.idusuario<>$id)";
		$resultado = ejecutarConsultaSimpleFila($sql);
		return $resultado['idpersona'];		
	}

	//Función para verificar el acceso al sistema
	public function verificar($login,$clave)
    {
    	$sql="SELECT p.personaemail, p.personanombre, p.personaap, p.personanum_documento, p.personaimagen, u.idusuario, u.usuariocondicion, u.usuarionombre, u.usuarioclave, 
		r.idrol, r.rolnombre FROM persona p, usuario u, rol r WHERE p.idpersona=u.idpersona AND u.idrol=r.idrol AND 
		u.usuarionombre='$login' AND usuarioclave='$clave' AND u.usuariocondicion='1'"; 
    	return ejecutarConsulta($sql);  
    }

	//Implementar un método para listar los permisos marcados
	public function listarmarcados($idusuario)
	{
		$sql="SELECT p.idpermiso FROM usuario u, rol r, rol_permiso p WHERE u.idrol=r.idrol AND r.idrol=p.idrol AND u.idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar_intentos($idusuario,$intentos)
	{
		$sql="UPDATE usuario SET usuariointentos='$intentos' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}
	//Función para verificar el acceso al sistema
	public function verificar_intentos($login)
    {
		$sql="SELECT idusuario, usuariointentos FROM usuario WHERE usuarionombre='$login'";
		$resultado = ejecutarConsulta($sql); 
		while ($reg = pg_fetch_assoc($resultado)){
			$idusuario=$reg["idusuario"];
			$num_intentos=(int)$reg["usuariointentos"]+1;
			if($num_intentos>=5){
				$respuesta=$this->editar_intentos($idusuario,$num_intentos);
				$respuesta=$this->desactivar($idusuario);
			}
			else{$respuesta=$this->editar_intentos($idusuario,$num_intentos);}
		}
	}
	//verifica el email, si este existe para permitir el reseteo de contraseña
	/*
	Identificamos los objetos principales involucrados en el proceso: en este caso, podríamos identificar los siguientes objetos:
	User: el objeto que representa un usuario, con su información (nombre, correo electrónico, etc.) y sus métodos (buscar correo electrónico, etc.).
	Database: el objeto que se encarga de interactuar con la base de datos, a través de consultas SQL, y devolver los resultados.
	
	Asignamos responsabilidades a cada objeto: en este paso, podemos aplicar algunos patrones GRASP específicos para asignar responsabilidades de manera efectiva. Por ejemplo:
	Expert: el objeto User es el experto en la información necesaria para buscar el correo electrónico de un usuario en la base de datos, por lo que es responsable de invocar al objeto Database para realizar la consulta SQL correspondiente.
	Creator: el objeto Database es responsable de crear la conexión a la base de datos y ejecutar la consulta SQL.
	Controller: podría haber un objeto Controller que se encargue de coordinar todo el proceso de verificación de correo electrónico, y que interactúe con los objetos User y Database para lograr esto.
	
	Implementamos la solución en código: a continuación, podríamos implementar los objetos y sus responsabilidades de la siguiente manera (simplificando un poco el código para fines de claridad):
	*/

	public function verificar_email($email){
		$mensaje = 0;
		$resultadox = Array();
		$sql="SELECT idusuario, usuarionombre FROM usuario u, persona p WHERE (p.idpersona=u.idpersona)AND(p.personaemail = '$email')";
		$resultado = ejecutarConsulta($sql);
		while ($fetch= pg_fetch_assoc($resultado)){
			array_push($resultadox,$fetch["idusuario"],$fetch["usuarionombre"]);
		}
		return $resultadox;
	}
	//Generamos un link temporal para el reseteo de contraseñas, lo guardamos en la tabla reseteopass
	public function generar_link_temporal($email, $idusuario, $username){
		$cadena = $idusuario.$username.rand(1,9999999).date('Y-m-d');		
		require_once "../ajax/seguridad.php";
		$seguridad=new seguridad();
		$token=$seguridad->stringEncryption('encrypt', $cadena);
		$idusuarios=$seguridad->stringEncryption('encrypt', $idusuario);
		$enlace = 'http://'.$_SERVER["SERVER_NAME"].'/proyectoucb/view/restablecer.php?idusuario='.$idusuarios.'&token='.$token;
		$sql="INSERT INTO reseteopass (idusuario, reseteopasstoken, reseteopasscreado) VALUES($idusuario,'$token',NOW());";
		$r=ejecutarConsulta($sql);
		$resultado=$this->enviar_email($email, $enlace);
		return 1;
	}

	//Implementar un método para listar los permisos marcados
	public function verifciar_por_token($token, $idusuario)
	{
		$sql="SELECT idusuario FROM reseteopass WHERE (reseteopasstoken = '$token')AND(idusuario='$idusuario')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para resetear la contraseña a través del sistema
	public function editar_clave($idusuario, $clave)
	{
		$sqlx="UPDATE usuario SET usuarioclave='$clave' WHERE idusuario='$idusuario'";
		$rspta=ejecutarConsulta($sqlx);
		$sqld="DELETE FROM reseteopass WHERE idusuario='$idusuario'";
		ejecutarConsulta($sqld);
		$activa=$this->activar($idusuario);
		return $idusuario;
	}

	public function enviar_email($email, $link){
		

		// Crear un nuevo objeto PHPMailer
		$mail = new PHPMailer(true);

		try {
			// Configurar el servidor SMTP y el puerto de Gmail
			$mail->SMTPDebug = SMTP::DEBUG_OFF;
			$mail->isSMTP();
			$mail->Host = 'smtp-relay.sendinblue.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'pedro.anze@ucb.edu.bo';
			$mail->Password = 'vzZbkFAWECBqKL2V';
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Port = 587;                                    
			//Email de origen y de destino
			$mail->setFrom('pedro.anze@ucb.edu.bo', 'UCB Sistema');
			$mail->addAddress($email, 'Usuario');     // Add a recipient
			// Contenido
			$mail->isHTML(true);                                  // Set email format to HTML
			$subject = "Reseteo de Clave";
			$subject = utf8_decode($subject);
			$mail->Subject = $subject;
			$mail->Body    ='<!DOCTYPE html>
			<html>
			<head>
				<meta charset="utf-8">			
				<title>Contraseñas</title>
			
				<style>
					.center {
					margin: auto;
					text-align: center;
					width: 50%;
					border: 1px solid #F5B041;
					padding: 10px;
					}
					
					.button {
					background-color: #5676b0;
					border: none;
					color: white;
					padding: 10px 15px;
					text-align: center;
					text-decoration: none;
					display: inline-block;
					font-size: 16px;
					margin: 4px 2px;
					cursor: pointer;
					}
				</style>
			</head>
			
			<body>
				<div class="center">			
					<center><img src="https://tja.ucb.edu.bo/wp-content/uploads/2021/11/logo-color-blanco-light-1.png" alt="Universidad Católica Boliviana" style="width:500px;height:130px;"></center>
					<p><b>¡Importante! </b>Hemos recibido una solicitud para la recuperación de contraseñas de su cuenta, si usted no hubiera realizado esta solicitud, 
					no debe ingresar al link que proporcionamos en este mensaje, e informar al administrador de sistemas sobre actividad sospechosa con su información.</p>
					<p>Por tanto, si desea recuperar o cambiar su contraseña, ingrese al link que se proporciona a continuación, y modifique su contraseña.</p>
					<a href="'.$link.'" > <button class="button">Reestablecer Contraseña</button> </a>
				</div>
			</body>
			</html>';
			$mail->CharSet = 'UTF-8';
			$mail->send();
			echo 'Mensaje enviado';
		} catch (Exception $e) {
			echo "Mensaje no enviado: {$mail->ErrorInfo}";
		}
	}

}

?>