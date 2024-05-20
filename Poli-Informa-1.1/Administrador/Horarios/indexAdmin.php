<?php
include '../LoginA/inicio.php';
include "../../Conexion/conexion.php";
include "Componentes/ComboBoxMaestros.php";
$database = new Database();
$db = $database->connect();
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <script src="script.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Poli-Informa Admin</title>
</head>

<body>
  <style>
    #productos {
      position: absolute;
      left: 0%;
      top: 0%;
      width: 100%;
      height: 100vh;
    }

    #principal-productos {
      position: absolute;
    }

    #principal-productos {
      width: 85%;
      height: 100%;
      top: 0%;
      left: 15%;
      background-color: white;
    }


    /* styles.css */

.content {
  font-family: Arial, Helvetica, sans-serif;
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  margin-top: 20%;

}

.subcontent {
  margin-top: 20px;
}

h2 {
  color: #333;
}

.btn {
  margin-top: 10px;
  background-color: #007bff;
  color: #fff;
  padding: 10px 20px;
  border: none;
  width: 100%;
  border-radius: 5px;
  cursor: pointer;
}

.btn:hover {
  background-color: #0056b3;
}

  </style>

  <div id="productos">

    <main id="principal-productos">
      <section id="section-productos">
        <?php include '../Menu/menu.html'; ?>
        <div class="content">
          <div id="añadirHor" class="subcontent">
            <h2>¿Qué horario desea encontrar?</h2>
            <form action="ControllerSearch.php" method="POST">
              <?php
              mostrarOpcionesLaboratorios($db);
              ?>
              <button class="btn" type="submit">Encontrar</button>
            </form>

          </div>
        </div>
      </section>
    </main>
  </div>


</body>

</html>