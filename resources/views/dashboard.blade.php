<!DOCTYPE html>
<html lang="pt-BR" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Seguro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full">

    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-xl font-bold text-gray-800 tracking-tight">🔒 SistemaSeguro</span>
                </div>
                <div class="flex items-center">
                    <span class="text-sm text-gray-600 mr-4">Olá, <strong class="text-gray-900 font-semibold">{{ Auth::user()->name }}</strong>!</span>
                    
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" 
                            class="bg-red-50 hover:bg-red-100 text-red-600 px-3 py-1.5 rounded-lg text-sm font-medium transition duration-150 ease-in-out border border-red-200">
                            Sair
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="px-4 py-8 bg-white shadow rounded-lg sm:px-10 border border-gray-200">
            <h1 class="text-2xl font-bold text-gray-950 mb-2">Bem-vindo de volta!</h1>
            <p class="text-gray-600">Você está autenticado em uma área restrita e totalmente protegida contra vulnerabilidades críticas.</p>
        </div>
    </main>

</body>
</html>
