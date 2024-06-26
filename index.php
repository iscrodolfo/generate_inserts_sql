<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de instrucciones INSERT</title>
    <!--Font awesome icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Generador de instrucciones INSERT SQL</h1>
                </div>
                <div class="card-body">
                    <form id="generateForm" action="generate_insert.php" method="post">
                        <div class="form-group">
                            <label for="totalRecords">Total de registros a generar:</label>
                            <input type="number" id="totalRecords" name="totalRecords" class="form-control"  placeholder="Ejemplo: 50" required>
                        </div>
                        <div class="form-group">
                            <label for="batchSize">Tamaño del lote:</label>
                            <input type="number" id="batchSize" name="batchSize" class="form-control" placeholder="Ejemplo: 10" required >
                        </div>
                        <button type="submit" class="btn btn-primary">Generar archivo SQL</button>
                    </form>
                </div>
               <a class="btn btn-success" href="instrucciones.html"  target="_blank">Instrucciones</a>
            </div>
        </div>
    </div>
</div>


<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src=" https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js "></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


<script>
    $(document).ready(function() {
        $('#generateForm').submit(function(e) {
            e.preventDefault();

            const formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: 'generate_insert.php',
                data: formData,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Archivo generado',
                        text: response,
                        showConfirmButton: false,
                        timer: 2000
                    });
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un error al generar el archivo SQL.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            });
        });
    });
</script>

</body>
</html>
