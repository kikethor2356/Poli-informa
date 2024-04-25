function filterProductos(categoria, busqueda, precio, value = "") {
    // Si no se proporciona un valor, se asume que se llama desde un botón y se usa la categoría como valor
    let valor = value ? value : categoria;

    // Actualizar el estado de los botones
    let buttons = document.querySelectorAll(".button-value");
    buttons.forEach(button => {
        button.classList.remove("active1");
        if (valor.toUpperCase() === button.innerText.toUpperCase()) {
            button.classList.add("active1");
        }
    });
    

    // Realizar la búsqueda mediante AJAX
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let productosContainer = document.getElementById("productos");
                if (xhr.responseText.trim() === "") {
                    productosContainer.innerHTML = "<p>No se encontraron resultados de la búsqueda.</p>";
                } else {
                    productosContainer.innerHTML = xhr.responseText;
                }
            } else {
                console.error('Hubo un problema con la solicitud.');
            }
        }
    };

    // Configurar y enviar la solicitud AJAX
    let url = `getProductos.php?categoria=${encodeURIComponent(categoria)}&search=${encodeURIComponent(busqueda)}&price=${encodeURIComponent(precio)}`;
    xhr.open("GET", url, true);
    xhr.send();
}

// document.addEventListener("DOMContentLoaded", function () {
//     // Llamar a filterProductos al cargar la página para mostrar todos los productos
//     filterProductos('Todo', '');

//     let searchInput = document.getElementById("search-input");
//     let priceInput = document.getElementById("price-input");

//     // Agregar evento de input al campo de búsqueda
//     searchInput.addEventListener("input", function () {
//         let searchValue = searchInput.value.trim();
//         filterProductos('Todo', searchValue); // Filtrar por categoría "Todo" y término de búsqueda
//     });

//     // Agregar evento de input al campo de precio
//     priceInput.addEventListener("input", function () {
//         let priceValue = priceInput.value.trim();
//         filterProductos('Todo', '', priceValue); // Filtrar por categoría "Todo" y precio
//     });

//     // Asignar eventos a los botones de categoría
//     let buttons = document.querySelectorAll(".button-value");
//     buttons.forEach(button => {
//         button.addEventListener("click", function () {
//             let categoria = this.innerText.trim();
//             // Limpiar el campo de búsqueda
//             searchInput.value = "";
//             priceInput.value = "";
//             filterProductos(categoria, ""); // Filtrar por categoría y sin término de búsqueda
//         });
//     });
// });

document.addEventListener("DOMContentLoaded", function () {
    // Llamar a filterProductos al cargar la página para mostrar todos los productos
    filterProductos('Todo', '');

    let searchInput = document.getElementById("search-input");
    let priceInput = document.getElementById("price-input");
    let priceButton = document.getElementById("search-button"); // Obtener el botón de búsqueda por precio

    // Agregar evento de input al campo de búsqueda
    searchInput.addEventListener("input", function () {
        let searchValue = searchInput.value.trim();
        filterProductos('Todo', searchValue); // Filtrar por categoría "Todo" y término de búsqueda
    });

    // Agregar evento clic al botón de búsqueda por precio
    priceButton.addEventListener("click", function () {
        let priceValue = priceInput.value.trim();
        filterProductos('Todo', '', priceValue); // Filtrar por categoría "Todo" y precio
    });

     // Evento de cambio en el campo de precio para limpiar el campo de búsqueda
     priceInput.addEventListener("input", function() {
        searchInput.value = ''; // Limpiar el campo de búsqueda cuando se cambia el precio
    });

    // Evento de cambio en el campo de búsqueda para limpiar el campo de precio
    searchInput.addEventListener("input", function() {
        priceInput.value = ''; // Limpiar el campo de precio cuando se cambia la búsqueda
    });

    // Asignar eventos a los botones de categoría
    let buttons = document.querySelectorAll(".button-value");
    buttons.forEach(button => {
        button.addEventListener("click", function() {
            let categoria = this.innerText.trim();
            // Limpiar el campo de búsqueda
            searchInput.value = "";
            priceInput.value = "";
            filterProductos(categoria, ""); // Filtrar por categoría y sin término de búsqueda
        });
    });

    // Agregar un evento de tecla presionada al campo de precio
    priceInput.addEventListener("keypress", function(event) {
        if (event.key === "Enter") { // Verificar si la tecla presionada es Enter
            let priceValue = priceInput.value.trim();
            filterProductos('Todo', '', priceValue); // Filtrar por categoría "Todo" y precio
        }
    });
});

function mostrarDetalleProducto(contenedor) {
    // Obtener la información del producto desde el atributo data-producto
    let producto = JSON.parse(contenedor.dataset.producto);

    // Construir el contenido de la ventana emergente con los detalles del producto
    let ventanaEmergente = `
        <div class="popup">
            <div class="popup-content">
                <span class="close" onclick="cerrarVentanaEmergente()">&times;</span>
                <h2>${producto.nombre_producto}</h2>
                <p>${producto.descripcion}</p>
                <h3>$${producto.precio}</h3>
                <!-- Puedes agregar más detalles aquí si es necesario -->
            </div>
        </div>
    `;

    // Agregar la ventana emergente al final del body
    document.body.insertAdjacentHTML('beforeend', ventanaEmergente);
}

// Función para cerrar la ventana emergente
function cerrarVentanaEmergente() {
    let ventanaEmergente = document.querySelector('.popup');
    ventanaEmergente.parentNode.removeChild(ventanaEmergente);
}

