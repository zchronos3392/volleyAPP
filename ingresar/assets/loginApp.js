function deleteAlertMsg(id) {
  const alertMsg = document.getElementById(id);
  alertMsg.remove();
}

function checkControl(e) {
  const dni = document.querySelector("#dni").value;
  const nroSocio = document.querySelector("#nro-socio").value;

  if (dni === '' || nroSocio === '') {
    const alertMsg = document.createElement("div");
    const parentChild = document.querySelector("#form-div");
    const firstChild = parentChild.firstElementChild;

    alertMsg.className = "alert alert-danger";
    alertMsg.id = "alertMsg";
    alertMsg.innerText = "Error: Ingrese números en ambos campos";
    alertMsg.setAttribute("role", "alert");

    parentChild.insertBefore(alertMsg, firstChild);
    setTimeout(deleteAlertMsg("alertMsg"), 1500);
  }
}

// function checkControl2(e) {

// }

document.querySelector('#sign-in').addEventListener('click', checkControl);
// document.querySelector('#sign-up').addEventListener('click', checkControl2);
