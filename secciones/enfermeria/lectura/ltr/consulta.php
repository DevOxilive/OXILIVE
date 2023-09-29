<?php 
include("../../../../connection/conexion.php");        
       //Consulta para aseguradora SHF
        // $txtID = $_GET['txtID'];
        $sentencia = $con->prepare("SELECT id_pacientes, Nombres, Apellidos, Aseguradora, id_aseguradora,  Nombre_aseguradora
        FROM pacientes_oxigeno INNER JOIN aseguradoras
        WHERE Aseguradora = 10 AND Aseguradora = id_aseguradora;");
        // $sentencia->bindParam(":id_aseguradora", $txtID);
        $sentencia->execute();
        $id_lectP = $sentencia->fetchAll(PDO::FETCH_ASSOC); 

        //Consulta para aseguradora Bienestar
        // $txtID = $_GET['txtID'];
        $sentenciaB = $con->prepare("SELECT id_pacientes, Nombres, Apellidos, Aseguradora, id_aseguradora,  Nombre_aseguradora
        FROM pacientes_oxigeno INNER JOIN aseguradoras
        WHERE Aseguradora = 9 AND Aseguradora = id_aseguradora;");
        // $sentencia->bindParam(":id_aseguradora", $txtID);
        $sentenciaB->execute();
        $id_lectB = $sentenciaB->fetchAll(PDO::FETCH_ASSOC); 

        //Consulta para aseguradora Nafi
        // $txtID = $_GET['txtID'];
        $sentenciaN = $con->prepare("SELECT id_pacientes, Nombres, Apellidos, Aseguradora, id_aseguradora,  Nombre_aseguradora
        FROM pacientes_oxigeno INNER JOIN aseguradoras
        WHERE Aseguradora = 8 AND Aseguradora = id_aseguradora;");
        // $sentencia->bindParam(":id_aseguradora", $txtID);
        $sentenciaN->execute();
        $id_lectN = $sentenciaN->fetchAll(PDO::FETCH_ASSOC); 

         //Consulta para aseguradora INDEP
        // $txtID = $_GET['txtID'];
        $sentenciaI = $con->prepare("SELECT id_pacientes, Nombres, Apellidos, Aseguradora, id_aseguradora,  Nombre_aseguradora
        FROM pacientes_oxigeno INNER JOIN aseguradoras
        WHERE Aseguradora = 7 AND Aseguradora = id_aseguradora;");
        // $sentencia->bindParam(":id_aseguradora", $txtID);
        $sentenciaI->execute();
        $id_lectI = $sentenciaI->fetchAll(PDO::FETCH_ASSOC); 

      //Consulta para aseguradora Jclyfc
        // $txtID = $_GET['txtID'];
        $sentenciaI = $con->prepare("SELECT id_pacientes, Nombres, Apellidos, Aseguradora, id_aseguradora,  Nombre_aseguradora
        FROM pacientes_oxigeno INNER JOIN aseguradoras
        WHERE Aseguradora = 6 AND Aseguradora = id_aseguradora;");
        // $sentencia->bindParam(":id_aseguradora", $txtID);
        $sentenciaI->execute();
        $id_lectJ = $sentenciaI->fetchAll(PDO::FETCH_ASSOC); 

              //Consulta para aseguradora Fonatur
        // $txtID = $_GET['txtID'];
        $sentenciaF = $con->prepare("SELECT id_pacientes, Nombres, Apellidos, Aseguradora, id_aseguradora,  Nombre_aseguradora
        FROM pacientes_oxigeno INNER JOIN aseguradoras
        WHERE Aseguradora = 4 AND Aseguradora = id_aseguradora;");
        // $sentencia->bindParam(":id_aseguradora", $txtID);
        $sentenciaF->execute();
        $id_lectF = $sentenciaF->fetchAll(PDO::FETCH_ASSOC); 

          //Consulta para aseguradora CONDUCEF
        // $txtID = $_GET['txtID'];
        $sentenciaC = $con->prepare("SELECT id_pacientes, Nombres, Apellidos, Aseguradora, id_aseguradora,  Nombre_aseguradora
        FROM pacientes_oxigeno INNER JOIN aseguradoras
        WHERE Aseguradora = 3 AND Aseguradora = id_aseguradora;");
        // $sentencia->bindParam(":id_aseguradora", $txtID);
        $sentenciaC->execute();
        $id_lectC = $sentenciaC->fetchAll(PDO::FETCH_ASSOC); 

         //Consulta para aseguradora HSBC
        // $txtID = $_GET['txtID'];
        $sentenciaH = $con->prepare("SELECT id_pacientes, Nombres, Apellidos, Aseguradora, id_aseguradora,  Nombre_aseguradora
        FROM pacientes_oxigeno INNER JOIN aseguradoras
        WHERE Aseguradora = 2 AND Aseguradora = id_aseguradora;");
        // $sentencia->bindParam(":id_aseguradora", $txtID);
        $sentenciaH->execute();
        $id_lectH = $sentenciaH->fetchAll(PDO::FETCH_ASSOC); 

                  //Consulta para aseguradora HSBC
        // $txtID = $_GET['txtID'];
        $sentenciaS = $con->prepare("SELECT id_pacientes, Nombres, Apellidos, Aseguradora, id_aseguradora,  Nombre_aseguradora
        FROM pacientes_oxigeno INNER JOIN aseguradoras
        WHERE Aseguradora = 1 AND Aseguradora = id_aseguradora;");
        // $sentencia->bindParam(":id_aseguradora", $txtID);
        $sentenciaS->execute();
        $id_lectS = $sentenciaS->fetchAll(PDO::FETCH_ASSOC); 
?>
