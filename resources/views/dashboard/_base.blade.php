<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Suburbia</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>
<body class="bg-gray-300">

    <nav class="bg-gray-800 p-4 text-gray-500 font-bold">
        <div class="container container-md mx-auto flex align-middle">
            <a href="{{ route('dashboard') }}" class="mr-8">
                <img class="h-5 w-auto flex-initial" src="/static/brand.svg" alt="Suburbia">
            </a>

            <a class="h-6 mr-5 flex-initial hover:text-white" href="{{ route('dashboard') }}">Dashboard</a>
            <a class="h-6 mr-5 flex-initial hover:text-white" href="{{ route('s3') }}">S3 Setup</a>
            <a class="h-6 mr-5 flex-initial hover:text-white" href="">SFTP Setup</a>
            @if (auth()->user()->isAdmin())
                <a class="h-6 mr-5 flex-initial hover:text-white" href="{{ route('admin.users') }}"><i class="fas fa-shield-alt mr-1"></i>Admin</a>
            @endif
            <div class="flex-grow align-middle flex flex-row-reverse select-none" x-data="{ open: false }">
                <div class="cursor-pointer flex" @click="open = true">
                    <img src="{{ Gravatar::get(auth()->user()->getEmail()) }}" class="h-6 w-6 rounded-full mr-2">
                    <span class="font-normal text-gray-500">{{ auth()->user()->getName() }} <i class="fas fa-angle-down ml-1"></i></span>
                </div>

                <div x-show="open" @click.away="open = false" class="fixed mt-10 w-40 block bg-white text-base z-50 float-left list-none text-left rounded shadow-lg mt-1">
                    <form method="post" action="{{ route('logout') }}">
                        {{ csrf_field() }}
                        <button type="submit" class="p-2 block w-full text-left text-gray-600 hover:text-gray-700"><i class="fas fa-lock mr-2 fa-fw"></i>Sign out</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <header class="bg-gray-700 text-white font-bold">
        <div class="container container-md mx-auto pt-8 py-40">
            @yield('title')
        </div>
    </header>

    <main class="container container-md mx-auto -mt-32 p-6 h-23 bg-white rounded-md shadow-md">
        @yield('content')
    </main>

</body>
</html>
