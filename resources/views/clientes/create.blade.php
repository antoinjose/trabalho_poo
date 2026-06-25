<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Cliente - Sistema SOM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('clientes.index') }}" class="text-gray-500 hover:text-gray-700" title="Voltar para Clientes">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Novo Cliente</h1>
                            <p class="text-gray-500 mt-1">Cadastre um novo cliente no sistema</p>
                        </div>
                    </div>
                    
                    <div>
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition duration-200 shadow-sm">
                            <i class="fas fa-tachometer-alt text-gray-500"></i>
                            Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
                    <p class="font-semibold flex items-center gap-2 mb-2">
                        <i class="fas fa-exclamation-circle"></i>Erros na validação
                    </p>
                    <ul class="list-disc list-inside space-y-1 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('clientes.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="nome" class="block text-sm font-semibold text-gray-900 mb-2">
                            Nome <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="nome" 
                            name="nome" 
                            value="{{ old('nome') }}"
                            class="w-full px-4 py-2 border @error('nome') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Nome completo do cliente"
                            required
                        >
                        @error('nome')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">
                            E-mail <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            class="w-full px-4 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="exemplo@email.com"
                            required
                        >
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="telefone" class="block text-sm font-semibold text-gray-900 mb-2">
                            Telefone
                        </label>
                        <input 
                            type="text" 
                            id="telefone" 
                            name="telefone" 
                            value="{{ old('telefone') }}"
                            class="w-full px-4 py-2 border @error('telefone') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="(XX) XXXXX-XXXX"
                        >
                        @error('telefone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap items-center justify-between gap-3 pt-4 border-t">
                        <div class="flex gap-3">
                            <button 
                                type="submit" 
                                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200 font-semibold inline-flex items-center gap-2"
                            >
                                <i class="fas fa-save"></i>Salvar Cliente
                            </button>
                            <a 
                                href="{{ route('clientes.index') }}" 
                                class="bg-gray-200 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-300 transition duration-200 font-semibold inline-flex items-center gap-2"
                            >
                                <i class="fas fa-times"></i>Cancelar
                            </a>
                        </div>

                        <a 
                            href="{{ route('dashboard') }}" 
                            class="text-gray-500 hover:text-gray-700 text-sm font-medium inline-flex items-center gap-1 py-2"
                        >
                            <i class="fas fa-chevron-left text-xs"></i> Ir para o Dashboard
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>