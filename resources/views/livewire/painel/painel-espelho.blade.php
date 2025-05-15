<div class="min-h-screen bg-blue-50 flex flex-col items-center px-4 py-8">
    <div class="flex items-center gap-6 mb-10">
        <img src="{{ asset('img/logo_clinica.png') }}" alt="Logo da Clínica" class="h-32">
        <h2 class="text-5xl font-semibold text-blue-900">Acompanhamento de Pacientes</h2>
    </div>

    <div class="w-full max-w-7xl overflow-x-auto rounded-xl shadow-lg bg-white">
        <table class="min-w-full table-auto">
            <thead class="bg-blue-700 text-white text-lg">
                <tr>
                    <th class="px-6 py-4 text-left">Paciente</th>
                    <th class="px-6 py-4 text-left">Data de Nascimento</th>
                    <th class="px-6 py-4 text-left">Status</th>
                </tr>
            </thead>
            <tbody class="text-blue-900 text-xl divide-y divide-blue-100">
                @forelse ($chamadas as $chamada)
                    <tr class="transition">
                        <td class="px-6 py-4">{{ $chamada->nome_paciente }}</td>
                        <td class="px-6 py-4">{{ $chamada->dt_nascimento ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $chamada->descricao ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-6 text-gray-500">Nenhum paciente encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<script>
    setInterval(function() {
        location.reload();
    }, 6000); // 6000 milissegundos = 6 segundos
</script>
