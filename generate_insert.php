<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los parámetros del formulario
    $totalRecords = $_POST['totalRecords'];
    $batchSize = $_POST['batchSize'];

    // Validar los valores (opcional)
    if (!is_numeric($totalRecords) || !is_numeric($batchSize) || $totalRecords <= 0 || $batchSize <= 0) {
        die("Error: Los valores ingresados no son válidos.");
    }

    // Abrir el archivo para escritura
    $file = fopen("insert_usuarios.sql", "w");

    // Escribir las instrucciones INSERT en lotes
    for ($batch = 0; $batch < ($totalRecords / $batchSize); $batch++) {
        // Escribir la cabecera de la instrucción INSERT
        fwrite($file, "INSERT INTO `crud_ci4vjs`.`usuarios` (`id`, `nombre`, `usuario`, `email`, `estatus`, `rol`, `password`, `foto`) VALUES \n");

        for ($i = 1; $i <= $batchSize; $i++) {
            $id = ($batch * $batchSize) + $i;
            $nombre = 'Nombre' . $id;
            $usuario = 'usuario' . $id;
            $email = 'usuario' . $id . '@example.com';
            $estatus = 'activo';
            $rol = ($id % 2 == 0) ? 'admin' : 'empleado';
            $password = 'password' . $id;
            $foto = 'default.jpg';

            // Crear la fila
            $row = "($id, '$nombre', '$usuario', '$email', '$estatus', '$rol', '$password', '$foto')";

            // Añadir una coma al final si no es el último registro del lote
            if ($i < $batchSize) {
                $row .= ",\n";
            } else {
                $row .= ";\n";
            }

            // Escribir la fila en el archivo
            fwrite($file, $row);
        }
    }

    // Cerrar el archivo
    fclose($file);

    echo "Archivo insert_usuarios.sql generado con éxito.";
}
?>
