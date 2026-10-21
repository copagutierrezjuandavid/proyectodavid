/* Comprobamos los datos del cliente antes de enviar su pedido */

const NOMBRE_COMPLETO = "Juan David Copa Gutierrez";

// Seleccionamos el formulario y el aviso
const formulario = document.querySelector("#form-horno");
const aviso = document.querySelector("#aviso-horno");

function validarPedido(event) {
  // Leemos los valores de los campos
  const nombre = document.querySelector("#nombre").value.trim();
  const correo = document.querySelector("#correo").value.trim();

  if (nombre === "" || correo === "") {
    // Caso 1: faltan datos  detenemos el envo
    event.preventDefault();
    aviso.textContent = "Sin tu nombre y tu correo no anotamos el pedido.";
    aviso.classList.add("error");
    aviso.classList.remove("exito");
  } else if (correo.includes("@") === false) {
    // Caso 2: correo sin arroba  detenemos el envio
    event.preventDefault();
    aviso.textContent = "A ese correo le falta el arroba - corregilo antes de enviar.";
    aviso.classList.add("error");
    aviso.classList.remove("exito");
  } else {
    // Caso 3: todo correcto  NO se detiene el envio se abre procesar.php
    aviso.textContent = "Pedido tomado - te atiende " + NOMBRE_COMPLETO;
    aviso.classList.add("exito");
    aviso.classList.remove("error");
  }
}

formulario.addEventListener("submit", validarPedido);

