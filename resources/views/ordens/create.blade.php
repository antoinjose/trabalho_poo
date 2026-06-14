<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Ordem de Serviço - Sistema SOM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center gap-3">
                    <a href="{{ route('ordens.index') }}" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Nova Ordem de Serviço</h1>
                        <p class="text-gray-500 mt-1">Registre um novo serviço para o cliente</p>
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
                <form action="{{ route('ordens.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="cliente_id" class="block text-sm font-semibold text-gray-900 mb-2">
                            Cliente <span class="text-red-500">*</span>
                        </label>
                        <select id="cliente_id" name="cliente_id" class="w-full px-4 py-2 border @error('cliente_id') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            <option value="">Selecione um cliente...</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>{{ $cliente->nome }}</option>
                            @endforeach
                        </select>
                        @error('cliente_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="veiculo_id" class="block text-sm font-semibold text-gray-900 mb-2">
                            Veículo <span class="text-red-500">*</span>
                        </label>
                        <select id="veiculo_id" name="veiculo_id" class="w-full px-4 py-2 border @error('veiculo_id') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            <option value="">Selecione um veículo...</option>
                            @foreach($veiculos as $veiculo)
                                <option value="{{ $veiculo->id }}" {{ old('veiculo_id') == $veiculo->id ? 'selected' : '' }}>
                                    {{ $veiculo->placa }} - {{ $veiculo->marca }} {{ $veiculo->modelo }}
                                </option>
                            @endforeach
                        </select>
                        @error('veiculo_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="descricao" class="block text-sm font-semibold text-gray-900 mb-2">
                            Descrição do Serviço <span class="text-red-500">*</span>
                        </label>
                        <textarea id="descricao" name="descricao" rows="5" class="w-full px-4 py-3 border @error('descricao') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Detalhe os serviços a realizar" required>{{ old('descricao') }}</textarea>
                        @error('descricao')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-900 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select id="status" name="status" class="w-full px-4 py-2 border @error('status') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                @foreach(['ABERTA', 'EM ANDAMENTO', 'CONCLUÍDA', 'CANCELADA'] as $status)
                                    <option value="{{ $status }}" {{ old('status') === $status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="valor" class="block text-sm font-semibold text-gray-900 mb-2">
                                Valor
                            </label>
                            <input type="number" step="0.01" min="0" id="valor" name="valor" value="{{ old('valor') }}" class="w-full px-4 py-2 border @error('valor') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="0.00">
                            @error('valor')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="data_entrega" class="block text-sm font-semibold text-gray-900 mb-2">
                                Data de Entrega
                            </label>
                            <input type="date" id="data_entrega" name="data_entrega" value="{{ old('data_entrega') }}" class="w-full px-4 py-2 border @error('data_entrega') border-red-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('data_entrega')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex gap-3 pt-4 border-t">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200 font-semibold inline-flex items-center gap-2">
                            <i class="fas fa-save"></i>Salvar Ordem
                        </button>
                        <a href="{{ route('ordens.index') }}" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-400 transition duration-200 font-semibold inline-flex items-center gap-2">
                            <i class="fas fa-times"></i>Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
