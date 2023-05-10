const url = "../../controllers/gerenteGeneralController.php";

const rechazarEmpleado = async () => {
    const { ok, mensaje } = await fetch(`${url}?operacion=rechazarE`, {
      method: "POST",
      body: new FormData($("#form-rechazar")[0]),
    }).then((res) => res.json());
  
    if (ok) {
      return sweetAlert("¡Exito!", mensaje, "success").then(() => {
        window.location.href = "./administrar_empleados.php";
      });
    } else {
      return sweetAlert("¡Error!", mensaje, "error");
    }
  };
  
  $("#btn-rechazar").click(async (e) => {
    e.preventDefault();
    await rechazarEmpleado();
  });



  const aprobarEmpleado = async () => {
    const { ok, mensaje } = await fetch(`${url}?operacion=aprobarE`, {
      method: "POST",
      body: new FormData($("#form-aprobar")[0]),
    }).then((res) => res.json());
  
    if (ok) {
      return sweetAlert("¡Exito!", mensaje, "success").then(() => {
        window.location.href = "./administrar_empleados.php";
      });
    } else {
      return sweetAlert("¡Error!", mensaje, "error");
    }
  };
  
  $("#btn-aprobar").click(async (e) => {
    e.preventDefault();
    await aprobarEmpleado();
  });