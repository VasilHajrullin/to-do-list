<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мой To-Do Лист</title>
    
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-lg-2 p-0">
                @include('partials.sidebar') 
            </div>

            <main class="col-md-9 col-lg-10 p-4">
                @yield('content') 
            </main>
        </div>
    </div>

</body>
</html>