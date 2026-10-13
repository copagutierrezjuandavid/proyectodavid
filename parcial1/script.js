function confirmarEncargo() {
  const mensaje = document.querySelector("#mensaje");
  mensaje.textContent = "Encargo recibido - te atiende Juan David Copa Gutierrez";
  mensaje.classList.remove("oculto");
}

const boton = document.querySelector("#btn-confirmar");
boton.addEventListener("click", confirmarEncargo);
