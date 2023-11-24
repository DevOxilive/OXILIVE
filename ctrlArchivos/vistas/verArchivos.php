<?php
$sql = "SELECT doc.id_doc, dir.directorio, doc.nombre as document , doc.responsable, usu.nombre
        FROM documentos AS doc INNER JOIN usuarios AS usu, directorios AS dir 
        WHERE doc.directorio = dir.id_directorio AND usu.id_usuario = doc.responsable
        ORDER BY id_doc DESC;";
$stmt = $db->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);