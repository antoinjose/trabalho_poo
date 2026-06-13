<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Veículo - Sistema SOM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center gap-3">
                    <a href="{{ route('veiculos.index') }}" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Novo Veículo</h1>
                        <p class="text-gray-500 mt-1">Cadastre um novo veículo no sistema</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Errors -->
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

            <!-- Form -->
            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('veiculos.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Cliente -->
                    <div>
                        <label for="cliente_id" class="block text-sm font-semibold text-gray-900 mb-2">
                            Cliente <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="cliente_id" 
                            name="cliente_id"
                            class="w-full px-4 py-2 border @error('cliente_id') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required
                        >
                            <option value="">Selecione um cliente...</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('cliente_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Marca -->
                    <div>
                        <label for="marca" class="block text-sm font-semibold text-gray-900 mb-2">
                            Marca <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="marca" 
                            name="marca" 
                            value="{{ old('marca') }}"
                            class="w-full px-4 py-2 border @error('marca') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="ex: Toyota, Ford, Volkswagen"
                            required
                        >
                        @error('marca')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Modelo -->
                    <div>
                        <label for="modelo" class="block text-sm font-semibold text-gray-900 mb-2">
                            Modelo <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="modelo" 
                            name="modelo" 
                            value="{{ old('modelo') }}"
                            class="w-full px-4 py-2 border @error('modelo') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="ex: Corolla, Focus, Gol"
                            required
                        >
                        @error('modelo')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Placa -->
                    <div>
                        <label for="placa" class="block text-sm font-semibold text-gray-900 mb-2">
                            Placa <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="placa" 
                            name="placa" 
                            value="{{ old('placa') }}"
                            class="w-full px-4 py-2 border @error('placa') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent uppercase"
                            placeholder="ABC-1234"
                            maxlength="10"
                            required
                        >
                        @error('placa')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Cor -->
                    <div>
                        <label for="cor" class="block text-sm font-semibold text-gray-900 mb-2">
                            Cor
                        </label>
                        <input 
                            type="text" 
                            id="cor" 
                            name="cor" 
                            value="{{ old('cor') }}"
                            class="w-full px-4 py-2 border @error('cor') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="ex: Preto, Branco, Prata"
                        >
                        @error('cor')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ano -->
                    <div>
                        <label for="ano" class="block text-sm font-semibold text-gray-900 mb-2">
                            Ano
                        </label>
                        <input 
                            type="number" 
                            id="ano" 
                            name="ano" 
                            value="{{ old('ano') }}"
                            class="w-full px-4 py-2 border @error('ano') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="ex: 2023"
                            min="1900"
                            max="{{ date('Y') + 1 }}"
                        >
                        @error('ano')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-3 pt-4 border-t">
                        <button 
                            type="submit" 
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200 font-semibold inline-flex items-center gap-2"
                        >
                            <i class="fas fa-save"></i>Salvar Veículo
                        </button>
                        <a 
                            href="{{ route('veiculos.index') }}" 
                            class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-400 transition duration-200 font-semibold inline-flex items-center gap-2"
                        >
                            <i class="fas fa-times"></i>Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
