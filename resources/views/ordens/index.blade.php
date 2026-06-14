<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordens de Serviço - Sistema SOM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Ordens de Serviço</h1>
                        <p class="text-gray-500 mt-1">Gerencie as ordens de serviço da oficina</p>
                    </div>
                    <a href="{{ route('ordens.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 shadow-md font-semibold flex items-center gap-2">
                        <i class="fas fa-plus"></i>Nova Ordem
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6 flex items-start gap-3">
                    <i class="fas fa-check-circle mt-0.5"></i>
                    <div>
                        <p class="font-semibold">Sucesso!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6 flex items-start gap-3">
                    <i class="fas fa-exclamation-circle mt-0.5"></i>
                    <div>
                        <p class="font-semibold">Erro!</p>
                        <p>{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-100 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Ordem</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Cliente</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Veículo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Valor</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Entrega</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($ordens as $ordem)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm font-bold text-indigo-600">#{{ $ordem->id }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $ordem->cliente->nome ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $ordem->veiculo->marca }} {{ $ordem->veiculo->modelo }} ({{ $ordem->veiculo->placa }})</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-[11px] font-semibold {{ $ordem->status === 'CONCLUÍDA' ? 'bg-green-100 text-green-700' : ($ordem->status === 'CANCELADA' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                            {{ $ordem->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $ordem->valor !== null ? 'R$ ' . number_format($ordem->valor, 2, ',', '.') : '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $ordem->data_entrega?->format('d/m/Y') ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm flex flex-wrap gap-2">
                                        <a href="{{ route('ordens.show', $ordem->id) }}" class="bg-indigo-600 text-white px-3 py-1 rounded text-xs hover:bg-indigo-700 transition duration-200 inline-flex items-center gap-1">
                                            <i class="fas fa-eye"></i>Ver
                                        </a>
                                        <a href="{{ route('ordens.edit', $ordem->id) }}" class="bg-amber-500 text-white px-3 py-1 rounded text-xs hover:bg-amber-600 transition duration-200 inline-flex items-center gap-1">
                                            <i class="fas fa-edit"></i>Editar
                                        </a>
                                        <form action="{{ route('ordens.destroy', $ordem->id) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir esta ordem de serviço?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-700 transition duration-200 inline-flex items-center gap-1">
                                                <i class="fas fa-trash"></i>Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <i class="fas fa-inbox text-4xl text-gray-300 mb-4 block"></i>
                                        <p class="text-gray-500 font-semibold">Nenhuma ordem de serviço encontrada</p>
                                        <p class="text-gray-400 text-sm mt-1">Comece criando uma nova ordem</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                {{ $ordens->links() }}
            </div>
        </div>
    </div>
</body>
</html>
