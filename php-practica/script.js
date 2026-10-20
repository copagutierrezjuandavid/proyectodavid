/* =========================================================
   Lavado de Autos Apaza
   Función: seleccionar, detectar y ejecutar
   ========================================================= */
/*Cambiar el tema de la pagina de claro a oscuro*/
const raiz = document.documentElement;
const botonTema = document.querySelector("#boton-tema");

function aplicarTema(tema) {
  if (tema === "oscuro") {
    raiz.setAttribute("data-tema", "oscuro");
    botonTema.textContent = "☀️ Modo claro";
    botonTema.setAttribute("aria-pressed", "true");
  } else {
    raiz.removeAttribute("data-tema");
    botonTema.textContent = "🌙 Modo oscuro";
    botonTema.setAttribute("aria-pressed", "false");
  }
}
// Elegimos el tema que se mostrara al abrir la pagina.
let temaInicial = "claro";
try {
  const guardado = localStorage.getItem("tema-apaza");
  if (guardado === "oscuro" || guardado === "claro") {
    temaInicial = guardado;
  } else if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
    temaInicial = "oscuro";
  }
} catch (error) {
// Si no se puede guardar el tema la pagina sigue funcionando.
}
aplicarTema(temaInicial);

function cambiarTema() {
  const nuevoTema = raiz.getAttribute("data-tema") === "oscuro" ? "claro" : "oscuro";
  aplicarTema(nuevoTema);
  try {
    localStorage.setItem("tema-apaza", nuevoTema);
  } catch (error) {
    // Si no se guarda el tema, el botón sigue funcionando.
  }
}

botonTema.addEventListener("click", cambiarTema);

/* FORMULARIO DE CONTACTO */
const formularioContacto = document.querySelector("#form-contacto");
const avisoContacto = document.querySelector("#aviso-contacto");
const campoNombre = document.querySelector("#nombre");
const campoCorreo = document.querySelector("#correo");
const campoTelefono = document.querySelector("#telefono");
const campoServicio = document.querySelector("#servicio");

function mostrarError(mensaje, campo) {
  avisoContacto.textContent = mensaje;
  avisoContacto.classList.add("error");
  avisoContacto.classList.remove("exito");
  campoNombre.classList.remove("campo-error");
  campoCorreo.classList.remove("campo-error");
  campoTelefono.classList.remove("campo-error");
  campo.classList.add("campo-error");
  campo.focus();
}

function soloNumeros(texto) {
  for (const caracter of texto) {
    if (caracter < "0" || caracter > "9") {
      return false;
    }
  }
  return true;
}

function revisarContacto(event) {
 // Evitamos que la página se recargue al enviar el formulario.
  event.preventDefault();

  const nombre = campoNombre.value.trim();
  const correo = campoCorreo.value.trim();
  const telefono = campoTelefono.value.trim();
  const servicio = campoServicio.value;

  if (nombre === "") {
    mostrarError("Falta tu nombre: escribe tu nombre y apellido para poder atenderte.", campoNombre);
  } else if (nombre.length < 3) {
    mostrarError("Tu nombre es muy corto: escribe al menos 3 letras.", campoNombre);
  } else if (correo === "") {
    mostrarError("Falta tu correo: escríbelo para poder responderte.", campoCorreo);
  } else if (correo.includes("@") === false) {
    mostrarError("Ese correo no parece correo: le falta el @. Ejemplo: tunombre@gmail.com", campoCorreo);
  } else if (correo.indexOf("@") === 0 || correo.indexOf("@") === correo.length - 1) {
    mostrarError("Ese correo está incompleto: debe haber texto antes y después del @.", campoCorreo);
  } else if (telefono === "") {
    mostrarError("Falta tu teléfono: lo usamos para confirmar tu cita.", campoTelefono);
  } else if (soloNumeros(telefono) === false) {
    mostrarError("Tu teléfono solo debe tener números, sin espacios ni letras. Ejemplo: 61659011", campoTelefono);
  } else if (telefono.length < 7 || telefono.length > 8) {
    mostrarError("Tu teléfono debe tener 7 u 8 dígitos. Escribiste " + telefono.length + ".", campoTelefono);
  } else {
    //Enviamos el formulario si todos los datos son correctos.
    formularioContacto.submit();
  }
}
// Revisamos los datos cuando el usuario envía el formulario.
formularioContacto.addEventListener("submit", revisarContacto);