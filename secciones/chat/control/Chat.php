    <?php
    include_once('../../../ctrlArchivos/control/Archivero.php');
    class Chat extends Archivero
    {
        public function loadChat($token, $con)
        {
            try {
                $sql = "SELECT * FROM usuarios WHERE token = :token";
                $loadChat = $con->prepare($sql);
                $loadChat->bindParam(':token', $token);
                $loadChat->execute();
                $chat = $loadChat->fetchAll(PDO::FETCH_ASSOC);
                return $chat;
            } catch (PDOException $error) {
                echo "<h2>Error interno en el servidor</h2>";
                return false;
            }
        }
        public function listUser($con)
        {
            try {
                //code...
                session_start();
                if (!isset($_SESSION['idus'])) {
                    throw new Exception(":D ");
                }
                $userP = $_SESSION['us'];
                $idus = $_SESSION['idus'];
                $sql =
                    "SELECT id_usuarios, usuario, token, estatus, fotoPerfil 
            FROM usuarios, empleados
            WHERE id_usuarios != :idlocal  
            AND (departamento = 1 
            OR departamento = 5 
            OR departamento = 6 
            OR departamento = 11 
            OR departamento = 12) 
            ORDER BY (SELECT MAX(id_msg) 
                FROM mensajes 
                WHERE (id_recibe = usuarios.id_usuarios AND id_envia = :idlocal) 
                OR (id_envia = usuarios.id_usuarios AND id_recibe = :idlocal)
            ) DESC";
                $sentencia = $con->prepare($sql);
                $sentencia->bindParam(':idlocal', $idus);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

                if (count($resultado) > 0) {
                    foreach ($resultado as $data) {
                        $sql2 = "SELECT * FROM mensajes WHERE (id_envia = {$idus} AND id_recibe = {$data['id_usuarios']}) OR (id_recibe = {$idus} AND id_envia = {$data['id_usuarios']}) ORDER BY id_msg DESC limit 1";
                        $sent = $con->prepare($sql2);
                        $sent->execute();
                        $lastMessage = $sent->fetch(PDO::FETCH_ASSOC);

                        // seleccion de notacion de mensajes
                        $result = ($lastMessage) ? $lastMessage['msg'] : $result = 'No hay mensajes disponibles';
                        $leido = ($lastMessage && $lastMessage['leido'] == '1') ? '<i class="bi bi-check2-all" style="color:blue"></i>' : '<i class="bi bi-check2"></i>';
                        $por = ($lastMessage && $lastMessage['persona'] == $userP) ? ' <b>tú:</b> ' : '';

                        // comprobacion de opciones
                        if ($result === 'No hay mensajes disponibles') {
                            $estatusMensaje = '<span> ' . $result . '<span>';
                        } else {
                            $estatusMensaje = $leido . '<span> ' . $result . '<span>';
                        }
                        if ($data['estatus'] == 1) {
                            $conectado = '<img id="conexion" src="img/enLinea.png" width="20" alt="">';
                        } else if ($data['estatus'] == 0) {
                            $conectado = '<img id="conexion" src="img/sinLinea.png" width="20" alt="">';
                        }
                        if ($leido == '<i class="bi bi-check2"></i>' && $result != 'No hay mensajes disponibles' && $por != ' <b>tú:</b> ') {
                            $clase = ' style="font-weight: bold;"';
                        } else {
                            $clase = '';
                        }
                        //carga del listado de usuarios

    ?>
                        <div class="box-user <?php echo $clase ?>" id="box-user" data-check="<?php echo $data['token'] ?>" style="cursor: pointer">
                            <div class="box-img">
                                <img src="<?php echo $data['fotoPerfil'] ?>" alt="" width="100">
                            </div>
                            <div class="info">
                                <?php echo $data['usuario'] ?>
                                <?php echo $conectado ?>
                                <div class="mensaje-previo"><?php echo $por . $estatusMensaje ?></div>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    // si no envia el mensaje de comenzar chat
                    echo '<li></b>Aún no hay personas registradas</b><li>';
                }
            } catch (Exception $e) {
                echo $e->getMessage();   //throw $th;
            }
        }
        public function sendMessage($con, $text, $token, $doc)
        {
            session_start();
            $upgrade = new Chat();
            $sql = "SELECT id_usuarios FROM usuarios WHERE token = :token";
            $user = $con->prepare($sql);
            $user->bindParam(':token', $token);
            $user->execute();
            $id_user = $user->fetch(PDO::FETCH_ASSOC);
            $leido = 0;
            if ($doc !== null) {
                $tipo = 'archi';
                $ruta = '../archivos_Chat/';
                //invocar funcion de guardar archivo..
                $result = $upgrade->guardarArchivo($doc['name'], $doc['tmp_name'], $ruta);
                if ($result == true) {
                    // mensaje con archivo incluido
                    $sql = "INSERT INTO mensajes (id_envia, id_recibe, tipo, msg, fecha_hora, leido, persona)  VALUES (:id_envia, :id_recibe, :tipo, :msg, NOW(), :leido, :persona)";
                    $send = $con->prepare($sql);
                    $send->bindParam(':id_envia', $_SESSION['idus']);
                    $send->bindParam(':id_recibe', $id_user['id_usuarios']);
                    $send->bindParam(':tipo', $tipo);
                    $send->bindParam(':msg', $ruta);
                    $send->bindParam(':leido', $leido);
                    $send->bindParam(':persona', $_SESSION['us']);
                    $send->execute();
                    if ($text !== "") {
                        $tipo = 'msg';
                        $sql = "INSERT INTO mensajes (id_envia, id_recibe, tipo, msg, fecha_hora, leido, persona) VALUES (:id_envia, :id_recibe, :tipo, :msg, NOW(), :leido, :persona)";
                        $send = $con->prepare($sql);
                        $send->bindParam(':id_envia', $_SESSION['idus']);
                        $send->bindParam(':id_recibe', $id_user['id_usuarios']);
                        $send->bindParam(':tipo', $tipo);
                        $send->bindParam(':msg', $text);
                        $send->bindParam(':leido', $leido);
                        $send->bindParam(':persona', $_SESSION['us']);
                        $send->execute();
                    }
                } else {
                    echo $result;
                }
            } else {
                $tipo = 'msg';
                $estatus = 0;
                $sql = "INSERT INTO mensajes (id_envia, id_recibe, tipo, msg, fecha_hora, leido, persona, estatus) 
                    VALUES (:id_envia, :id_recibe, :tipo, :msg, NOW(), :leido, :persona, :estatus)";
                $send = $con->prepare($sql);
                $send->bindParam(':id_envia', $_SESSION['idus']);
                $send->bindParam(':id_recibe', $id_user['id_usuarios']);
                $send->bindParam(':tipo', $tipo);
                $send->bindParam(':msg', $text);
                $send->bindParam(':leido', $leido);
                $send->bindParam(':persona', $_SESSION['us']);
                $send->bindParam(':estatus', $estatus);
                $send->execute();
            }
        }
        public function getMessage($token, $con)
        {
            session_start();
            $sql = "SELECT * FROM usuarios WHERE token = :token";
            $loadChat = $con->prepare($sql);
            $loadChat->bindParam(':token', $token);
            $loadChat->execute();
            $chat = $loadChat->fetch(PDO::FETCH_ASSOC);
            $exit = $chat['id_usuarios'];
            $chatSelect = $con->prepare("SELECT *, DATE_FORMAT(fecha_hora, '%H:%i') AS hora_minuto FROM mensajes WHERE id_recibe = {$_SESSION['idus']} AND id_envia = {$exit} OR id_envia = {$_SESSION['idus']} AND id_recibe = {$exit} ORDER BY id_msg ASC");
            $chatSelect->execute();
            $data = $chatSelect->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        public function search($con, $text, $id)
        {
            $sql = 'SELECT u.id_usuarios, u.usuario, u.token, u.estatus, u.fotoPerfil, e.nombres, e.apellidos FROM usuarios u, empleados e WHERE u.id_usuarios = e.usuarioSistema  AND (CONCAT(e.nombres, " ", e.apellidos, " ") LIKE :text OR CONCAT(e.apellidos, " ", e.nombres, " ") LIKE :text OR usuario LIKE :text) AND u.id_usuarios <> :id';
            $load = $con->prepare($sql);
            $text = '%' . $text . '%';
            $load->bindParam(':text', $text);
            $load->bindParam(':id', $id);
            $load->execute();
            $result = $load->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        public function guardarArchivo($nombre, $archivo, $ruta)
        {
            if (is_dir($ruta)) {
                $rutaCompleta = $ruta . '/' . $nombre;
                if (file_exists($rutaCompleta)) {
                    // echo 'Error: Ya existe un archivo con el mismo nombre. Intenta con otro nombre.';
                    ?>
                    <script>
                        alert("El nombre del archivo esta repetido, intentalo de nuevo");
                    </script>
    <?php
                    return false;
                }
                if (move_uploaded_file($archivo, $rutaCompleta)) {
                    // echo 'Archivo "' . $nombre . '" guardado correctamente en ' . $ruta;
                    return true;
                } else {
                    // echo 'Error al guardar el archivo "' . $nombre . '" en la carpeta ' . $ruta;
                    return false;
                }
            } else {
                echo "la carpeta no existe";
                return false;
            }
        }
        public function notificacion($texto, $envia, $id, $con)
        {
            $sql = "UPDATE mensajes SET estatus = 1 WHERE id_msg = :id";
            $update = $con->prepare($sql);
            $update->bindParam(':id', $id);
            $update->execute();

            return '<script>
                    Push.create("Oxilive: ' . $envia . '", {
                        body: "' . $texto . '",
                        timeout: 4000,
                        icon: "../img/usuario.png",
                    })
                </script>';
        }
    }
