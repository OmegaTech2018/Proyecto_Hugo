<?php
  require_once("../sesion.php");

  $usuario=$_SESSION["usuario"];
  $nombre_pasante=$_SESSION["nombre_pasante"];
  $paciente_id=$_GET['paciente_id'];
  $nombre_paciente=$_GET['nombre_paciente'];
  $sexo=$_GET['sexo'];
  if(!isset($sistema)){
        require_once("../coneccion.php");
        $sistema=new sistema();
        $sistema->conectar();
    }
  //echo $paciente_id;
  /*QUERY CON LA QUE BUSCO AL PACIENTE EN LA BASE DE DATOS*/
  $sql_busca_paciente=sprintf("SELECT nombre, apellido_paterno,apellido_materno,edad_paciente,embarazo,recien_nacido,telefono FROM paciente WHERE paciente_id=$paciente_id AND paciente_activo=1;");
  $Nombre=$sistema->getBD($sql_busca_paciente,"nombre");
  $Ap_Paterno=$sistema->getBD($sql_busca_paciente,"apellido_paterno");
  $Ap_Materno=$sistema->getBD($sql_busca_paciente,"apellido_materno");
  $Edad_Paciente=$sistema->getBD($sql_busca_paciente,"edad_paciente");
  $Embarazo=$sistema->getBD($sql_busca_paciente,"embarazo");
  $Recien_nacido=$sistema->getBD($sql_busca_paciente,"recien_nacido");
  $Telefono=$sistema->getBD($sql_busca_paciente,"telefono");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Editar paciente</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel = "stylesheet" href = "../../Interfaces/css/main.css">
  <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <div id = "wrapper">
    <!-- Cabecera -->
    <div class="container-fluid navbar-fixed-top" id = "cabecera">
      <div class = "row">
        <div class = "col-md-1">
          <img src= "../../Interfaces/imag/neuros.jpg" height = "80" width = "100"></img>
        </div>
        <div class = "col-md-4">
          <h2>Expediente Médico Digital</h2>
          <h4>Centro de Salud San Francisco Mihualtepec</h4>
        </div>
        <div class = "col-md-7" style="position: absolute; bottom: 10px; right:15px;" align = "right">
          <div class = "row">
            <form class="form-inline" action="lista_paciente.php" method="post">
              Buscar paciente: <input class="form-control input-sm" type="text" id="busca_paciente" name="busca_paciente" 
                required="required" placeholder="Apellido Paterno">
              <input class="btn btn-danger btn-sm" type="submit" value="Buscar">
            </form>
          </div><br>
          <div class = "row">
            <button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='indexUser.html'">
              <span class="glyphicon glyphicon-home"></span> Inicio
            </button>
            <button type="button" class="btn btn-danger btn-sm" 
              onclick="window.location.href='Paciente/registro_paciente.php?opcion_nota=4'">Registrar paciente</button>
            <button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='index.php'">Cerrar sesión</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Contenido -->
    <div id = "contenido" align = "center">
      <div class = "container-fluid" >
        <header><h1><?php  echo $nombre_pasante; ?></h1></header>
        <hr>
      </div><br>
      <div class = "container">
        <div class = "row">
          <form action="modificar_paciente.php" method="Post" target="modificar_paciente">
            <input type="hidden" name="paciente_id" id="paciente_id" value="<?php echo $paciente_id; ?>">
            <p>
              <div class="form-group">
                <label for="inputName" class="col-md-4 control-label">Nombre(s):</label>
                <div class="col-md-4">
                  <input type="text" id="nombre" name="nombre" value="<?php echo $Nombre; ?>" required="required">
                </div>
              </div>
              Apellido Paterno: <input type="text" id="ap_paterno" name="ap_paterno" value="<?php echo $Ap_Paterno; ?>" required="required">
              Apellido Materno: <input type="text" id="ap_materno" name="ap_materno" value="<?php echo $Ap_Materno; ?>" required="required">
            </p>
          <p>Edad: <input type="number" id="edad" name="edad" value="<?php echo $Edad_Paciente; ?>" required="required"></p>
          <p>Embarazo: <?php echo $Embarazo; ?>
            <div class="select">
              <select name="embarazo" id="embarazo" required="">
                  <option value="" selected="selected" disabled="disabled">&nbsp;</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
              </select>
           </div>
           Recien nacido: <?php echo $Recien_nacido; ?>
           <div class="select">
            <select name="recien_nacido" id="recien_nacido" required="">
                <option value="" selected="selected" disabled="disabled">&nbsp;</option>
                <option value="Si">Si</option>
                <option value="No">No</option>
            </select>
          </div>
          </p>
          <p>Tel&eacute;fono: <input type="text" id="telefono" name="telefono" value="<?php echo $Telefono; ?>"></p>
          <br><br>
          <input type="submit" value="Modificar paciente">
          </form>
          <iframe name="modificar_paciente" id="modificar_paciente" src="../../vacia.html" width="100%" height="200" frameborder="0"></iframe>
        </div>
      </div>
      <!-- Pie de página -->
      <div id = "pie">
        <div class = "container-fluid text-muted">
          <div class = "col-md-3">
            <span>
              &copy; 2017 Expediente Médico Digital<br>
              Centro de salud: San Francisco Mihualtepec<br>
              <a href = "#">Aviso de privacidad</a><br>
              Última actualización: 28 de octubre de 2017
            </span>
          </div>
          <div class = "col-md-6" align = "center">
            <span>
              <strong>Grupo de desarrollo: OmegaTech</strong><br><br>
              <ul align = "left">
              <li>Víctor Arturo Morales Díaz | <span class="glyphicon glyphicon-earphone"></span> +52 1 55 3100 0803 | <span class="glyphicon glyphicon-envelope"></span> ar2days@gmail.com</li>
              <li>David Antúnez Montoya | <span class="glyphicon glyphicon-earphone"></span> +52 1 464 100 9135 | <span class="glyphicon glyphicon-envelope"></span> xps.3000cc@gmail.com</li>
              <li>Miqueas Esli Aldama Sánchez | <span class="glyphicon glyphicon-earphone"></span> +52 1 55 6481 6752 | <span class="glyphicon glyphicon-envelope"></span> mikefantas2@gmail.com</li>
              <li>David Sánchez Nolasco | <span class="glyphicon glyphicon-earphone"></span> +52 1 55 9139 2527 | <span class="glyphicon glyphicon-envelope"></span> lci.david.sanchez.unam@gmail.com</li>
              </ul>
            </span>
          </div>
          <div class = "col-md-3" align = "center">
            <img src="../../Interfaces/imag/logoOmegaTech_v2.jpg" height = "80px" width = "80px"></img><br>
            OmegaTech
        </div>
      </div>
    </div>
    </div>
  </div>
</body>
</html>