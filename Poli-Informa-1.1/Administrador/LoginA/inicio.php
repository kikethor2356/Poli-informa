<?php
session_start();

// Verificar si no hay una sesión activa
if (empty($_SESSION['AdCode'])) {
    // Redireccionar a la página de inicio de sesión si no hay sesión activa
    header("Location: ../LoginA/index.php");
    exit();
}

// Configurar el tiempo de sesión en segundos (5 minutos para pruebas)
$session_duration = 5 * 60;

// Actualizar el tiempo de última actividad
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_duration)) {
    // La sesión ha expirado
    session_unset();
    session_destroy();
    header("Location: ../LoginA/index.php?expired=true"); // Redirigir con un parámetro de consulta para indicar que la sesión ha expirado
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
        // Tiempo de sesión en milisegundos (5 minutos para pruebas)
        var sessionDuration = 5 * 60 * 1000; // 5 minutos
        // Mostrar la alerta cuando ha pasado el 80% del tiempo
        var alertTime = sessionDuration * 0.8; // 4 minutos
        // Tiempo de expiración final (1 minuto después de la duración total de la sesión)
        var expireTime = sessionDuration + (1 * 60 * 1000); // 6 minutos

        // Definir una variable para almacenar si se ha permitido continuar con la sesión
        var sessionContinued = false;

        // Función para mostrar la alerta
        function showAlert() {
            // Verificar si se ha permitido continuar con la sesión en el servidor
            <?php if ($_SESSION['sessionContinued'] ?? false): ?>
                return;
            <?php endif; ?>

            Swal.fire({
                title: 'Sesión por expirar',
                text: 'Tu sesión está a punto de expirar. ¿Deseas continuar navegando?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'No',
                timer: 50000, // Duración mínima de la alerta en milisegundos (50 segundos)
                didOpen: () => {
                    const timerInterval = setInterval(() => {
                        const content = Swal.getContent();
                        if (!content) return;
                        const b = content.querySelector('b');
                        if (b) {
                            b.textContent = Math.ceil(Swal.getTimerLeft() / 1000);
                        }
                    }, 100);
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Marcar que se ha permitido continuar con la sesión
                    <?php $_SESSION['sessionContinued'] = true; ?>
                    Swal.fire({
                        title: 'Perfecto',
                        text: 'Continuarás en sesión',
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        resetSession();
                    });
                } else {
                    destroySession();
                }
            });
        }

        // Función para reiniciar la sesión
        function resetSession() {
            fetch('reset_session.php')
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        clearTimeout(alertTimeout);
                        clearTimeout(expireTimeout);
                        alertTimeout = setTimeout(showAlert, alertTime);
                        expireTimeout = setTimeout(destroySession, expireTime);
                    } else {
                        window.location.href = '../LoginA/index.php';
                    }
                });
        }

        // Función para destruir la sesión
        function destroySession() {
            fetch('destroy_session.php')
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        window.location.href = '../LoginA/index.php?expired=true'; // Redirigir con un parámetro de consulta para indicar que la sesión ha expirado
                    }
                });
        }

        // Configurar el temporizador para mostrar la alerta
        var alertTimeout = setTimeout(showAlert, alertTime);

        // Configurar el temporizador para destruir la sesión automáticamente después de 6 minutos
        var expireTimeout = setTimeout(destroySession, expireTime);

        // Mostrar la alerta cuando se cargue la página
        window.onload = showAlert;
    </script>
</head>
<body>
    <script>
        // Mostrar la alerta cuando se cargue la página
        window.onload = showAlert;
    </script>
</body>
</html>