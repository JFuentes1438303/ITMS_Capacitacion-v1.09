/*Validar q solo se ingresen numeros*/
function validarNumeros(parametro) {
	if (!/^([0-9])*$/.test(parametro)) {
		return false;
	}else {
		return true;
	}
}

function validarDocumento(parametro) {
	if (parametro.length<=6 || parametro.length>11) {
		return false;
	}else {
		return true;
	}
}


function validar() {

	var formulario = document.form5;

	if (formulario.doc_rol.value == "") {
		document.getElementById("alerta").innerHTML = '<div class="alert alert-danger t_centro"><a href="" class="close" data-dismiss="alert">&times;</a>Por favor ingrese el numero de documento.</div>';
		formulario.doc_rol.value = "";
		formulario.doc_rol.focus();
		return false;
	}else if (validarNumeros(formulario.doc_rol.value) == false) {
		document.getElementById("alerta").innerHTML = '<div class="alert alert-danger t_centro"><a href="" class="close" data-dismiss="alert">&times;</a>Solo estan permitidos valores numéricos en el numero de documento.</div>';
		formulario.doc_rol.value = "";
		formulario.doc_rol.focus();
		return false;
	}else if (validarDocumento(formulario.doc_rol.value) == false) {
		document.getElementById("alerta").innerHTML = '<div class="alert alert-danger t_centro"><a href="" class="close" data-dismiss="alert">&times;</a>El numero de documento ingresado no es valido Minimo (6 caracteres) y Maximo (11 caracteres)</div>';
		formulario.doc_rol.value = "";
		formulario.doc_rol.focus();
		return false;
	}else {
		document.getElementById("alerta").innerHTML = "";
	}

	formulario.submit();

}