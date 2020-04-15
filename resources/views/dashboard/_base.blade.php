<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Suburbia</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
</head>
<body class="bg-gray-300">

    <nav class="bg-gray-800 p-4 text-gray-500 font-bold">
        <div class="container container-md mx-auto flex">
            <a href="{{ route('dashboard') }}" class="mr-8">
                <img class="h-5 w-auto flex-initial" src="/brand.svg" alt="Suburbia">
            </a>

            <a class="mr-5 flex-initial hover:text-white" href="{{ route('dashboard') }}">Dashboard</a>
            <a class="mr-5 flex-initial hover:text-white" href="{{ route('s3') }}">S3 Setup</a>
            <a class="mr-5 flex-initial hover:text-white" href="">SFTP Setup</a>
        </div>
    </nav>

    <header class="bg-gray-700 text-white font-bold">
        <div class="container container-md mx-auto pt-8 py-40">
            <h1 class="text-3xl">@yield('title')</h1>
        </div>
    </header>

    <main class="container container-md mx-auto -mt-32 p-6 h-23 bg-white rounded-md shadow-md">
        @yield('content')
    </main>

</body>
</html>
