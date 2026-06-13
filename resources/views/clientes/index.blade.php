<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes - Sistema SOM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Clientes</h1>
                        <p class="text-gray-500 mt-1">Gerencie os clientes do sistema</p>
                    </div>
                    <a href="{{ route('clientes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 shadow-md font-semibold flex items-center gap-2">
                        <i class="fas fa-plus"></i>Novo Cliente
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Alerts -->
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

            <!-- Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-100 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Nome</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">E-mail</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Telefone</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($clientes as $cliente)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $cliente->id }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $cliente->nome }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $cliente->email }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $cliente->telefone ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm flex gap-2">
                                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="bg-amber-500 text-white px-3 py-1 rounded text-xs hover:bg-amber-600 transition duration-200 inline-flex items-center gap-1">
                                            <i class="fas fa-edit"></i>Editar
                                        </a>
                                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?')">
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
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <i class="fas fa-inbox text-4xl text-gray-300 mb-4 block"></i>
                                        <p class="text-gray-500 font-semibold">Nenhum cliente cadastrado</p>
                                        <p class="text-gray-400 text-sm mt-1">Comece criando um novo cliente</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $clientes->links() }}
            </div>
        </div>
    </div>
</body>
</html>
