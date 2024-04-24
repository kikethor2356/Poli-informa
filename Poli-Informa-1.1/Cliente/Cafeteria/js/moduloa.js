function filterProductos(categoria, busqueda, value = "") {
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
                    productosContainer.innerHTML = "<p>No chingues pendejo busca algo bien.</p>";
                } else {
                    productosContainer.innerHTML = xhr.responseText;
                }
            } else {
                console.error('Hubo un problema con la solicitud.');
            }
        }
    };

    // Configurar y enviar la solicitud AJAX
    xhr.open("GET", "getProductos.php?categoria=" + encodeURIComponent(categoria) + "&search=" + encodeURIComponent(busqueda), true);
    xhr.send();
}

document.addEventListener("DOMContentLoaded", function () {
    let searchInput = document.getElementById("search-input");
    let searchButton = document.getElementById("search"); // Obtener el botón de búsqueda

    let priceInput = document.getElementById("price-input");

    searchButton.addEventListener("click", function () { // Agregar un evento clic al botón de búsqueda
        let searchValue = searchInput.value.trim();
        let priceValue = priceInput.value.trim(); // Obtener el valor del precio
        filterProductos('Todo', searchValue, priceValue); // Filtrar por categoría "Todo", término de búsqueda y precio
    });


    searchButton.addEventListener("click", function () { // Agregar un evento clic al botón de búsqueda
        let searchValue = searchInput.value.trim();
        filterProductos('Todo', searchValue); // Filtrar por categoría "Todo" y término de búsqueda
    });

    // Agregar un evento de tecla presionada al campo de búsqueda
    searchInput.addEventListener("keypress", function(event) {
        if (event.key === "Enter") { // Verificar si la tecla presionada es Enter
            let searchValue = searchInput.value.trim();
            filterProductos('Todo', searchValue); // Filtrar por categoría "Todo" y término de búsqueda
        }
    });

    // Asignar eventos a los botones de categoría
    let buttons = document.querySelectorAll(".button-value");
    buttons.forEach(button => {
        button.addEventListener("click", function() {
            let categoria = this.innerText.trim();
            // Limpiar el campo de búsqueda
            searchInput.value = "";
            filterProductos(categoria, ""); // Filtrar por categoría y sin término de búsqueda
        });
    });
});

