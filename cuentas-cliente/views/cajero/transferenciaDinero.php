<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once '../components/layout/head.php';
    if ($_SESSION['rol'] != 1) {
        header('Location: ../login_admin/');
    }
    ?>
</head>

<body>
    <?php require_once '../components/layout/nav-cajero.php'; ?>
    <div class="container mt-4 mb-4 p-5">
        <form method="post" id="form-register" class="formA p-5" style="background-color: #EEEEEE; margin: auto;">
            <h3 class="text-center m-3 mb-5">Transferencia de dinero</h3>
            <?php
            if ($_GET) {
                /* Comprobamos que ha llegado correctamente el campo 'lstError' */
                if (isset($_GET['lstError'])) { ?>

                    <div class="alert alert-danger">
                        <ul>
                            <?php
                            /* Deshacemos el trabajo hecho por 'serialize' */
                            $lista = unserialize($_GET['lstError']);
                            foreach ($lista as $er) {
                                echo ("<li>{$er}</li>");
                            }
                            ?>
                        </ul>
                    </div>
                    <?php
                }


            }

            ?>
            <div class="row m-auto">

                <div class="col-md-6 form-group">
                    <label for="numcOrigen" class="col-sm-12 col-form-label">Cuenta de origen:</label>
                    <input type="text" class="col-sm-12 form-control" name="numcOrigen" id="numcOrigen">
                </div>

                <div class="col-md-6 form-group">
                    <label for="numcDestino" class="col-sm-12 col-form-label">Cuenta destino:</label>
                    <input type="text" class="col-sm-12 form-control" name="numcDestino" id="numcDestino">
                </div>
            </div>
            <div class="row m-auto">

                <div class="col-md-6 form-group">
                    <label for="monto" class="col-sm-12 col-form-label">Monto a transferir:</label>
                    <input type="number" class="form-control" name="monto" id="monto" min="0.1" step="0.01"
                        placeholder="0.00" required>
                </div>

                <div class="col-md-6 form-group">
                    <label for="Concepto" class="col-sm-12 col-form-label">Concepto de transferencia:</label>
                    <input type="text" class="col-sm-12 form-control" name="Concepto" id="Concepto">
                </div>
            </div>


            <div class="row m-auto">
                <div class="col-md-12">
                    <input type="hidden" name="operacion" id="operacion" value="ingreso">
                    <input type="submit" id="btn-register" value="Enviar"
                        class="btn btn-success btn-sm mt-5 mb-4 btn-block" style="width: 50%; margin: auto;">
                </div>
            </div>
        </form>
    </div>

    <?php
    require_once '../components/layout/footer.php';
    require_once '../components/layout/scripts.php';
    ?>
    <script src="../components/js/registroTr.js"></script>
</body>

</html>