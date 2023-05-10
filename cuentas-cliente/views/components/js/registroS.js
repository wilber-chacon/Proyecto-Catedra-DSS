const url = "../../controllers/gerenteGeneralController.php";

const buscarCliente = async () => {
  const { ok, mensaje } = await fetch(`${url}?operacion=registrarS`, {
    method: "POST",
    body: new FormData($("#form-register")[0]),
  }).then((res) => res.json());

  if (ok) {
    return sweetAlert("¡Exito!", mensaje, "success").then(() => {
      window.location.href = "./registrarSucursal.php";
    });
    
  } else {
    return sweetAlert("¡Error!", mensaje, "error");
  }
};

$("#btn-register").click(async (e) => {
  e.preventDefault();
  await buscarCliente();
});


