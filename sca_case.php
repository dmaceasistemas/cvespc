<?php
/*Modulo de Case del Sistema SCA*/
include_once ("sca_sesiones.php");/*Archivo de Sesiones*/
error_reporting (0); /*Recordar Quitar Descomentar cuando se use el Sistema Futuro*/
include_once ("sca_fecha.php");/*Archivo de Fechas*/
//$ip_acceso_u=$_SERVER['REMOTE_ADDR'];/*Capta la IP de la Maquina Visitante*/
//include_once ("sca_conexion.php");
include_once ("sca_funciones.php");
$ip_acceso_u=ip_real();//IP real Saltando Proxy
$seleccion=$_REQUEST["seleccion"];
switch($seleccion)
	{	
	case 1:
		//Inclusion de Tipo de Visitantes 
		$url_origen=$_POST['url_origen'];
		$visitante_t=$_POST['visitante_t'];

		if ($visitante_t=="")
			{
			$mensaje=2;
			$dato="El campo tipo de Visitante no puede estar vacio";
			}
		else
			{
			$tabla="visitantes_t";
			$sql="insert into $tabla (tipo) values ('$visitante_t')"; 
			$error="incluir Tipo de Visitantes";
			sql($sql, $error);
	
			historial_autoid_i($sql, $tabla, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);	
			$mensaje=1;
			$dato="Tipo de Visitante Incluido";
			$url_origen="sca_visitante_t_c.php";
			}
		header("location: $url_origen?mensaje=$mensaje&dato=$dato");
	break;

	case 2:
		//Modificacion de Tipo de Visitantes 
		$url_origen=$_POST['url_origen'];
		$id_visitante_t=$_POST['id_visitante_t'];
	
		$tabla="visitantes_t";
		$where="where id_visitante_t='$id_visitante_t'";
		$id_registro=$id_visitante_t;
		$arreglo_campos_v = Array ('tipo');/*Nombre de los Campos en las Tabla Correspondiente de MYSQL*/
		$arreglo_variables_v= Array ('tipo'); /*Nombre de la Variables en el Formulario*/
		$error="actualizar Tipo de Visitantes";
	
		historial_m($tabla, $where, $id_registro, $arreglo_campos_v, $arreglo_variables_v, $error, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
		$mensaje=1;
		$dato="Tipo de Visitante Actualizado";
		header("location: $url_origen?mensaje=$mensaje&dato=$dato&id_visitante_t=$id_visitante_t");
	break;

	case 3:
		//Eliminación de Tipo de Visitantes 
		//$url_origen=$_POST['url_origen'];
		$id_visitante_t=$_REQUEST['id_visitante_t']; /*Recordar Cambiar el REQUEST*/
		
		if ($id_visitante_t=="")
			{
			$mensaje=2;
			$dato="Tipo de Visitante no se pudo Eliminar";
			}
		else
			{
			$id_registro=$id_visitante_t;
			$tabla="visitantes_t";
			$sql="delete from $tabla where id_visitante_t='$id_visitante_t'" ;
			$error="eliminar Tipo de Visitante";
			sql($sql, $error);
			historial_e($sql, $id_registro, $tabla, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
			$mensaje=1;
			$dato="Tipo de Visitante Eliminado";
			}
		header("location: sca_visitante_t_c.php?mensaje=$mensaje&dato=$dato");
	break;

	case 4:
		//Inclusion de Asunto 
		$url_origen=$_POST['url_origen'];
		$asunto=$_POST['asunto'];
		if ($asunto=="")
			{
			$mensaje=2;
			$dato="El campo asunto no puede estar vacio";
			}
		else
			{
			$tabla="asuntos";
			$sql="insert into $tabla (asunto) values ('$asunto')"; 
			$error="incluir Asunto";
			sql($sql, $error);
	
			historial_autoid_i($sql, $tabla, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);	
			$mensaje=1;
			$dato="Asunto Incluido";
			$url_origen="sca_asunto_c.php";
			}
		header("location: $url_origen?mensaje=$mensaje&dato=$dato");
	break;

	case 5:
		//Modificacion de Asunto
		$url_origen=$_POST['url_origen'];
		$id_asunto=$_POST['id_asunto'];
	
		$tabla="asuntos";
		$where="where id_asunto='$id_asunto'";
		$id_registro=$id_asunto;
		$arreglo_campos_v = Array ('asunto');/*Nombre de los Campos en las Tabla Correspondiente de MYSQL*/
		$arreglo_variables_v= Array ('asunto'); /*Nombre de la Variables en el Formulario*/
		$error="actualizar Asunto";
	
		historial_m($tabla, $where, $id_registro, $arreglo_campos_v, $arreglo_variables_v, $error, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
		$mensaje=1;
		$dato="Asunto Actualizado";
		header("location: $url_origen?mensaje=$mensaje&dato=$dato&id_asunto=$id_asunto");
	break;

	case 6:
		//Eliminación Asunto
		//$url_origen=$_POST['url_origen'];
		$id_asunto=$_REQUEST['id_asunto']; /*Recordar Cambiar el REQUEST*/
		if ($id_asunto=="")
			{
			$mensaje=2;
			$dato="El Asunto no se pudo Eliminar";
			}
		else
			{
			$id_registro=$id_asunto;
			$tabla="asuntos";
			$sql="delete from $tabla where id_asunto='$id_asunto'" ;
			$error="eliminar Asunto";
			sql($sql, $error);
			historial_e($sql, $id_registro, $tabla, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
	
			$mensaje=1;
			$dato="Asunto Eliminado";
			}
		header("location: sca_asunto_c.php?mensaje=$mensaje&dato=$dato");
	break;

	case 7:
		//Inclusion de Visitante 
		$url_origen=$_POST['url_origen'];
		$id_carnet=$_POST['id_carnet'];
	
		$cedula=$_POST['cedula'];
		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$telefono_movil=$_POST['telefono_movil'];
		$cod_ent=$_POST['cod_ent'];
		$cod_mun=$_POST['cod_mun'];
		$cod_parr=$_POST['cod_parr'];
		$cod_cp=$_POST['cod_cp'];
		$direccion=$_POST['direccion'];
		$id_visitante_t=$_POST['id_visitante_t'];
		
		//Parte II Tablas detalles Visitantes
		$cod_procedencia=$_POST['cod_procedencia'];
		$procedencia=$_POST['procedencia'];
		$id_asunto=$_POST['id_asunto'];
		$cod_emisor=$_POST['cod_emisor'];
		$emisor=$_POST['emisor'];
		
		/*Autorizacion datos*/
		$autorizacion_nombre=$_POST['autorizacion_nombre'];
		$codper=$_POST['codper'];
		$cedper=$_POST['cedper'];
		$nomper=$_POST['nomper'];
		$apeper=$_POST['apeper'];
		$codemp=$_POST['codemp'];
		$minorguniadm=$_POST['minorguniadm'];
		$ofiuniadm=$_POST['ofiuniadm'];
		$uniuniadm=$_POST['uniuniadm'];
		$depuniadm=$_POST['depuniadm'];
		$prouniadm=$_POST['prouniadm'];
		$desuniadm=$_POST['desuniadm'];
		$mydb=$_POST['mydb'];

		$observacion=$_POST['observacion'];

		//Inicio Validacion Vacio y uso actual de Carnet 
		$variables="cedula=$cedula&nombre=$nombre&apellido=$apellido&telefono_movil=$telefono_movil&cod_ent=$cod_ent&id_visitante_t=$id_visitante_t&cod_procedencia=$cod_procedencia&id_asunto=$id_asunto&cod_emisor=$cod_emisor&emisor=$emisor&procedencia=$procedencia&autorizacion_nombre=$autorizacion_nombre&codper=$codper&cedper=$cedper&nomper=$nomper&apeper=$apeper&codemp=$codemp&minorguniadm=$minorguniadm&ofiuniadm=$ofiuniadm&uniuniadm=$uniuniadm&depuniadm=$depuniadm&prouniadm=$prouniadm&desuniadm=$desuniadm&mydb=$mydb&regreso=1&observacion=$observacion";	

		if ($id_visitante_t==0)
			$id_visitante_t="";
		if ($id_asunto==0)
			$id_asunto="";
		
		$arreglo_empty_v= Array ($id_carnet); /*Nombre de la Variables en el Formulario*/
		$arreglo_empty_n= Array ('Nro de Carnet'); /*Nombre de la Variables en el Formulario*/
		$dato=vacio($arreglo_empty_v, $arreglo_empty_n);
		
		if ($id_carnet=='0')
			$dato="El Nro de Carnet introducido es incorrecto";
		if (!(empty($dato)))
			{
			$mensaje=2;
			echo "<meta http-equiv='refresh' content='0;URL=sca_visitante_recibir_i.php?mensaje=$mensaje&dato=$dato&$variables'/>";
			exit();
			}
		else
			{
			$sql_c = "select * from visitantes_h where id_carnet='$id_carnet' and fecha_s='0000-00-00 00:00:00'"; 
			$sql_c=sql_c($sql_c);
			$conteo_visitantes_h_c=@mysql_num_rows($sql_c);
			if ($conteo_visitantes_h_c!=0)
				{
				$mensaje=2;
				$dato="El Nro de Carnet $id_carnet actualmente esta asignado a otra persona";
				echo "<meta http-equiv='refresh' content='0;URL=sca_visitante_recibir_i.php?mensaje=$mensaje&dato=$dato&$variables'/>";
				exit();
				}
			}
		//Fin Validacion Vacio y uso actual de Carnet 
	
		$sql_c = "select * from visitantes where cedula='$cedula'"; 
		$sql_c=sql_c($sql_c);
		$conteo_visitantes_c=@mysql_num_rows($sql_c);
	
		if ($conteo_visitantes_c==0) //Corregir a Futuro y optimizar con updates
			{
			//Tabla visitantes		
			$tabla="visitantes";
			
			$sql="insert into $tabla (cedula, nombre, apellido, telefono_movil, cod_ent, cod_mun, cod_parr, cod_cp, direccion, id_visitante_t) values ('$cedula', '$nombre', '$apellido', '$telefono_movil', '$cod_ent', '$cod_mun', '$cod_parr', '$cod_cp', '$direccion', '$id_visitante_t')"; 
			$error="incluir visitante";
			sql($sql, $error);

			$id_registro=$cedula;
			$campo="Inclusión de visitante";
			$contenido=addslashes($sql);
			historial($id_registro, $tabla, $contenido, $campo, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
			}
		else
			{
			if ($conteo_visitantes_c==1)
				{
				$tabla="visitantes";
				$where="where cedula='$cedula'";
				$id_registro=$cedula;
				$arreglo_campos_v = Array ('nombre', 'apellido', 'telefono_movil', 'cod_ent', 'id_visitante_t');/*Nombre de los Campos en las Tabla Correspondiente de MYSQL*/
				$arreglo_variables_v= Array ('nombre', 'apellido', 'telefono_movil', 'cod_ent', 'id_visitante_t'); /*Nombre de la Variables en el Formulario*/
				$error="actualizar Visitante";
				historial_m($tabla, $where, $id_registro, $arreglo_campos_v, $arreglo_variables_v, $error, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
				}
			}
		
		//Tabla visitantes_h
		$tabla="visitantes_h";
		$sql="insert into $tabla (cedula, cod_procedencia, procedencia, cod_emisor, emisor, fecha_e, id_asunto, observacion, id_carnet) values ('$cedula', '$cod_procedencia', '$procedencia', '$cod_emisor', '$emisor', '$fecha_larga', '$id_asunto', '$observacion', '$id_carnet')"; 
		$error="incluir visitante_h";
		sql($sql, $error);
		$id_visitante_h=sql_autoid();
		historial_autoid_i($sql, $tabla, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);	

		//Tabla visitantes_a
		$tabla="visitantes_a";
		$id_registro=$id_visitante_h;
		$sql="insert into $tabla (id_visitante_h, codemp, autorizacion_nombre, codper, cedper, nomper, apeper, minorguniadm, ofiuniadm, uniuniadm, prouniadm, depuniadm, desuniadm, base_db) values ('$id_visitante_h', '$codemp', '$autorizacion_nombre', '$codper', '$cedper', '$nomper', '$apeper', '$minorguniadm', '$ofiuniadm', '$uniuniadm', '$prouniadm', '$depuniadm', '$desuniadm', '$mydb')";
		$error="incluir visitante_a";
		sql($sql, $error);
		//$id_registro="$id_visitante_h";
		$campo="Inclusión de visitantes_a";
		$contenido=addslashes($sql);
		historial($id_registro, $tabla, $contenido, $campo, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);

		$mensaje=1;
		$dato="Visitante Incluido";
		header("location: sca_visitante_c.php?mensaje=$mensaje&dato=$dato");
	break;

	case 8:
		//Inclusion de Salida de Visitante 
		$url_origen=$_POST['url_origen'];
		$id_carnet=$_POST['id_carnet'];
		if (!(empty ($id_carnet)))
			{
			$tabla="visitantes_h";
			$where="where id_carnet='$id_carnet' and fecha_s='0000-00-00 00:00:00'";

			$sql_c= "select * from $tabla $where";
			$sql_c=sql_c($sql_c);
			$conteo_visitantes_h=@mysql_num_rows($sql_c);
			if ($conteo_visitantes_h>=1)
				{
				$id_registro=$id_carnet;
				$arreglo_campos_v = Array ('fecha_s');/*Nombre de los Campos en las Tabla Correspondiente de MYSQL*/
				$arreglo_variables_v= Array ('fecha_s'); /*Nombre de la Variables en el Formulario*/
				$error="actualizar Salida Visitante";
			
				historial_m($tabla, $where, $id_registro, $arreglo_campos_v, $arreglo_variables_v, $error, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
				$mensaje=1;
				$dato="Salida de Visitante del Nro de Carnet $id_carnet Registrada";
				}
			else
				{
				$mensaje=2;
				$dato="El Nro de Carnet $id_carnet no existe";
				}
			}
		else
			{
			$mensaje=2;
			$dato="Es necesario un Nro de Carnet";
			}
		header("location: $url_origen?mensaje=$mensaje&dato=$dato");
	break;

	case 9:
		//Acceso de los Usuarios
		$url_origen=$_POST['url_origen'];
		$id_usuario=$_POST['id_usuario'];
		$clave=$_POST['clave'];
		$clave = sha1 ( $clave );// Uso de Sha1
		$sql_c= "select * from usuarios where id_usuario = '$id_usuario' and clave='$clave'";
		$sql_c=sql_c($sql_c);
		if (!(@mysql_num_rows ($sql_c) == 0))
			{
			while ($campo = mysql_fetch_array ($sql_c))
				{
				$id_usuario2=$campo["id_usuario"];
				$clave2=$campo['clave'];
				$nombre_u=$campo['nombre'];
				$apellido_u=$campo['apellido'];
				$id_tipo_u=$campo['id_tipo_u'];
				}
			}
		if (($id_usuario==$id_usuario2) and ($clave==$clave2))
			{
			$_SESSION['sca_id_u_activo']=$id_usuario2;
			$_SESSION['sca_nombre_u']=$nombre_u;
			$_SESSION['sca_apellido_u']=$apellido_u;
			$_SESSION['sca_id_tipo_u_menu']=$id_tipo_u;
			$sql= "update usuarios set ip_acceso_u='$ip_acceso_u', fecha_acceso_u='$fecha_larga' where id_usuario='$id_usuario2'";
			$error="Error en Actualizar IP, Fecha";
			sql($sql, $error);

			$dato="Usuario Conectado";
			$mensaje=1;
			header("location: sca_principal.php?mensaje=$mensaje&dato=$dato");
			}
		else
			{
			$dato="El Nombre de Usuario o Clave estan Errados, Intente Nuevamente";
			$mensaje=2;
			header("location: $url_origen?mensaje=$mensaje&dato=$dato");
			}
	break;

	case 10:
		//Inclusion de Usuarios (Administrador)
		$id_usuario=$_POST['id_usuario'];
		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];	
		$id_tipo_u=$_POST['id_tipo_u'];
		$url_origen=$_POST['url_origen'];
		$tabla="usuarios";
		@$clave = sha1 ( $clave );
		if (!(empty($id_usuario)))
			{
			//Inicio Consulta de Usuarios
			$sql_c ="select id_usuario from $tabla where id_usuario='$id_usuario'";
			$sql_c = sql_c($sql_c);
			$filas=@mysql_num_rows($sql_c);
			if ($filas>=1)
				$dato="El Usuario $id_usuario ya existe";
			//Fin Consulta de Usuarios
			
			$clave1=$_POST['clave1'];//Comparacion de Clave
			$clave2=$_POST['clave2'];//Comparacion de Clave
			if ($clave1!=$clave2)
				{
				if (empty ($dato))
					$dato="Verifica tu clave otra vez";
				else
					$dato="$dato - Verifica tu clave otra vez";
				}
			else
				$clave = sha1 ( $clave1 );// Uso de Sha-1
			/*
			if (strlen($clave1)<6 || strlen($clave1)>100)//compruebo que el tamaño del string sea vlido.
				{
				if (empty ($dato))
					$dato="La Contrasea debe ser igual o ms de 6 caracteres";
				else
					$dato="$dato - La Contrasea debe ser igual o ms de 6 caracteres";
				}
			*/
			}
		else
			{
			$dato="El Campo Id Usuario no puede estar en blanco";
			}
			if (empty($dato))
				{
				$sql="insert into $tabla (id_usuario, clave, nombre, apellido, id_tipo_u) values ('$id_usuario', '$clave', '$nombre', '$apellido', '$id_tipo_u')";
				$error="incluir Usuario";
				sql($sql, $error);

				$id_registro="$id_usuario";		
				$tabla="usuarios";
				$campo="Inclusión de Usuario";
				$contenido= "Id: $id_usuario / nombre: $nombre / apellido: $apellido / id_tipo_u: $id_tipo_u";
				historial($id_registro, $tabla, $contenido, $campo, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);

				$dato="Usuario Registrado";
				$mensaje=1;
				}
			else
				{
				$mensaje=2;
				$dato="$dato&nombre=$nombre&apellido=$apellido&id_tipo_u=$id_tipo_u";
				}
		header("location: $url_origen?mensaje=$mensaje&dato=$dato");
	break;

	case 11:
		//Modificacion de Usuarios (Administrador)
		conectar ();
		$url_origen=$_POST['url_origen'];
		$id_usuario=$_POST['id_usuario'];

		$tabla="usuarios";
		$where="where id_usuario='$id_usuario'";
		$id_registro=$id_usuario;
		$arreglo_campos_v = Array ('nombre', 'apellido', 'id_tipo_u');/*Nombre de los Campos en las Tabla Correspondiente de MYSQL*/
		$arreglo_variables_v= Array ('nombre', 'apellido', 'id_tipo_u'); /*Nombre de la Variables en el Formulario*/
		$error="Modificar datos del Usuario";

		historial_m($tabla, $where, $id_registro, $arreglo_campos_v, $arreglo_variables_v, $error, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
		$mensaje=1;
		$dato="Datos del Usuario Actualizado";
		header("location: $url_origen?mensaje=$mensaje&dato=$dato&id_usuario=$id_usuario");
	break;

	case 12:
		//Modificacion de Contraseñas (Administrador)
		conectar();
		$url_origen=$_POST['url_origen'];
		$id_usuario=$_POST['id_usuario'];
		$clave_n1=$_POST['clave_n1'];
		$clave_n2=$_POST['clave_n2'];
		if ($clave_n1!=$clave_n2)
			{
			if (empty ($dato))
				$dato="Verifica tu Clave otra vez";
			else
				$dato="$dato - Verifica tu Clave otra vez";
			}
//		if (strlen($clave_n1)<6 || strlen($clave_n1)>100)//compruebo que el tamaño del string sea válido.
//			{
//			if (empty ($dato))
//				$dato="La Clave debe ser igual o más de 6 caracteres";
//			else
//				$dato="$dato - La Clave debe ser igual o más de 6 caracteres";
//			}

		$id_registro="$id_usuario";
		$tabla="usuarios";
		$campo="clave";
		$contenido= "Cambio de Clave";

		if (empty ($dato))
			{
			$clave_n1 = sha1 ( $clave_n1 );// Uso de Sha-1
			$sql = "update $tabla set clave='$clave_n1' where id_usuario='$id_usuario'";
			$error="Actualizar Clave";
			sql($sql, $error);
			$dato="Clave Actualizada";
			$mensaje=1;
			
			historial($id_registro, $tabla, $contenido, $campo, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
			}
		else
			$mensaje="2&id_usuario=$id_usuario";
		header("location: $url_origen?mensaje=$mensaje&dato=$dato");
	break;

	case 13:
		//Modificacion de Usuario (Usuarios)
		$url_origen=$_POST['url_origen'];
	
		$tabla="usuarios";
		$where="where id_usuario='$sca_id_u_activo'";
		$id_registro=$sca_id_u_activo;
		$arreglo_campos_v = Array ('nombre', 'apellido');/*Nombre de los Campos en las Tabla Correspondiente de MYSQL*/
		$arreglo_variables_v= Array ('nombre', 'apellido'); /*Nombre de la Variables en el Formulario*/
		$error="Datos del Usuario";

		historial_m($tabla, $where, $id_registro, $arreglo_campos_v, $arreglo_variables_v, $error, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
		$mensaje=1;
		$dato="Datos del Usuario Actualizado";
		header("location: $url_origen?mensaje=$mensaje&dato=$dato");
	break;

	case 14:
		//Modificacion de Contraseñas (Usuarios)
		conectar();
		$url_origen=$_POST['url_origen'];
		$clave_a=$_POST['clave_a'];
		$clave_a = sha1 ( $clave_a );
		$clave_n1=$_POST['clave_n1'];
		$clave_n2=$_POST['clave_n2'];

		//Inicio Consulta de Clave
		$sql_c="select clave from usuarios where clave='$clave_a' and id_usuario='$sca_id_u_activo'";
		$sql_c = sql_c($sql_c);
		$filas=@mysql_num_rows($sql_c);
		if ($filas!=1)
			$dato="Verifica tu Clave otra vez";
		//Fin Consulta de Clave
		
		if ($filas==1)
			{
			if ($clave_n1!=$clave_n2)
				{
				if (empty ($dato))
						$dato="Verifica tu Clave otra vez";
					else
						$dato="$dato - Verifica tu Clave otra vez";
				}
//			if (strlen($clave_n1)<6 || strlen($clave_n1)>100)//compruebo que el tamaño del string sea válido.
//				{
//				if (empty ($dato))
//					$dato="La Clave debe ser igual o más de 6 caracteres";
//				else
//					$dato="$dato - La Clave debe ser igual o más de 6 caracteres";
//				}
			}
		if (empty ($dato))
			{
			$clave_n1 = sha1 ( $clave_n1 );// Uso de Sha-1
			
			$id_registro="$sca_id_u_activo";
			$tabla="usuarios";
			$campo="clave";
			$contenido= "Cambio de Clave";
			
			$sql = "update $tabla set clave='$clave_n1' where id_usuario='$sca_id_u_activo'";
			$error="Actualizar Clave";
			sql($sql, $error);

			$dato="Clave Actualizada";
			$mensaje=1;

			historial($id_registro, $tabla, $contenido, $campo, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
			}
		else
			$mensaje=2;
		header("location: $url_origen?mensaje=$mensaje&dato=$dato");
	break;

	case 15:
		//Inclusion de Tipo de Correspondencia
		$url_origen=$_POST['url_origen'];
		$correspondencia_t=$_POST['correspondencia_t'];
		
		if ($correspondencia_t=="")
			{
			$mensaje=2;
			$dato="El campo tipo de Correspondencia no puede estar vacio";
			}
		else
			{
			$tabla="correspondencias_t";
			$sql="insert into $tabla (correspondencia_t) values ('$correspondencia_t')"; 
			$error="incluir Tipo de Correspondencia";
			sql($sql, $error);
	
			historial_autoid_i($sql, $tabla, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);	
			$mensaje=1;
			$dato="Tipo de Correspondencia Incluido";
			$url_origen="sca_correspondencia_t_c.php";
			}
		header("location: $url_origen?mensaje=$mensaje&dato=$dato");
	break;

	case 16:
		//Modificacion de Tipo de Correspondencia
		$url_origen=$_POST['url_origen'];
		$id_correspondencia_t=$_POST['id_correspondencia_t'];
	
		$tabla="correspondencias_t";
		$where="where id_correspondencia_t='$id_correspondencia_t'";
		$id_registro=$id_correspondencia_t;
		$arreglo_campos_v = Array ('correspondencia_t');/*Nombre de los Campos en las Tabla Correspondiente de MYSQL*/
		$arreglo_variables_v= Array ('correspondencia_t'); /*Nombre de la Variables en el Formulario*/
		$error="actualizar Tipo de Correspondencia";
	
		historial_m($tabla, $where, $id_registro, $arreglo_campos_v, $arreglo_variables_v, $error, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
		$mensaje=1;
		$dato="Tipo de Correspondencia Actualizado";
		header("location: $url_origen?mensaje=$mensaje&dato=$dato&id_correspondencia_t=$id_correspondencia_t");
	break;

	case 17:
		//Eliminación Tipo de Correspondencia
		//$url_origen=$_POST['url_origen'];
		$id_correspondencia_t=$_REQUEST['id_correspondencia_t']; /*Recordar Cambiar el REQUEST*/
		$id_registro=$id_correspondencia_t;
		$tabla="correspondencias_t";
		$sql="delete from $tabla where id_correspondencia_t='$id_correspondencia_t'" ;
		$error="eliminar Tipo de Correspondencia";
		sql($sql, $error);
		historial_e($sql, $id_registro, $tabla, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);

		$mensaje=1;
		$dato="Tipo de Correspondencia Eliminado";
		header("location: sca_correspondencia_t_c.php?mensaje=$mensaje&dato=$dato");
	break;

	case 18:
		//Inclusion de Tipo de Anexo
		$url_origen=$_POST['url_origen'];
		$anexo_t=$_POST['anexo_t'];
	
		if ($anexo_t=="")
			{
			$mensaje=2;
			$dato="El campo tipo de Anexo no puede estar vacio";
			}
		else
			{
			$tabla="anexos_t";
			$sql="insert into $tabla (anexo_t) values ('$anexo_t')"; 
			$error="incluir Tipo de anexo";
			sql($sql, $error);
	
			historial_autoid_i($sql, $tabla, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);	
			$mensaje=1;
			$dato="Tipo de Anexo Incluido";
			$url_origen="sca_anexo_t_c.php";
			}
		header("location: $url_origen?mensaje=$mensaje&dato=$dato");
	break;

	case 19:
		//Modificacion de Anexo
		$url_origen=$_POST['url_origen'];
		$id_anexo_t=$_POST['id_anexo_t'];
	
		$tabla="anexos_t";
		$where="where id_anexo_t='$id_anexo_t'";
		$id_registro=$id_anexo_t;
		$arreglo_campos_v = Array ('anexo_t');/*Nombre de los Campos en las Tabla Correspondiente de MYSQL*/
		$arreglo_variables_v= Array ('anexo_t'); /*Nombre de la Variables en el Formulario*/
		$error="actualizar Tipo de anexo";
	
		historial_m($tabla, $where, $id_registro, $arreglo_campos_v, $arreglo_variables_v, $error, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
		$mensaje=1;
		$dato="Tipo de Anexo Actualizado";
		header("location: $url_origen?mensaje=$mensaje&dato=$dato&id_anexo_t=$id_anexo_t");
	break;

	case 20:
		//Eliminación Anexo
		//$url_origen=$_POST['url_origen'];
		$id_anexo_t=$_REQUEST['id_anexo_t']; /*Recordar Cambiar el REQUEST*/
		$id_registro=$id_anexo_t;
		$tabla="anexos_t";
		$sql="delete from $tabla where id_anexo_t='$id_anexo_t'" ;
		$error="eliminar Tipo de anexo";
		sql($sql, $error);
		historial_e($sql, $id_registro, $tabla, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);

		$mensaje=1;
		$dato="Tipo de Anexo Eliminado";
		header("location: sca_anexo_t_c.php?mensaje=$mensaje&dato=$dato");
	break;

	case 21:
		//Inclusion de Correspondencia 
		$url_origen=$_POST['url_origen'];
		$id_anexo_t=$_POST['id_anexo_t'];
		$id_correspondencia_t=$_POST['id_correspondencia_t'];
		$cod_procedencia=$_POST['cod_procedencia'];
		$procedencia=$_POST['procedencia'];
		$destino_nombre=$_POST['destino_nombre'];
		$destino_cargo=$_POST['destino_cargo'];
		$cod_emisor=$_POST['cod_emisor'];
		$emisor=$_POST['emisor'];
		$emisor_nombre=$_POST['emisor_nombre'];
		$emisor_cargo=$_POST['emisor_cargo'];
		
		//Validacion Campos
		if ($id_anexo_t==0)
			$id_anexo_t="";//Temporal Hasta que se Solucione
		if ($id_correspondencia_t==0)
			$id_correspondencia_t="";//Temporal Hasta que se Solucione
		$arreglo_empty_v= Array ($id_correspondencia_t, $id_anexo_t, $procedencia, $destino_nombre, $destino_cargo, $emisor, $emisor_nombre, $emisor_cargo); /*Nombre de la Variables en el Formulario*/
		$arreglo_empty_n= Array ('Tipo de Correspondencia', 'Tipo de Anexo', 'Receptor(Destino)', 'Nombre(Destino)', 'Cargo (Destino)', 'Emisor', 'Nombre (Emisor)', 'Cargo (Emisor)'); /*Nombre de la Variables en el Formulario*/		
		$dato=vacio($arreglo_empty_v, $arreglo_empty_n);
		$variables= "id_anexo_t=$id_anexo_t&id_correspondencia_t=$id_correspondencia_t&cod_procedencia=$cod_procedencia&procedencia=$procedencia&destino_nombre=$destino_nombre&destino_cargo=$destino_cargo&cod_emisor=$cod_emisor&emisor=$emisor&emisor_nombre=$emisor_nombre&emisor_cargo=$emisor_cargo";
		if ($dato=="")
			{	
			$tabla="correspondencias";
			$sql="insert into $tabla (id_anexo_t, id_correspondencia_t, cod_procedencia, procedencia, destino_nombre, destino_cargo, cod_emisor, emisor, emisor_nombre, emisor_cargo, fecha_r) values ('$id_anexo_t', '$id_correspondencia_t', '$cod_procedencia', '$procedencia', '$destino_nombre', '$destino_cargo', '$cod_emisor', '$emisor', '$emisor_nombre', '$emisor_cargo', '$fecha_larga')"; 
			$error="incluir en Correspondencia";
			sql($sql, $error);
	
			historial_autoid_i($sql, $tabla, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);	
			$mensaje=1;
			$dato="Correspondencia Incluida";
			$url_origen="sca_correspondencia_c.php";
			}
		else
			$mensaje="2&$variables&regreso=1";
		header("location: $url_origen?mensaje=$mensaje&dato=$dato");
	break;

	case 22:
		//Modificacion de Correspondencia
		$url_origen=$_POST['url_origen'];
		$id_correspondencia=$_POST['id_correspondencia'];
		
		$arreglo_empty_v= Array ('receptor_nombre'); /*Nombre de la Variables en el Formulario*/
		$arreglo_empty_n= Array ('Nombre de Receptor'); /*Nombre de la Variables en el Formulario*/		
		$dato=vacio_post($arreglo_empty_v, $arreglo_empty_n);
		if ($dato=="")
			{	
			$tabla="correspondencias";
			$where="where id_correspondencia='$id_correspondencia'";
			$id_registro=$id_correspondencia;
			$arreglo_campos_v = Array ('receptor_nombre', 'fecha_e');/*Nombre de los Campos en las Tabla Correspondiente de MYSQL*/
			$arreglo_variables_v= Array ('receptor_nombre', 'fecha_e'); /*Nombre de la Variables en el Formulario*/
			$error="actualizar Tipo de anexo";
	
			historial_m($tabla, $where, $id_registro, $arreglo_campos_v, $arreglo_variables_v, $error, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
			$mensaje=1;
			$dato="Correspondencia Actualizada";
			$url_origen="sca_correspondencia_c.php";
			}
		else
			$mensaje=2;
		header("location: $url_origen?mensaje=$mensaje&dato=$dato&id_correspondencia=$id_correspondencia");
	break;

	case 23:
		//Eliminación de Correspondencia
		$url_origen=$_POST['url_origen'];
//		$id_correspondencia_t=$_REQUEST['id_correspondencia_t']; /*Recordar Cambiar el REQUEST*/
//		$id_registro=$id_correspondencia_t;
//		$tabla="correspondencias_t";
//		$sql="delete from $tabla where id_correspondencia_t='$id_correspondencia_t'" ;
//		$error="eliminar Tipo de Correspondencia";
//		sql($sql, $error);
//		historial_e($sql, $id_registro, $tabla, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
//
//		$mensaje=1;
//		$dato="Tipo de Correspondencia Eliminado";
//		header("location: sca_correspondencia_t_c.php?mensaje=$mensaje&dato=$dato");
	break;

	case 24:
		//Inclusion - Modificacion - Eliminacion bases_sigesp Principal y Secundarios
		$url_origen=$_POST['url_origen'];
		$tabla="bases_db";

		//Inicio Bases Sigesp Principal
		if (isset($_POST['base_sigesp_principal']))
			{
			$base_sigesp=="";
			$conteo_base=0;
			$base_sigesp_principal = $_POST['base_sigesp_principal'];
			$base_sigesp_principal_count= count($base_sigesp_principal);

			$sql_c="select * from $tabla where id_base_db_t='1'";
			$sql_c=sql_c($sql_c);
			if (!(@mysql_num_rows ($sql_c) == 0))
				{
				while ($campo = mysql_fetch_array ($sql_c))
					{
					$base_sigesp=$campo ['base_db'];
					$id_base_sigesp_t=$campo ['id_base_db_t'];
					if ($id_base_sigesp_t==1)
						{
						$i= 0;
						while ($i < $base_sigesp_principal_count)
							{
							if ($base_sigesp_principal[$i]==$base_sigesp)
								$conteo_base=1;
							$i++;
							}
						if ($conteo_base!=1)
							{
							$id_registro=$base_sigesp;
							$sql="delete from $tabla where base_db='$base_sigesp' and id_base_db_t='1'" ;
							$error="eliminar Base de Sigesp Principal";
							sql($sql, $error);
							historial_e($sql, $id_registro, $tabla, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
							}
 						$conteo_base=0;
						}
					}
				}
			$i= 0;
			while ($i < $base_sigesp_principal_count)
				{
				$sql_c="select * from $tabla where id_base_db_t='1' and base_db='$base_sigesp_principal[$i]'";
				$sql_c=sql_c($sql_c);
				$conteo_sql_c=@mysql_num_rows($sql_c);
				if ($conteo_sql_c==0)
					{
					$id_base_sigesp_t=1;
					$sql="insert into $tabla (base_db, id_base_db_t) values ('$base_sigesp_principal[$i]', '$id_base_sigesp_t')";
					$error="incluir Base Sigesp Principal";
					sql($sql, $error);
											
					$mensaje=1;
					$dato="Base Sigesp Principal Incluida";
					$id_registro="$base_sigesp_principal[$i]";		
					$campo="Inclusión de Base Sigesp Principal";
					$contenido=addslashes($sql);
					historial($id_registro, $tabla, $contenido, $campo, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
					}
				$i++;
				}
			}
		else
			{
			$id_registro="Bases Sigesp Principal";
			$sql="delete from $tabla where id_base_db_t='1'" ;
			$error="eliminar Base de Sigesp Principal";
			sql($sql, $error);
			historial_e($sql, $id_registro, $tabla, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
			$mensaje=1;
			$dato="Base Sigesp Principal Eliminado";
			}
		//Fin Bases Sigesp Principal
	
		//Inicio Bases Sigesp Secundario
		if (isset($_POST['base_sigesp_secundario']))
			{
			$base_sigesp=="";
			$conteo_base=0;
			$base_sigesp_secundario = $_POST['base_sigesp_secundario'];
			$base_sigesp_secundario_count= count($base_sigesp_secundario);

			$sql_c="select * from $tabla where id_base_db_t='2'";
			$sql_c=sql_c($sql_c);
			if (!(@mysql_num_rows ($sql_c) == 0))
				{
				while ($campo = mysql_fetch_array ($sql_c))
					{
					$base_sigesp=$campo ['base_db'];
					$id_base_sigesp_t=$campo ['id_base_db_t'];
					if ($id_base_sigesp_t==2)
						{
						$i= 0;
						while ($i < $base_sigesp_secundario_count)
							{
							if ($base_sigesp_secundario[$i]==$base_sigesp)
								$conteo_base=1;
							$i++;
							}
						if ($conteo_base!=1)
							{
							$id_registro=$base_sigesp;
							$sql="delete from $tabla where base_db='$base_sigesp' and id_base_db_t='2'" ;
							$error="eliminar Base de Sigesp Secundario";
							sql($sql, $error);
							historial_e($sql, $id_registro, $tabla, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
							}
 						$conteo_base=0;
						}
					}
				}
			$i= 0;
			while ($i < $base_sigesp_secundario_count)
				{
				$sql_c="select * from $tabla where id_base_db_t='2' and base_db='$base_sigesp_secundario[$i]'";
				$sql_c=sql_c($sql_c);
				$conteo_sql_c=@mysql_num_rows($sql_c);
				if ($conteo_sql_c==0)
					{
					$id_base_sigesp_t=2;
					$sql="insert into $tabla (base_db, id_base_db_t) values ('$base_sigesp_secundario[$i]', '$id_base_sigesp_t')";
					$error="incluir Base Sigesp Secundario";
					sql($sql, $error);
											
					$mensaje=1;
					$dato="Base Sigesp Secundario Incluida";
					$id_registro="$base_sigesp_secundario[$i]";		
					$campo="Inclusión de Base Sigesp Secundario";
					$contenido=addslashes($sql);
					historial($id_registro, $tabla, $contenido, $campo, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
					}
				$i++;
				}
			}
		else
			{
			$id_registro="Bases Sigesp Secundario";
			$sql="delete from $tabla where id_base_db_t='2'" ;
			$error="eliminar Base de Sigesp Secundario";
			sql($sql, $error);
			historial_e($sql, $id_registro, $tabla, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
			$mensaje=1;
			$dato="Base Sigesp Secundario Eliminado";
			}
		//Fin Bases Sigesp Secundario
		header("location: $url_origen?mensaje=$mensaje&dato=$dato");
	break;

	case 25:
		//Inclusion - Modificacion - Eliminacion DB mincul_corr
		$url_origen=$_POST['url_origen'];
		$tabla="bases_db";

		$base_mincul_corr=$_POST['base_mincul_corr'];
		$sql_c="select * from $tabla where id_base_db_t='3'";
		$sql_c=sql_c($sql_c);
		$conteo_sql_c=@mysql_num_rows($sql_c);
		$id_base_db_t=3;
		if ($conteo_sql_c==0)
			{
			$sql="insert into $tabla (base_db, id_base_db_t) values ('$base_mincul_corr', '$id_base_db_t')";
			$error="incluir Base DB SISYC";
			sql($sql, $error);
			
			$mensaje=1;
			$dato="DB SISYC Incluida";

			$id_registro="$base_mincul_corr";		
			$campo="Inclusión de DB mincul_corr";
			$contenido=addslashes($sql);
			historial($id_registro, $tabla, $contenido, $campo, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
			}
		else
			{
			if (!(@mysql_num_rows ($sql_c) == 0))
				{
				while ($campo = mysql_fetch_array ($sql_c))
					{
					$base_mincul_corr2=$campo ['base_db'];
					if ($base_mincul_corr!=$base_mincul_corr2)
						{
						$where="where id_base_db_t='3'";
						$id_registro=$base_mincul_corr;
						$arreglo_campos_v = Array ('base_db');/*Nombre de los Campos en las Tabla Correspondiente de MYSQL*/
						$arreglo_variables_v= Array ('base_mincul_corr'); /*Nombre de la Variables en el Formulario*/
						$error="actualizar DB SISYC";
		
						historial_m($tabla, $where, $id_registro, $arreglo_campos_v, $arreglo_variables_v, $error, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
						$mensaje=1;
						$dato="DB SISYC Actualizada";
						}
					}
				}
			}
		header("location: $url_origen?mensaje=$mensaje&dato=$dato");
	break;

	case 26:
		//Consulta de Salida de Visitante 
		$id_carnet=$_POST['id_carnet'];
		$url_origen=$_POST['url_origen'];
		if (!(empty ($id_carnet)))
			{
			$tabla="visitantes_h";
			$where="where id_carnet='$id_carnet' and fecha_s='0000-00-00 00:00:00'";
	
			$sql_c= "select * from $tabla $where";
			$sql_c=sql_c($sql_c);
			$conteo_visitantes_h=@mysql_num_rows($sql_c);
			if ($conteo_visitantes_h==0)
				{
				$mensaje=2;
				$dato="El Nro de Carnet $id_carnet no existe";
				$variable="mensaje=$mensaje&dato=$dato";
				}
			else
				$variable="id_carnet=$id_carnet";
			}
		header("location: $url_origen?$variable");
	break;

	case 27:
		//Recepcion de datos Visitantes
		//Tabla Visitante
		$cedula=$_POST['cedula'];
		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$telefono_movil=$_POST['telefono_movil'];
		$cod_ent=$_POST['cod_ent'];
		/*$cod_mun=$_POST['cod_mun'];
		$cod_parr=$_POST['cod_parr'];
		$cod_cp=$_POST['cod_cp'];
		$direccion=$_POST['direccion'];*/
		$id_visitante_t=$_POST['id_visitante_t'];
		
		//Parte II Tablas detalles Visitantes
		$cod_procedencia=$_POST['cod_procedencia'];
		$procedencia=$_POST['procedencia'];
		$id_asunto=$_POST['id_asunto'];
		$cod_emisor=$_POST['cod_emisor'];
		$emisor=$_POST['emisor'];
		
		/*Autorizacion datos*/
		$autorizacion_nombre=$_POST['autorizacion_nombre'];
		$codper=$_POST['codper'];
		$cedper=$_POST['cedper'];
		$nomper=$_POST['nomper'];
		$apeper=$_POST['apeper'];
		$codemp=$_POST['codemp'];
		$minorguniadm=$_POST['minorguniadm'];
		$ofiuniadm=$_POST['ofiuniadm'];
		$uniuniadm=$_POST['uniuniadm'];
		$depuniadm=$_POST['depuniadm'];
		$prouniadm=$_POST['prouniadm'];
		$desuniadm=$_POST['desuniadm'];
		$mydb=$_POST['mydb'];
		$observacion=$_POST['observacion'];
		
		$variables="cedula=$cedula&nombre=$nombre&apellido=$apellido&telefono_movil=$telefono_movil&cod_ent=$cod_ent&id_visitante_t=$id_visitante_t&cod_procedencia=$cod_procedencia&id_asunto=$id_asunto&cod_emisor=$cod_emisor&emisor=$emisor&procedencia=$procedencia&autorizacion_nombre=$autorizacion_nombre&codper=$codper&cedper=$cedper&nomper=$nomper&apeper=$apeper&codemp=$codemp&minorguniadm=$minorguniadm&ofiuniadm=$ofiuniadm&uniuniadm=$uniuniadm&depuniadm=$depuniadm&prouniadm=$prouniadm&desuniadm=$desuniadm&mydb=$mydb&regreso=1&observacion=$observacion";	

		if ($id_visitante_t==0)
			$id_visitante_t="";
		if ($id_asunto==0)
			$id_asunto="";
		$arreglo_empty_v= Array ($cedula, $nombre, $apellido, $telefono_movil, $cod_ent, $id_visitante_t, $procedencia, $id_asunto,$emisor, $autorizacion_nombre); /*Nombre de la Variables en el Formulario*/
		$arreglo_empty_n= Array ('Cedula', 'Nombre', 'Apellido', 'Telefono Movil', 'Entidad', 'Tipo de Visitante', 'Procedencia', 'Motivo de Visita', 'Destino', 'Autorizacion (Nombre)'); /*Nombre de la Variables en el Formulario*/
		$dato=vacio($arreglo_empty_v, $arreglo_empty_n);
			
		if (!(empty($dato)))
			{
			$mensaje=2;
			echo "<meta http-equiv='refresh' content='0;URL=sca_visitante_i.php?mensaje=$mensaje&dato=$dato&$variables'/>";
			}
		else
			echo "<meta http-equiv='refresh' content='0;URL=sca_visitante_recibir_i.php?$variables'/>";
	break;

	case 28:
		//Recepcion de datos Visitantes Basico (Buscar la forma de no repetir el case 27)
		//Tabla Visitante
		$cedula=$_POST['cedula'];
		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$telefono_movil=$_POST['telefono_movil'];
		$cod_ent=$_POST['cod_ent'];
		/*$cod_mun=$_POST['cod_mun'];
		$cod_parr=$_POST['cod_parr'];
		$cod_cp=$_POST['cod_cp'];
		$direccion=$_POST['direccion'];*/
		//$id_visitante_t=$_POST['id_visitante_t'];
		$observacion=$_POST['observacion'];

		$variables="cedula=$cedula&nombre=$nombre&apellido=$apellido&telefono_movil=$telefono_movil&cod_ent=$cod_ent&regreso=1&observacion=$observacion";	

		if ($id_visitante_t==0)
			$id_visitante_t="";
		if ($id_asunto==0)
			$id_asunto="";
		if ($cod_ent==0)
			$cod_ent="";
		$arreglo_empty_v= Array ($cedula, $nombre, $apellido, $telefono_movil, $cod_ent); /*Nombre de la Variables en el Formulario*/
		$arreglo_empty_n= Array ('Cedula', 'Nombre', 'Apellido', 'Telefono Movil', 'Entidad'); /*Nombre de la Variables en el Formulario*/
		$dato=vacio($arreglo_empty_v, $arreglo_empty_n);
			
		if (!(empty($dato)))
			{
			$mensaje=2;
			echo "<meta http-equiv='refresh' content='0;URL=sca_basico_visitante_i.php?mensaje=$mensaje&dato=$dato&$variables'/>";
			}
		else
			echo "<meta http-equiv='refresh' content='0;URL=sca_basico_visitante_recibir_i.php?$variables'/>";
	break;

	case 29:
		//Inclusion de Visitante Basico Primera Etapa
		$url_origen=$_POST['url_origen'];
		$id_carnet=$_POST['id_carnet'];
	
		$cedula=$_POST['cedula'];
		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$telefono_movil=$_POST['telefono_movil'];
		$cod_ent=$_POST['cod_ent'];
		//$id_visitante_t=$_POST['id_visitante_t'];
		$observacion=$_POST['observacion'];
		
		$sql_c = "select * from visitantes where cedula='$cedula'"; 
		$sql_c=sql_c($sql_c);
		$conteo_visitantes_c=@mysql_num_rows($sql_c);
	
		if ($conteo_visitantes_c==0) //Corregir a Futuro y optimizar con updates
			{
			//Tabla visitantes		
			$tabla="visitantes";
			$sql="insert into $tabla (cedula, nombre, apellido, telefono_movil, cod_ent, cod_mun, cod_parr, cod_cp, direccion) values ('$cedula', '$nombre', '$apellido', '$telefono_movil', '$cod_ent', '$cod_mun', '$cod_parr', '$cod_cp', '$direccion')"; 
			$error="incluir visitante";
			sql($sql, $error);
			historial_autoid_i($sql, $tabla, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);	
			}

		//Tabla visitantes_h
		$tabla="visitantes_h";
		$sql="insert into $tabla (cedula, fecha_e, observacion, id_carnet) values ('$cedula','$fecha_larga', '$observacion', '$id_carnet')"; 

		$error="incluir visitante_h";
		sql($sql, $error);
		historial_autoid_i($sql, $tabla, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);	


		$mensaje=1;
		$dato="Visitante Incluido";
		header("location: sca_basico_sno_personalnomina_c.php?mensaje=$mensaje&dato=$dato");
	break;

	case 30:
		//Recepcion de datos Visitantes Basico 2da Etapa
		$url_origen=$_POST['url_origen'];

		//Tabla Visitante
		$id_visitante_t=$_POST['id_visitante_t'];

		//Tabla visitante_h
		$id_visitante_h=$_POST['id_visitante_h'];
		$cod_procedencia=$_POST['cod_procedencia'];
		$procedencia=$_POST['procedencia'];
		$id_asunto=$_POST['id_asunto'];
		$cod_emisor=$_POST['cod_emisor'];
		$emisor=$_POST['emisor'];
		
		/*Autorizacion datos*/
		$id_carnet=$_POST['id_carnet'];
		$autorizacion_nombre=$_POST['autorizacion_nombre'];
		$codper=$_POST['codper'];
		$cedper=$_POST['cedper'];
		$nomper=$_POST['nomper'];
		$apeper=$_POST['apeper'];
		$codemp=$_POST['codemp'];
		$minorguniadm=$_POST['minorguniadm'];
		$ofiuniadm=$_POST['ofiuniadm'];
		$uniuniadm=$_POST['uniuniadm'];
		$depuniadm=$_POST['depuniadm'];
		$prouniadm=$_POST['prouniadm'];
		$desuniadm=$_POST['desuniadm'];
		$observacion=$_POST['observacion'];

		$variables="id_visitante_t=$id_visitante_t&cod_procedencia=$cod_procedencia&id_asunto=$id_asunto&cod_emisor=$cod_emisor&emisor=$emisor&procedencia=$procedencia&autorizacion_nombre=$autorizacion_nombre&codper=$codper&cedper=$cedper&nomper=$nomper&apeper=$apeper&codemp=$codemp&minorguniadm=$minorguniadm&ofiuniadm=$ofiuniadm&uniuniadm=$uniuniadm&depuniadm=$depuniadm&prouniadm=$prouniadm&desuniadm=$desuniadm&regreso=1&observacion=$observacion&id_carnet=$id_carnet";

		if ($id_visitante_t==0)
			$id_visitante_t="";
		if ($id_asunto==0)
			$id_asunto="";
		$arreglo_empty_v= Array ($id_visitante_t, $procedencia, $id_asunto,$emisor, $autorizacion_nombre); /*Nombre de la Variables en el Formulario*/
		$arreglo_empty_n= Array ('Tipo de Visitante', 'Procedencia', 'Motivo de Visita', 'Destino', 'Autorizacion (Nombre)'); /*Nombre de la Variables en el Formulario*/
		$dato=vacio($arreglo_empty_v, $arreglo_empty_n);
			
		if (!(empty($dato)))
			{
			$mensaje=2;
			echo "<meta http-equiv='refresh' content='0;URL=$url_origen?mensaje=$mensaje&dato=$dato&$variables'/>";
			}
		else
			echo "<meta http-equiv='refresh' content='0;URL=sca_basico_visitante_carnet_recibir_i.php?$variables'/>";
	break;

	case 31:
		//Inclusion de Visitante Basico 2da Etapa
		$url_origen=$_POST['url_origen'];
		$id_carnet=$_POST['id_carnet'];
		$cedula=$_POST['cedula'];
		$id_visitante_h=$_POST['id_visitante_h'];

		/*Autorizacion datos*/
		$autorizacion_nombre=$_POST['autorizacion_nombre'];
		$codper=$_POST['codper'];
		$cedper=$_POST['cedper'];
		$nomper=$_POST['nomper'];
		$apeper=$_POST['apeper'];
		$codemp=$_POST['codemp'];
		$minorguniadm=$_POST['minorguniadm'];
		$ofiuniadm=$_POST['ofiuniadm'];
		$uniuniadm=$_POST['uniuniadm'];
		$depuniadm=$_POST['depuniadm'];
		$prouniadm=$_POST['prouniadm'];
		$desuniadm=$_POST['desuniadm'];
	
		$sql_c = "select * from visitantes where cedula='$cedula'"; 
		$sql_c=sql_c($sql_c);
		$conteo_visitantes_c=@mysql_num_rows($sql_c);
	
		if ($conteo_visitantes_c==1) //Corregir a Futuro y optimizar con updates
			{
			//Tabla visitantes		
			$tabla="visitantes";
			$where="where cedula='$cedula'";
			$id_registro=$cedula;
			$arreglo_campos_v = Array ('id_visitante_t');/*Nombre de los Campos en las Tabla Correspondiente de MYSQL*/
			$arreglo_variables_v= Array ('id_visitante_t'); /*Nombre de la Variables en el Formulario*/
			$error="actualizar Visitante";
	
			historial_m($tabla, $where, $id_registro, $arreglo_campos_v, $arreglo_variables_v, $error, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
			$mensaje=1;
			//$dato="Correspondencia Actualizada";
			//$url_origen="sca_correspondencia_c.php";
			}

		//Tabla visitantes_h
		$tabla="visitantes_h";
		$where="where id_visitante_h='$id_visitante_h'";
		$id_registro=$id_visitante_h;
		$arreglo_campos_v = Array ('cod_procedencia', 'procedencia', 'id_asunto', 'cod_emisor', 'emisor', 'observacion');/*Nombre de los Campos en las Tabla Correspondiente de MYSQL*/
		$arreglo_variables_v= Array ('cod_procedencia', 'procedencia', 'id_asunto', 'cod_emisor', 'emisor', 'observacion'); /*Nombre de la Variables en el Formulario*/
		$error="actualizar Visitantes Detalles";
		historial_m($tabla, $where, $id_registro, $arreglo_campos_v, $arreglo_variables_v, $error, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);

		//Tabla visitantes_a
		$tabla="visitantes_a";
		$sql="insert into $tabla (id_visitante_h, codemp, autorizacion_nombre, codper, cedper, nomper, apeper, minorguniadm, ofiuniadm, uniuniadm, prouniadm, depuniadm, desuniadm) values ('$id_visitante_h', '$codemp', '$autorizacion_nombre', '$codper', '$cedper', '$nomper', '$apeper', '$minorguniadm', '$ofiuniadm', '$uniuniadm', '$prouniadm', '$depuniadm', '$desuniadm')";
		$error="incluir visitante_a";
		sql($sql, $error);
		//$id_registro="$id_visitante_h";
		$campo="Inclusión de visitantes_a";
		$contenido=addslashes($sql);
		historial($id_registro, $tabla, $contenido, $campo, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);

		$mensaje=1;
		$dato="Visitante Incluido";
		header("location: sca_visitante_c.php?mensaje=$mensaje&dato=$dato");
	break;

	case "x":
		//Destruccion de las sesiones
//		session_start();
		unset($_SESSION['sca_id_u_activo']);
		unset($_SESSION['sca_id_tipo_u_menu']);	
		unset($_SESSION['sca_nombre_u']);
		unset($_SESSION['sca_apellido_u']);
//		session_destroy();	
		$url_case='http://'. $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) .'/';//Captacion del URL del Servidor
		header("location: $url_case");
		//header("location: index.php"); //Regresamos con mensaje de Sesiones Destruidas //Corregir a futuro con el enlace correcto
	break;
	}
?>
