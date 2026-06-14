<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Ordem de Serviço - Sistema SOM</title>
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
                        <h1 class="text-3xl font-bold text-gray-900">Ordem de Serviço #{{ $ordem->id }}</h1>
                        <p class="text-gray-500 mt-1">Detalhes da ordem de serviço</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-lg shadow p-6 space-y-6">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="space-y-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">Cliente</p>
                        <p class="text-gray-900 font-semibold">{{ $ordem->cliente->nome ?? 'N/A' }}</p>
                        <p class="text-sm text-gray-500">{{ $ordem->cliente->email ?? '' }}</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">Veículo</p>
                        <p class="text-gray-900 font-semibold">{{ $ordem->veiculo->marca }} {{ $ordem->veiculo->modelo }} ({{ $ordem->veiculo->placa }})</p>
                        <p class="text-sm text-gray-500">{{ $ordem->veiculo->cor ?? 'Sem cor definida' }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="space-y-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">Status</p>
                        <p class="text-gray-900 font-semibold">{{ $ordem->status }}</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">Data de Entrega</p>
                        <p class="text-gray-900 font-semibold">{{ $ordem->data_entrega?->format('d/m/Y') ?? '-' }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="space-y-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">Valor</p>
                        <p class="text-gray-900 font-semibold">{{ $ordem->valor !== null ? 'R$ ' . number_format($ordem->valor, 2, ',', '.') : '-' }}</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">Criado em</p>
                        <p class="text-gray-900 font-semibold">{{ $ordem->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <div>
                    <p class="text-xs uppercase tracking-wide text-gray-500">Descrição</p>
                    <div class="mt-2 p-4 rounded-lg bg-gray-50 border border-gray-200 text-sm text-gray-700 whitespace-pre-line">{{ $ordem->descricao }}</div>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('ordens.edit', $ordem->id) }}" class="bg-amber-500 text-white px-6 py-2 rounded-lg hover:bg-amber-600 transition duration-200 font-semibold inline-flex items-center gap-2">
                        <i class="fas fa-edit"></i>Editar Ordem
                    </a>
                    <a href="{{ route('ordens.index') }}" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-400 transition duration-200 font-semibold inline-flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i>Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
