const url = "../../controllers/prestamista.controller.php";
let tbl_Transferencias = "";

const listarTransferencias = async () => {
  tbl_Transferencias = await $("#tbl_Transferencias").DataTable({
    destroy: true,
    autoWidth: false,
    responsive: true,
    ajax: {
      method: "GET",
      url: `${url}?accion=transferencias`,
      dataType: "json",
      contentType: "application/json; charset=utf-8",
      dataSrc: "data",
    },
    columns: [
      { data: "numTransferencia" },
      { data: "fechaTransferencia" },
      {
        data: "montoTransferencia",
        render: function (data) {
          return `${data.toLocaleString("en", {
            style: "currency",
            currency: "USD",
          })}`;
        },
      },
      { data: "cuentaDestino" },
      { data: "conceptoTransferencia" },
      { data: "numCuenta" },
    ],
    lengthMenu: [
      [5, 10, 15, 20, -1],
      [5, 10, 15, 20, "Todos"],
    ],
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json",
    },
  });
};