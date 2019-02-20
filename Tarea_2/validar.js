function validar(){

var nombre, contra, email, nacimiento;
nombre = document.getElementById("nombre").value;
contra = document.getElementById("contra").value;
email = document.getElementById("email").value;
nacimiento = document.getElementById("nacimiento").value;


if(nombre ==="" || contra==="" || email===""|| nacimiento===""){
	alert("ERROR: Todos los campos del formulario son OBLIGATORIOS");
	return false;
 }
 else if(!(/^[a-zA-Z.]+$/.test(nombre))){
   alert('ERROR: Debe ingresar un nombre válido');
   return false;
 } else if(!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[-+_!@#$%^&*.,?])).+$/.test(contra))){
 	alert('ERROR: Debe ingresar una contraseña válida');
 	return false;
 }
 else if(!(/\S+@\S+\.\S+/.test(email))){
 	alert('ERROR: Debe escribir un correo válido');
  return false;
 }
}
