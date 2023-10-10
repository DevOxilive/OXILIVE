<?php
$sentencia=$con->prepare("SELECT * FROM administradora");
$sentencia->execute();
$lis_admi=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia=$con->prepare("SELECT * FROM cpts_administradora");
$sentencia->execute();
$delate_cpt=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia=$con->prepare("
SELECT C.*, A.Nombre_administradora
FROM cpts_administradora C
JOIN administradora A ON A.id_administradora = C.admi
; ");
$sentencia->execute();
$lista_cpts_admi=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//Esta consulta es para eliminar Todos los cpts
$sentencia=$con->prepare(" (
    SELECT id_cpt, cpt, admi, administradora.id_administradora, administradora.Nombre_administradora
    FROM cpts_administradora
    JOIN administradora ON cpts_administradora.admi = administradora.id_administradora
    WHERE admi = 1
    ORDER BY cpt, Nombre_administradora, id_administradora
    LIMIT 1
)
UNION ALL
(
    SELECT id_cpt, cpt, admi, administradora.id_administradora, administradora.Nombre_administradora
    FROM cpts_administradora
    JOIN administradora ON cpts_administradora.admi = administradora.id_administradora
    WHERE admi = 2
    ORDER BY cpt, Nombre_administradora, id_administradora
    LIMIT 1
)
UNION ALL
(
    SELECT id_cpt, cpt, admi, administradora.id_administradora, administradora.Nombre_administradora
    FROM cpts_administradora
    JOIN administradora ON cpts_administradora.admi = administradora.id_administradora
    WHERE admi = 3
    ORDER BY cpt, Nombre_administradora, id_administradora
    LIMIT 1
)
UNION ALL
(
    SELECT id_cpt, cpt, admi, administradora.id_administradora, administradora.Nombre_administradora
    FROM cpts_administradora
    JOIN administradora ON cpts_administradora.admi = administradora.id_administradora
    WHERE admi = 4
    ORDER BY cpt, Nombre_administradora, id_administradora
    LIMIT 1
)
UNION ALL
(
    SELECT id_cpt, cpt, admi, administradora.id_administradora, administradora.Nombre_administradora
    FROM cpts_administradora
    JOIN administradora ON cpts_administradora.admi = administradora.id_administradora
    WHERE admi = 5
    ORDER BY cpt, Nombre_administradora, id_administradora
    LIMIT 1
)
UNION ALL
(
    SELECT id_cpt, cpt, admi, administradora.id_administradora, administradora.Nombre_administradora
    FROM cpts_administradora
    JOIN administradora ON cpts_administradora.admi = administradora.id_administradora
    WHERE admi = 6
    ORDER BY cpt, Nombre_administradora, id_administradora
    LIMIT 1
); ");
$sentencia->execute();
$lista_delate=$sentencia->fetchAll(PDO::FETCH_ASSOC);


?>