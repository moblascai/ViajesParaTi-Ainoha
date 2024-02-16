document.addEventListener('DOMContentLoaded', function() {
    // Obtener todos los botones de eliminar por su clase CSS
    var botonesEliminar = document.querySelectorAll('.eliminar-btn');

    // Iterar sobre cada botón de eliminar
    botonesEliminar.forEach(function(boton) {
        // Agregar un event listener para el clic en cada botón
        boton.addEventListener('click', function() {
            // Obtener el ID del proveedor desde el atributo data-id del botón
            var proveedorId = boton.dataset.id;

            // Obtener la URL de eliminación del proveedor desde el atributo data-url del botón
            var urlEliminar = boton.dataset.url;

            // Redirigir a la página de eliminación del proveedor
            window.location.href = urlEliminar;
        });
    });
});