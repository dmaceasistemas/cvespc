// <?php 
//function conectar()
//{
//	$serv = "localhost";
//	$user = "root";
//	$pass = "";
//	$mydb="sca";//Nombre de la Base de datos
//	$link = @mysql_connect($serv, $user, $pass); 
//	@mysql_select_db($mydb, $link); 
//	if (! $link)
//		{
//			$control =0;
//		}
//		else
//		{
//			$control=1;
//		}
// 	return $control;
//}
// ?>

////////////////////////////////////

<?php

function conectarpostgresql(){
	$user = 'dba';
	//$passwd = '';  password=$passwd
	$db = 'db_cvapedrocamejo_2015';

	$port = 5432;
	$host = '172.16.0.21';
	$strCnx = "host=$host port=$port dbname=$db user=$user ";
	$cnx = pg_connect($strCnx) or die ("Error de conexion. ". pg_last_error());
	echo "Conexion exitosa <hr>";
}
	
?>


//////////////////////////////////


<?php 
session_start(); 
require_once("sigesp_config.php");
require_once("shared/class_folder/class_sql.php");
require_once("cfg/class_folder/sigesp_cfg_c_empresa.php");
require_once("shared/class_folder/sigesp_include.php");
require_once("shared/class_folder/class_sql.php");
require_once("shared/class_folder/class_funciones.php");
require_once("shared/class_folder/class_mensajes.php");
$io_conect = new sigesp_include();
$msg=new class_mensajes();
//$obj = new sigesp_include();
?>
<html>
<head>
<title>Sistema de Gesti&oacute;n Administrativa - Empresa Socialista Pedro Camejo</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" language="JavaScript1.2" src="../shared/js/disabled_keys.js"></script>
<style type="text/css">
<!--

input,select,textarea,text{font-family:Tahoma, Verdana, Arial;font-size:11px;}
body {background-color: #EAEAEA; font-family: Tahoma, Verdana, Arial;	font-size: 10px;color: #000000;}
.boton{border-right:1px outset #FFFFFF;border-top:1px outset #CCCCCC;border-left:1px outset #CCCCCC;border-bottom:1px outset #FFFFFF;font-weight:bold;cursor:pointer;color: #666666;background-color:#CCCCCC;font-family: Tahoma, Verdana, Arial;	font-size: 11px;}
.pie-pagina{
	color: #898989;
	text-align: center;
	background-color: #EAEAEA;
}
.Estilo1 {color: #FF0000}
.style8 {font-size: 12px}
-->
</style>

</head>
<body bgcolor="#FFFFFF" leftmargin="0" marginwidth="0" marginheight="0">
<script language="javascript">
	if(document.all)
	{ //ie 
		document.onkeydown = function(){ 
		if(window.event && (window.event.keyCode == 122 || window.event.keyCode == 116 || window.event.ctrlKey))
		{
			window.event.keyCode = 505; 
		}
		if(window.event.keyCode == 505){ return false;} 
		} 
	}
</script>
<?php

	function uf_conectar () 
	{
		global $msg;
		if (strtoupper($_SESSION["ls_gestor"])==strtoupper("mysql"))
		{
		    $conec = @mysql_connect($_SESSION["ls_hostname"],$_SESSION["ls_login"],$_SESSION["ls_password"]);

			if($conec===false)
			{
				$msg->message("No pudo conectar con el servidor de datos,".$_SESSION["ls_hostname"]." , contacte al administrador del sistema");
				
				
			}
			else
			{
				$lb_ok=mysql_select_db(trim($_SESSION["ls_database"]),$conec);
				if (!$lb_ok)
				{
					$msg->message("No existe la base de datos ".$_SESSION["ls_database"]);					
					
				}
			}
		return $conec;
		}
		
		if(strtoupper($_SESSION["ls_gestor"])==strtoupper("postgre"))
		{
			$conec = @pg_connect("host=".$_SESSION["ls_hostname"]." port=".$_SESSION["ls_port"]."  dbname=".$_SESSION["ls_database"]." user=".$_SESSION["ls_login"]." password=".$_SESSION["ls_password"]); 
		
			if (!$conec)
			{
				$msg->message("No pudo conectar al servidor de base de datos, contacte al administrador del sistema");				
				
			}
      	 return $conec;
	    }
		
	}
	
	
	if(array_key_exists("OPERACION",$_POST))
	{
		$operacion=$_POST["OPERACION"];
		
		if ($operacion=="SELECT")
		   {
			$posicion=$_POST["cmbdb"];
											
			//Realizo la conexion a la base de datos
			if($posicion=="")
			  {
			
			  }
			else
			  {
				$_SESSION["ls_database"] = $empresa["database"][$posicion];
				$_SESSION["ls_hostname"] = $empresa["hostname"][$posicion];
				$_SESSION["ls_login"]    = $empresa["login"][$posicion];
				$_SESSION["ls_password"] = $empresa["password"][$posicion];
				$_SESSION["ls_gestor"]   = $empresa["gestor"][$posicion];	
				$_SESSION["ls_port"]     = $empresa["port"][$posicion];	
				$_SESSION["ls_width"]    = $empresa["width"][$posicion];
				$_SESSION["ls_height"]   = $empresa["height"][$posicion];	
				$_SESSION["ls_logo"]     = $empresa["logo"][$posicion];	
				$conn=uf_conectar();//Asignacion de valor a la variable $conn a traves del metodo uf_conectar de la clase sigesp_include.
				if($conn)
				{
				$io_empresa = new sigesp_cfg_c_empresa($conn);
				$obj_sql=new class_sql($conn);
				$ls_sql="SELECT * FROM sigesp_empresa ";
				$result=$obj_sql->select($ls_sql);
				if($result===false)
				{
					$msg->message("No pudo conectar a la tabla empresa en la base de datos, contacte al administrador del sistema");				
				}
				else
				{
				   if (!$row=$obj_sql->fetch_row($result))
				   {
				     $io_empresa->uf_insert_empresa();
				   }
			    }
				$result=$obj_sql->select($ls_sql);
				$li_pos=0;
				if($result===false)
				{
					
				}
				else
				{
					while ($row=$obj_sql->fetch_row($result))
				      {
					    $li_pos=$li_pos+1;
					    $la_empresa["codemp"][$li_pos]=$row["codemp"];   
					    $la_empresa["nombre"][$li_pos]=$row["nombre"];   				
				      }
				}
			 }
			}
		}
		elseif($operacion="SELEMPRESA")
		{
			
			$ls_codemp=$_POST["cmbempresa"];
			$con=uf_conectar();
			$obj_sql=new class_sql($con);
			$ls_sql="SELECT * FROM sigesp_empresa where codemp='".$ls_codemp."' ";
			$result=$obj_sql->select($ls_sql);
			$li_row=$obj_sql->num_rows($result);
			$li_pos=0;
			if($row=$obj_sql->fetch_row($result))
			{
				$la_empresa=$row;   
				$_SESSION["la_empresa"]=$la_empresa;
				$a=$_SESSION["la_empresa"];
				print "<script language=JavaScript>";
				print "location.href='sigesp_inicio_sesion.php'" ;
				print "</script>";
			}
		}
		
	}
	else
	{ 
		$operacion="";
		$arr=array_keys($_SESSION);	
		$li_count=count($arr);
		for($i=0;$i<$li_count;$i++)
		{
			$col=$arr[$i];
			unset($_SESSION["$col"]);
		}
	}
	


?>
<form name="form1" method="post" action="">
  <table width="400" height="200" border="0" align="center" cellpadding="0" cellspacing="0" background="shared/imagebank/inicio/inicio1.png">
    <tr>
      <td width="37">&nbsp;</td>
      <td width="41" height="88">&nbsp;</td>
      <td width="107">&nbsp;</td>
      <td width="164"><?php
   	$li_total = count($empresa["database"]);
    ?></td>
      <td width="51">&nbsp;</td>
    </tr>
    <tr>
      <td height="30">&nbsp;</td>
      <td rowspan="2" background="shared/imagebank/inicio/icon_base_datos.png">&nbsp;</td>
      <td><div align="left" class="style8">
        <div align="right">Base de Datos</div>
      </div></td>
      <td>
        
        <div align="right">
          <select name="cmbdb" style="width:160px " onChange="javascript:selec();">
            <option value="">Seleccione....</option>
            <?php

		for($i=1; $i <= $li_total ; $i++)
		{
			if($posicion==$i)
			{
				$selected="selected";
			}
			else
			{
				$selected="";
			}
		?>
            <option value="<?php echo $i;?>" <?php print $selected; ?>>
            <?php
				echo $empresa["database"][$i] ;
			  ?>
            </option>
            <?php
		}
		?>
          </select>
        </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
      <td><div align="right"><span class="style8">Empresa</span> </div></td>
      <td>
        
          <div align="right">
              <select name="cmbempresa" style="width:160px ">
                <option value="">Seleccione....</option>
                <?php
	if($operacion=="SELECT")
	{
		$li_total=count($la_empresa["codemp"]);
		for($i=1; $i <= $li_total ; $i++)
		{
		?>
                <option value="<?php echo $la_empresa["codemp"][$i];?>">
                <?php
				echo $la_empresa["nombre"][$i] ;
			  ?>
                </option>
                <?php
		}
	}	
	?>
              </select>
          </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="Button" type="button" value="Aceptar" onClick="javascript:uf_selempresa();">
      <input name="OPERACION" type="hidden" id="OPERACION" value="<?php $_REQUEST["OPERACION"] ?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><div align="right"></div></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <div align="center">Software Libre desarrollado por<span class="Estilo1"> SIGESP C.A.</span>  <br>
  </div>
</form>
<div class="pie-pagina">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</div>

</body>
<script language="javascript">
function selec()
{
	f=document.form1;
	f.OPERACION.value="SELECT";
	f.action="sigesp_conexion.php";
	f.submit();
}

function uf_selempresa()
{
	f=document.form1;
	empresa=f.cmbempresa.value;
	db=f.cmbdb.value;
	if(empresa=="")
	{
		if(db=="")
		{
			alert("Debe Seleccionar una base de datos");
		}
		else
		{
			alert("Debe Seleccionar la empresa");
		}
	}
	else
	{
		f.OPERACION.value="SELEMPRESA";
		f.action="sigesp_conexion.php";
		f.submit();
	}
}
</script>
</html>
