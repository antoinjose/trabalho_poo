<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema SOM - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-[#f8fafc] flex h-screen overflow-hidden">

    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col hidden md:flex">
        <div class="p-6">
            <h1 class="text-xl font-bold text-indigo-600 flex items-center gap-2">
                <i data-lucide="settings-2"></i> Sistema SOM
            </h1>
            <p class="text-xs text-gray-400 font-medium ml-8">Sistema de Gestão</p>
        </div>

        <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
            <p class="text-[10px] uppercase font-bold text-gray-400 px-2 mt-4 mb-2">Início</p>
            <a href="#" class="flex items-center gap-3 px-3 py-2 text-indigo-600 bg-indigo-50 rounded-lg font-medium">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Dashboard
            </a>
            <a href="{{ route('clientes.index') }}" class="flex items-center gap-3 px-3 py-2 text-gray-600 hover:bg-gray-50 rounded-lg">
                <i data-lucide="users" class="w-5 h-5"></i> Clientes
            </a>
            <a href="{{ route('veiculos.index') }}" class="flex items-center gap-3 px-3 py-2 text-gray-600 hover:bg-gray-50 rounded-lg">
                <i data-lucide="car" class="w-5 h-5"></i> Veículos
            </a>
            <a href="#" class="flex items-center justify-between px-3 py-2 text-gray-600 hover:bg-gray-50 rounded-lg">
                <div class="flex items-center gap-3">
                    <i data-lucide="file-text" class="w-5 h-5"></i> Ordens de serviço
                </div>
                <span class="bg-indigo-600 text-white text-[10px] px-1.5 py-0.5 rounded">14</span>
            </a>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col overflow-y-auto">
        
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8">
            <div class="flex items-center gap-2 text-sm text-gray-500">
                <span>Início</span> <span>/</span> <span class="font-semibold text-gray-800">Dashboard</span>
            </div>
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold">
                    {{ substr(Auth::user()->name ?? 'S', 0, 1) }}
                </div>
            </div>
        </header>

        <div class="p-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                
                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 bg-indigo-50 text-indigo-600 rounded-lg"><i data-lucide="bar-chart-3"></i></div>
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase">Ordens dos Últimos 7 Dias</p>
                            <h3 class="text-xl font-bold">Total de Ordens <span class="text-indigo-600">2</span></h3>
                        </div>
                    </div>
                    <canvas id="chartOrders" height="100"></canvas>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm text-center">
                    <p class="text-xs text-gray-400 font-bold uppercase mb-4">Contas em aberto do mês</p>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="border-r border-gray-100">
                            <p class="text-xs text-gray-500">A Receber</p>
                            <p class="text-lg font-bold text-green-500 font-mono">R$ 266,22</p>
                            <p class="text-[10px] text-gray-400">2 contas</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">A Pagar</p>
                            <p class="text-lg font-bold text-red-500 font-mono">R$ 4.210,17</p>
                            <p class="text-[10px] text-gray-400">5 contas</p>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-gray-50">
                        <p class="text-xs text-gray-500">Saldo do Mês</p>
                        <p class="text-2xl font-black text-red-600 font-mono">R$ -3.943,95</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-3">
                            <div class="p-3 bg-green-50 text-green-600 rounded-lg"><i data-lucide="trending-up"></i></div>
                            <div>
                                <p class="text-xs text-gray-500 font-bold uppercase">Balanço Semanal</p>
                                <p class="text-sm font-semibold text-green-600">R$ 282,49 <span class="text-red-500 text-xs ml-2">▼ 34.1%</span></p>
                            </div>
                        </div>
                    </div>
                    <canvas id="chartBalance" height="100"></canvas>
                </div>

            </div>

            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex items-center gap-2">
                    <i data-lucide="clipboard-list" class="text-indigo-600"></i>
                    <h3 class="font-bold text-gray-800">Ordens Abertas (14)</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 text-gray-400 uppercase text-[10px] font-bold">
                            <tr>
                                <th class="px-6 py-4">Ordem</th>
                                <th class="px-6 py-4">Cliente</th>
                                <th class="px-6 py-4">Veículo</th>
                                <th class="px-6 py-4">Data</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-center">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach([
                                ['id' => '# 4', 'cliente' => 'Priscila Oliveira Lima', 'carro' => 'Fiat Toro', 'data' => '02/06/2025', 'status' => 'ABERTA'],
                                ['id' => '# 5', 'cliente' => 'Priscila Oliveira Lima', 'carro' => 'Fiat Toro', 'data' => '21/05/2025', 'status' => 'ABERTA'],
                                ['id' => '# 6', 'cliente' => 'Gustavo Pereira Rocha', 'carro' => 'Toyota Corolla', 'data' => '28/05/2025', 'status' => 'ABERTA']
                            ] as $ordem)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-bold text-indigo-600">{{ $ordem['id'] }}</td>
                                <td class="px-6 py-4 text-gray-600 font-medium">{{ $ordem['cliente'] }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $ordem['carro'] }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $ordem['data'] }}</td>
                                <td class="px-6 py-4">
                                    <span class="bg-yellow-100 text-yellow-700 text-[10px] font-bold px-2 py-1 rounded">
                                        {{ $ordem['status'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white text-[10px] px-3 py-1.5 rounded flex items-center gap-1 mx-auto transition">
                                        <i data-lucide="eye" class="w-3 h-3"></i> Ver
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Inicializa Ícones
        lucide.createIcons();

        // Gráfico de Ordens (Barras)
        new Chart(document.getElementById('chartOrders'), {
            type: 'bar',
            data: {
                labels: ['18/08', '19/08', '20/08', '21/08', '22/08', '23/08', '24/08'],
                datasets: [{
                    label: 'Ordens',
                    data: [1, 2, 1, 0, 2, 1, 1],
                    backgroundColor: '#6366f1',
                    borderRadius: 4
                }]
            },
            options: { plugins: { legend: { display: false } }, scales: { y: { display: false }, x: { grid: { display: false } } } }
        });

        // Gráfico de Balanço (Linha Suave)
        new Chart(document.getElementById('chartBalance'), {
            type: 'line',
            data: {
                labels: ['12/08', '15/08', '18/08', '21/08', '23/08', '25/08'],
                datasets: [{
                    data: [10, 40, 20, 50, 30, 45],
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: { plugins: { legend: { display: false } }, scales: { y: { display: false }, x: { grid: { display: false } } } }
        });
    </script>
</body>
</html>