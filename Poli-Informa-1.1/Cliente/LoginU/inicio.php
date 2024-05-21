<?php
    session_start();

    // Verificar si no hay una sesión activa
    if (empty($_SESSION['CodeAlu'])) {
        // Redireccionar a la página de inicio de sesión si no hay sesión activa
        header("Location: ../LoginU/index.php");
        exit();
    }

    // Configurar el tiempo de sesión en segundos (5 minutos)
    $session_duration = 25 * 60;

    // Actualizar el tiempo de última actividad
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_duration)) {
        // La sesión ha expirado
        session_unset();
        session_destroy();
        header("Location: ../LoginU/index.php");
        exit();
    }
    $_SESSION['last_activity'] = time();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Tiempo de sesión en milisegundos (5 minutos)
        var sessionDuration = 25 * 60 * 1000; // 5 minutos
        // Mostrar la alerta cuando han pasado 4 minutos
        var alertTime = sessionDuration - (1 * 60 * 1000);

        console.log('Tiempo de alerta configurado en:', alertTime, 'milisegundos');

        // Función para mostrar la alerta
        function showAlert() {
            console.log('Mostrando alerta de sesión por expirar');
            Swal.fire({
                title: 'Sesión por expirar',
                text: 'Tu sesión está a punto de expirar. ¿Deseas continuar navegando?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('Usuario desea continuar');
                    // Si el usuario desea continuar, reiniciar la sesión
                    resetSession();
                } else {
                    console.log('Usuario no desea continuar');
                    // Si el usuario no desea continuar, destruir la sesión
                    destroySession();
                }
            });
        }

        // Función para reiniciar la sesión
        function resetSession() {
            console.log('Reiniciando sesión');
            // Reemplaza 'reset_session.php' con la ruta real de tu archivo PHP para reiniciar la sesión
            fetch('reset_session.php')
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        console.log('Sesión reiniciada exitosamente');
                        // Reiniciar el temporizador de la alerta
                        clearTimeout(alertTimeout);
                        alertTimeout = setTimeout(showAlert, alertTime);
                    } else {
                        console.log('Error al reiniciar la sesión');
                    }
                });
        }

        // Función para destruir la sesión
        function destroySession() {
            console.log('Destruyendo sesión');
            // Destruir la sesión actual
            fetch('destroy_session.php')
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        console.log('Sesión destruida exitosamente');
                        // Redirigir al usuario a la página de inicio de sesión u otra página apropiada
                        window.location.href = 'index.php';
                    } else {
                        console.log('Error al destruir la sesión');
                    }
                });
        }

        // Función para enviar una solicitud de reinicio de sesión periódicamente
        function keepSessionAlive() {
            console.log('Manteniendo la sesión viva');
            // Reemplaza 'reset_session.php' con la ruta real de tu archivo PHP para mantener la sesión viva
            fetch('reset_session.php')
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        console.log('Sesión viva');
                        // Reiniciar el temporizador para mantener la sesión viva
                        setTimeout(keepSessionAlive, sessionDuration / 2);
                    } else {
                        console.log('Error al mantener la sesión viva');
                    }
                });
        }

        // Configurar el temporizador para mostrar la alerta
        var alertTimeout = setTimeout(showAlert, alertTime);

        // Mantener la sesión viva
        setTimeout(keepSessionAlive, sessionDuration / 2);

        // Reiniciar el temporizador de la alerta en caso de actividad del usuario
        document.addEventListener('mousemove', resetSession);
        document.addEventListener('keydown', resetSession);
    </script>
</head>
<body>
    <!-- Contenido de tu página -->
</body>
</html>