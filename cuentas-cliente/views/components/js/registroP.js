const url = "../../controllers/CajeroController.php";

const buscarCliente = async () => {
  const { ok, mensaje } = await fetch(`${url}?operacion=buscarCliente`, {
    method: "POST",
    body: new FormData($("#form-register")[0]),
  }).then((res) => res.json());

  if (ok) {
    return window.location.href = "./registrarPrestamo.php?cliente="+mensaje;
  } else {
    return sweetAlert("¡Error!", mensaje, "error");
  }
};

$("#btn-buscarCliente").click(async (e) => {
  e.preventDefault();
  await buscarCliente();
});



const registrarPrestamo = async () => {
    const { ok, mensaje } = await fetch(`${url}?operacion=registrarP`, {
      method: "POST",
      body: new FormData($("#form-register")[0]),
    }).then((res) => res.json());
  
    if (ok) {
      return sweetAlert("¡Exito!", mensaje, "success").then(() => {
        window.location.href = "./registrarPrestamo.php";
      });
    } else {
      return sweetAlert("¡Error!", mensaje, "error");
    }
  };
  
  $("#btn-register").click(async (e) => {
    e.preventDefault();
    await registrarPrestamo();
  });