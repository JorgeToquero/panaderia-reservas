
// Función para validar que un campo no esté vacío
function validarVacio(valor, mensaje) {
    if (valor == '') {
        alert(mensaje);
        return false;
    }
    return true;
}

// Función para validar el formato del email
function validarEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("El email no es válido");
        return false;
    }
    return true;
}
  
// Comprobar cada formulario para coger uno u otro
    const form = document.getElementById('formLogin');
    if (form) {
        // Escuchamos el evento submit del formulario de login
        form.addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;  // Obtenemos el valor del campo email
            const pass = document.getElementById('pass').value;    // Obtenemos el valor del campo contraseña

       // Comprobamos que el email no esté vacío
            if (!validarVacio(email, 'El email no puede estar vacío')) {
                e.preventDefault();
            }
       // Comprobamos que el email tenga formato válido
            if (!validarEmail(email)) {
                e.preventDefault();
            }
       // Comprobamos que la contraseña no esté vacía    
            if (!validarVacio(pass, 'La contraseña no puede estar vacía')) {
                e.preventDefault();
            }
       // Comprobamos que la contraseña tenga mínimo 6 caracteres     
            if (pass.length < 6) {
                alert("La contraseña no puede ser inferior a seis caracteres");
                e.preventDefault();
            }
        });
    }

    const formRegistro = document.getElementById('formRegistro');
    if (formRegistro) {

        // Escuchamos el evento submit del formulario de registro
        formRegistro.addEventListener('submit', function(e) {
            const nombre = document.getElementById('nombre').value;
            const email = document.getElementById('email').value;
            const pass = document.getElementById('pass').value;
        // Comprobamos que el nombre no este vacio
            if (!validarVacio(nombre, 'El nombre no puede estar vacío')) {
                e.preventDefault();
            }
        // Comprobamos que el email no este vacio    
            if (!validarVacio(email, 'El email no puede estar vacío')) {
                e.preventDefault();
            }
        // Comprobamos que el nombre no este vacio
            if (!validarEmail(email)) {
                e.preventDefault();
            }
        // Comprobamos que el email tenga formato válido
            if (!validarVacio(pass, 'La contraseña no puede estar vacía')) {
                e.preventDefault();
            }
        // Comprobamos que la contraseña tenga minimo 6 caracteres
            if (pass.length < 6) {
                alert("La contraseña no puede ser inferior a seis caracteres");
                e.preventDefault();
            }
        });
    }

    
    const formReserva = document.getElementById('formReserva');
    if (formReserva){
         // Escuchamos el evento submit del formulario de reserva

        formReserva.addEventListener('submit', function(e){
            const fecha = document.getElementById('fecha').value;
            const hoy = new Date().toISOString().split('T')[0];  // Fecha de hoy en formato YYYY-MM-DD
            const hora = document.getElementById('hora').value;
            const cantidad = document.getElementById('cantidad').value;
        // comprobamos que la fecha no sea vacia
        if (!validarVacio(fecha, 'La fecha no puede ser vacía')){
            e.preventDefault();
        }
        // comprobamos que la fecha no sea anterior a hoy
        if (fecha < hoy){
            alert("la fecha no puede ser anterior a hoy");
            e.preventDefault();
        }
        // comprobamos que la hora no sea vacia
        if (!validarVacio(hora, 'La hora no puede ser vacía')){
            e.preventDefault();
        }
        // comprobamos que la cantidad no sea vacia
        if (!validarVacio(cantidad, 'La cantidad no puede ser vacía')){
            e.preventDefault();
        }
        // comprobamos que la cantidad sea mayor que 0
        if (cantidad <= 0){
            alert("la cantidad debe ser al menos 1");
            e.preventDefault();
        }

        });
    }

    
