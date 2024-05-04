    let currentSlide = 0;
    let savedSlideIndex = 0; // Variable para guardar el índice de la imagen actual antes de abrir la ventana modal
    const slides = document.querySelectorAll(".item");
    let intervalID; // Variable para guardar el ID del intervalo

    function showSlide(index) {
        slides[currentSlide].classList.remove("uno");
        currentSlide = (index + slides.length) % slides.length;
        slides[currentSlide].classList.add("uno");
    }

    function siguienteBT() {
        showSlide(currentSlide + 1);
    }

    function anteriorBT() {
        showSlide(currentSlide - 1);
    }

    function autoSlide() {
        siguienteBT();
    }

    function abrirVentanaVisualizar(nombre, index) {
        let modal = document.getElementById('ventanaVisualizarProducto');
        modal.classList.add('enseñar_Ver');

        // Detiene el intervalo
        clearInterval(intervalID);

        // Guarda el índice de la imagen actual antes de abrir la ventana modal
        savedSlideIndex = currentSlide;

        var nombreProducto = document.getElementById("nombreProducto");
        nombreProducto.textContent = "Informacion: " + nombre;

        // Muestra la imagen correspondiente al índice pasado como parámetro
        showSlide(index);
    }

    function cerrarVentanaVisualizar() {
        let modal = document.getElementById('ventanaVisualizarProducto');
        modal.classList.remove('enseñar_Ver');

        // Restaura la imagen a la que estaba antes de abrir la ventana modal
        showSlide(savedSlideIndex);

        // Reanuda el intervalo
        intervalID = setInterval(autoSlide, 6000);
    }

    // Mostrar la primera diapositiva al cargar la página
    showSlide(currentSlide);

    // Iniciar el intervalo
    intervalID = setInterval(autoSlide, 6000);
