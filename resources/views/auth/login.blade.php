<!DOCTYPE html>
<html lang="pt-BR" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema SOM</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full flex items-center justify-center px-4 sm:px-6 lg:px-8">

    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-xl shadow-md border border-gray-100">
        
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                Sistema Oficina Mecânica
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Entre e controle os serviços da sua oficina mecânica
            </p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
            @csrf

            <div class="space-y-4 rounded-md shadow-sm">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        Endereço de E-mail
                    </label>
                    <input id="email" name="email" type="email" autocomplete="email" required autofocus
                        value="{{ old('email') }}"
                        class="appearance-none relative block w-full px-3 py-2.5 border @error('email') border-red-300 text-red-900 placeholder-red-300 @else border-gray-300 placeholder-gray-400 text-gray-900 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm transition duration-150 ease-in-out" 
                        placeholder="seu@email.com">
                    
                    @error('email')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Sua Senha
                    </label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="appearance-none relative block w-full px-3 py-2.5 border @error('email') border-red-300 text-red-900 placeholder-red-300 @else border-gray-300 placeholder-gray-400 text-gray-900 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm transition duration-150 ease-in-out" 
                        placeholder="••••••••">
                </div>
            </div>
            <div>
                <button type="submit" 
                    class="group relative w-full flex justify-center py-2.5 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 font-semibold shadow transition duration-150 ease-in-out">
                    Entrar no sistema
                </button>
            </div>
        </form>
    </div>

</body>
</html>