function validar() {
	var nombre = document.getElementById("nombre");
	var apePat = document.getElementById("apellido_pat");
	var apeMat = document.getElementById("apellido_mat");
	var correo = document.getElementById("correo");
	var dia = document.getElementById("dia");
	var mes = document.getElementById("mes");
	var anio = document.getElementById("anio");
	var usuario = document.getElementById("usuario");
	var contrasenia = document.getElementById("contrasenia");
	var confContra = document.getElementById("confContra");
	var contraActual = document.getElementById("contraActual");
	var expresion = /\w/;
	var expresionCorreo = /\w+@\w+\.+[a-z]/;
	var expresionPass = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/;
	var expresinousuario = /^(?=\w*[A-Z])(?=\w*[a-z])\S{1,16}$/;
	//NOMBRE
	if (nombre.value === "") {
		document.getElementById("mensajeError").innerHTML = "Nombre vacío.";
		nombre.className="error2";
		nombre.focus();
		return false;
	}else if (nombre.value.length>50) {
		document.getElementById("mensajeError").innerHTML = "El nombre es muy largo. Max 50 caracteres.";
		nombre.className="error2";
		nombre.focus();
		return false;
	}
	//APELLIDO PATERNO
	if (apePat.value === "") {
		document.getElementById("mensajeError").innerHTML = "Apellido paterno vacío.";
		apePat.className="error2";
		apePat.focus();
		return false;
	}
	else if (apePat.value.length>20) {
		document.getElementById("mensajeError").innerHTML = "El apellido paterno es muy largo. Max 20 caracteres.";
		apePat.className="error2";
		apePat.focus();
		return false;
	}
	//APELLIDO MATERNO
	if (apeMat.value === "") {
		document.getElementById("mensajeError").innerHTML = "Apellido materno vacío.";
		apeMat.className="error2";
		apeMat.focus();
		return false;
	}
	else if (apeMat.value.length>20) {
		document.getElementById("mensajeError").innerHTML = "El apellido materno es muy largo. Max 20 caracteres.";
		apeMat.className="error2";
		apeMat.focus();
		return false;
	}
	//DIA
	if (dia.value === "") {
		document.getElementById("mensajeError").innerHTML = "Día invalido.";
		dia.className="error2";
		dia.focus();
		return false;
	}
	//MES
	if (mes.value === "") {
		document.getElementById("mensajeError").innerHTML = "Mes invalido.";
		mes.className="error2";
		mes.focus();
		return false;
	}
	//AÑO
	if (anio.value === "") {
		document.getElementById("mensajeError").innerHTML = "Año invalido.";
		anio.className="error2";
		anio.focus();
		return false;
	}
	//CORREO
	if (correo.value === "") {
		document.getElementById("mensajeError").innerHTML = "Correo invalido.";
		correo.className="error2";
		correo.focus();
		return false;
	}
	else if (correo.value.length>50) {
		document.getElementById("mensajeError").innerHTML = "El correo es muy largo. Max 50 caracteres.";
		correo.className="error2";
		correo.focus();
		return false;
	}
	else if (!expresionCorreo.test(correo.value)) {
		document.getElementById("mensajeError").innerHTML = "Debe ser un correo válido.";
		correo.className="error2";
		correo.focus();
		return false;
	}
	//USUARIO
	if (usuario.value ==="") {
		document.getElementById("mensajeError").innerHTML = "Usuario vacío.";
		usuario.className="error2";
		usuario.focus();
		return false;
	}
	else if (!expresinousuario.test(usuario.value)) {
		document.getElementById("mensajeError").innerHTML = "Mínimo una mayúscula y una minúscula. Max 16 caracteres. Sin espacios";
		usuario.className="error2";
		usuario.focus();
		return false;
	}
	//CONTRASEÑA
	if (contrasenia.value ==="") {
		document.getElementById("mensajeError").innerHTML = "Contraseña vacía.";
		contrasenia.className="error2";
		contrasenia.focus();
		return false;
	}
	else if (contrasenia.value.length<8) {
		document.getElementById("mensajeError").innerHTML = "Contraseña muy corta. Min 8 caracteres para ser una contraseña segura.";
		contrasenia.className="error2";
		contrasenia.focus();
		return false;
	}
	else if (!expresionPass.test(contrasenia.value)) {
		document.getElementById("mensajeError").innerHTML = "La contraseña debe tener mínimo 8 caracteres y un máximo de 16 caracteres, 1 mayúscula, 1 minúscula, 1 número y no debe contener espacios.";
		contrasenia.className="error2";
		contrasenia.focus();
		return false;
	}
	//CONFIRMAR CONTRASEÑA
	if (confContra.value ==="") {
		document.getElementById("mensajeError").innerHTML = "Confirmar contraseña vacío.";
		confContra.className="error2";
		confContra.focus();
		return false;
	}
	else if (!expresionPass.test(confContra.value)) {
		document.getElementById("mensajeError").innerHTML = "La contraseña debe tener mínimo 8 caracteres y un máximo de 16 caracteres, 1 mayúscula, 1 minúscula, 1 número y no debe contener espacios.";
		confContra.className="error2";
		confContra.focus();
		return false;
	}
	//VALIDAR LAS CONTRASEÑAS
	if(contrasenia.value != confContra.value){
		document.getElementById("mensajeError").innerHTML = "Las contraseñas no coinciden.";
		contrasenia.className="error2";
		contrasenia.focus();
		return false;
	}
	//NUEVA CONTRASEÑA
	if (contraActual.value ==="") {
		document.getElementById("mensajeError").innerHTML = "Contraseña actual vacía.";
		contraActual.className="error2";
		contraActual.focus();
		return false;
	}else if (!expresionPass.test(contraActual.value)) {
		document.getElementById("mensajeError").innerHTML = "La contraseña debe tener mínimo 8 caracteres y un máximo de 16 caracteres, 1 mayúscula, 1 minúscula, 1 número y no debe contener espacios.";
		contraActual.className="error2";
		contraActual.focus();
		return false;
	}
}
function borrarError(id){
	var elemento = document.getElementById(id);
	if (elemento.value ==="") {
		var texto = document.getElementById("mensajeError").innerHTML = "Campo vacío.";
		elemento.className="error2";
	}
	else{
		var texto = document.getElementById("mensajeError").innerHTML = "";
		elemento.classList.remove("error2");
	}
}
