const url = "../../controllers/CajeroController.php";

const registrarCliente = async () => {
  const { ok, mensaje } = await fetch(`${url}?operacion=registrard`, {
    method: "POST",
    body: new FormData($("#form-register")[0]),
  }).then((res) => res.json());

  if (ok) {
    return sweetAlert("¡Exito!", mensaje, "success").then(() => {
      window.location.href = "./administrar_dependientes.php";
    });
  } else {
    return sweetAlert("¡Error!", mensaje, "error");
  }
};

$("#btn-register").click(async (e) => {
  e.preventDefault();
  await registrarCliente();
});