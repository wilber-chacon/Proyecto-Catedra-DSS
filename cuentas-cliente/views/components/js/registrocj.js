const url = "../../controllers/CajeroController.php";

const registrarCliente = async () => {
  const { ok, mensaje } = await fetch(`${url}?operacion=registrarC`, {
    method: "POST",
    body: new FormData($("#form-register")[0]),
  }).then((res) => res.json());

  if (ok) {
    return sweetAlert("¡Exito!", mensaje, "success").then(() => {
      window.location.href = "./administrar_clientes.php";
    });
  } else {
    return sweetAlert("¡Error!", mensaje, "error");
  }
};

$("#btn-register").click(async (e) => {
  e.preventDefault();
  await registrarCliente();
});



const crearCuenta = async () => {
  const { ok, mensaje } = await fetch(`${url}?operacion=crearC`, {
    method: "POST",
    body: new FormData($("#form-register")[0]),
  }).then((res) => res.json());

  if (ok) {
    return sweetAlert("¡Exito!", mensaje, "success").then(() => {
      window.location.href = "./crearCuenta.php";
    });
  } else {
    return sweetAlert("¡Error!", mensaje, "error");
  }
};

$("#btn-crear-cuenta").click(async (e) => {
  e.preventDefault();
  await crearCuenta();
});