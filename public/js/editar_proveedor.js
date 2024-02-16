document.addEventListener('DOMContentLoaded', function() {
    // Obtener todos los botones de editar por su clase CSS
    var botonesEditar = document.querySelectorAll('.editar-btn');

    // Iterar sobre cada botón de editar
    botonesEditar.forEach(function(boton) {
        // Agregar un event listener para el clic en cada botón
        boton.addEventListener('click', function() {
            // Obtener el ID del proveedor desde el atributo data-id del botón
            var proveedorId = boton.dataset.id;

            // Obtener la URL de edición del proveedor desde el atributo data-url del botón
            var urlEditar = boton.dataset.url;

            // Redirigir a la página de edición del proveedor
            window.location.href = urlEditar;
        });
    });
});