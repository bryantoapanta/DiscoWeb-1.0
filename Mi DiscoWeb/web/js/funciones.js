/**
 * Funciones auxiliares de javascripts
 */
function confirmarBorrar(nombre, id) {
	if (confirm("¿Quieres eliminar el usuario:  " + nombre + "?")) {
		document.location.href = "?orden=Borrar&id=" + id;
	}
}

function verUsuarios() {
	if (confirm("¿Quieres volver atrás?")) {
		document.location.href = "?orden=VerUsuarios";
	}
}

function cerrarSesion() {
	document.location.href = "?orden=Cerrar";
}

function altaUsuario() {
	document.location.href = "?orden=Alta";
}