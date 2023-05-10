const url = "../../controllers/CajeroController.php";

const registrarPrestamo = async () => {
    const { ok, mensaje } = await fetch(`${url}?operacion=registrarTr`, {
      method: "POST",
      body: new FormData($("#form-register")[0]),
    }).then((res) => res.json());
  
    if (ok) {
      return sweetAlert("¡Exito!", mensaje, "success").then(() => {
        window.location.href = "./transferenciaDinero.php";
      });
    } else {
      return sweetAlert("¡Error!", mensaje, "error");
    }
  };
  
  $("#btn-register").click(async (e) => {
    e.preventDefault();
    await registrarPrestamo();
  });