<?php
$sentencia=$con->prepare("SELECT * FROM administradora");
$sentencia->execute();
$lis_admi=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia=$con->prepare("SELECT * FROM codigo_administradora");
$sentencia->execute();
$delate_codigo=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia=$con->prepare("
SELECT C.*, A.Nombre_administradora
FROM codigo_administradora C
JOIN administradora A ON A.id_administradora = C.admi
; ");
$sentencia->execute();
$lista_codigo_admi=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//Esta consulta es para eliminar Todos los códigos
$sentencia=$con->prepare(" (
    SELECT id_codigo, codigo, admi, administradora.id_administradora, administradora.Nombre_administradora
    FROM codigo_administradora
    JOIN administradora ON codigo_administradora.admi = administradora.id_administradora
    WHERE admi = 1
    ORDER BY codigo, Nombre_administradora, id_administradora
    LIMIT 1
)
UNION ALL
(
    SELECT id_codigo, codigo, admi, administradora.id_administradora, administradora.Nombre_administradora
    FROM codigo_administradora
    JOIN administradora ON codigo_administradora.admi = administradora.id_administradora
    WHERE admi = 2
    ORDER BY codigo, Nombre_administradora, id_administradora
    LIMIT 1
)
UNION ALL
(
    SELECT id_codigo, codigo, admi, administradora.id_administradora, administradora.Nombre_administradora
    FROM codigo_administradora
    JOIN administradora ON codigo_administradora.admi = administradora.id_administradora
    WHERE admi = 3
    ORDER BY codigo, Nombre_administradora, id_administradora
    LIMIT 1
)
UNION ALL
(
    SELECT id_codigo, codigo, admi, administradora.id_administradora, administradora.Nombre_administradora
    FROM codigo_administradora
    JOIN administradora ON codigo_administradora.admi = administradora.id_administradora
    WHERE admi = 4
    ORDER BY codigo, Nombre_administradora, id_administradora
    LIMIT 1
)
UNION ALL
(
    SELECT id_codigo, codigo, admi, administradora.id_administradora, administradora.Nombre_administradora
    FROM codigo_administradora
    JOIN administradora ON codigo_administradora.admi = administradora.id_administradora
    WHERE admi = 5
    ORDER BY codigo, Nombre_administradora, id_administradora
    LIMIT 1
)
UNION ALL
(
    SELECT id_codigo, codigo, admi, administradora.id_administradora, administradora.Nombre_administradora
    FROM codigo_administradora
    JOIN administradora ON codigo_administradora.admi = administradora.id_administradora
    WHERE admi = 6
    ORDER BY codigo, Nombre_administradora, id_administradora
    LIMIT 1
); ");
$sentencia->execute();
$lista_delate=$sentencia->fetchAll(PDO::FETCH_ASSOC);


?>