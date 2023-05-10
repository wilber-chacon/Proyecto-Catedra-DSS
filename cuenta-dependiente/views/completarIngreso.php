<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once 'components/layout/head.php'; ?>
</head>

<body>
    <?php require_once 'components/layout/nav.php'; ?>
    <div class="container mt-4 mb-4 p-5">
        <form action="../controllers/procesarAccion.php" method="post" class="formA p-5"
            style="background-color: #EEEEEE; margin: auto;">
            <h3 class="text-center m-3 mb-5">Ingreso de dinero</h3>
            <?php
            if ($_GET) {
                /* Comprobamos que ha llegado correctamente el campo 'lstError' CE211044*/
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

                if (isset($_GET['num'])) {
                    $num = $_GET['num'];
                    $saldo = $_GET['saldo'];
                }
            }

            ?>
            <div class="row m-auto">

                <div class="col-md-6 form-group">
                    <label for="numc" class="col-sm-12 col-form-label">Cuenta:</label>
                    <input type="text" class="col-sm-12 form-control" name="numc" id="numc" value="<?= $num ?>"
                        readonly>
                </div>

                <div class="col-md-6 form-group">
                    <label for="saldoc" class="col-sm-12 col-form-label">Saldo:</label>
                    <input type="text" class="col-sm-12 form-control" name="saldoc" id="saldoc" value="<?= $saldo ?>"
                        readonly>
                </div>
            </div>


            <div class="row m-auto">

                <div class="col-md-9 m-auto form-group">
                    <label for="montor" class="col-sm-12 col-form-label">Monto a depositar:</label>
                    <input type="number" class="form-control" name="montor" id="montor"  min="0.1" step="0.01"
                        placeholder="0.00" required>
                </div>

                <div class="col-md-12">
                    <input type="hidden" name="operacion" id="operacion" value="ingreso">
                    <input type="submit" value="Enviar" class="btn btn-success btn-sm mt-5 mb-4 btn-block"
                        style="width: 50%; margin: auto;">
                </div>
            </div>
        </form>
    </div>

    <?php
    require_once 'components/layout/footer.php';
    require_once 'components/layout/scripts.php';
    ?>
</body>

</html><!-- CE211044 -->