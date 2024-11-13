<!-- resources/views/errors/403.blade.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Acción no autorizada</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css">
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="text-center bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold text-red-500">403 - Acción no autorizada</h1>
        <p class="mt-4 text-gray-700">No tienes permiso para acceder a esta página.</p>
        <p class="mt-2">Serás redirigido a la página de login en unos segundos.</p>
    </div>

    <!-- Script para redirigir al login después de unos segundos -->
    <script>
        setTimeout(function() {
            window.location.href = "{{ route('login') }}";
        }, 3000); // 3000 ms = 3 segundos
    </script>
</body>

</html>
