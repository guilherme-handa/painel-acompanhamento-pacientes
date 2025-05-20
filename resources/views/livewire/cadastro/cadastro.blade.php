@php
$usuarioLogado = auth()->user();
@endphp
<div class="max-w-7xl mx-auto p-6">
    @if ($usuarioLogado->id_permissao == 2 || $usuarioLogado->id_permissao == 1)
    <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Cadastro de Paciente</h2>
    <card class="mb-10">
        <form wire:submit.prevent="adicionarPaciente" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @csrf

            <x-input label="Nome" wire:model="nm_paciente" id="nome" name="nome" oninput="this.value = this.value.toUpperCase()" required />

            <x-input label="Data de Nascimento" class="cursor-pointer" wire:model="dt_nascimento" id="nascimento" name="nascimento" type="date" required />

            <x-select label="Médico" class="cursor-pointer" wire:model="id_medico" id="medico" name="medico" required>
                <option value="" selected>Selecione um médico</option>
                <option value="1">DR DOUGLAS GRION</option>
                <option value="2">LUCIANO RODRIGUES E SILVA</option>
                <option value="3">JOÃO AUGUSTO SILVA</option>
                <option value="4">CLAUDIO CAETANO</option>
            </x-select>

            @if(1 == 0)
            <x-select label="Status" class="cursor-pointer" wire:model="id_status" id="status" name="status" required>
                <option value="" selected>Selecione um status</option>
                @foreach ($statusOptions as $status => $descricao)
                <option value="{{$status}}">{{$descricao}}</option>
                @endforeach
            </x-select>
            @endif

            <x-select label="Mostrar no painel" class="cursor-pointer" wire:model="sn_mostra_painel" id="mostra-painel" name="mostra-painel" required>
                <option value="" selected>Selecione uma opção</option>
                <option value="N">Não</option>
                <option value="S">Sim</option>
            </x-select>

            <div class="flex items-end">
                <x-button type="submit" class="cursor-pointer !bg-blue-700 !text-white">Adicionar Paciente</x-button>
            </div>
        </form>

    </card>
    @endif

    <h2 class="text-2xl font-semibold text-center text-gray-800 my-6">Acompanhamento de Pacientes</h2>

    <card class="overflow-x-auto">
        <table class="table w-full border bg-white">
            <thead class="bg-blue-700 text-white">
                <tr>
                    <th>Paciente</th>
                    <th>Idade</th>
                    <th>Médico</th>
                    <th>Status Atual</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($chamadas as $chamada)
                <tr class="hover:bg-gray-100">
                    <td>{{ $chamada->nome_paciente }}</td>
                    <td>{{ \App\Helpers\CalculaIdade::calcularIdade($chamada->dt_nascimento) }} anos</td>
                    <td>DR DOUGLAS GRION</td>

                    @if ($usuarioLogado->id_permissao == 3 || $usuarioLogado->id_permissao == 1)
                    <td>
                        <x-select class="cursor-pointer" wire:change="atualizarStatus({{ $chamada->id_chamada }}, $event.target.value)">
                            @foreach ($statusOptions as $id => $descricao)
                            <option value="{{ $id }}" {{ $chamada->id_status == $id ? 'selected' : '' }}>
                                {{ $descricao }}
                            </option>
                            @endforeach
                        </x-select>
                    </td>
                    @else
                    <td>
                        <x-select class="cursor-pointer" wire:change="atualizarStatus({{ $chamada->id_chamada }}, $event.target.value)" disabled readonly>
                            @foreach ($statusOptions as $id => $descricao)
                            <option value="{{ $id }}" {{ $chamada->id_status == $id ? 'selected' : '' }}>
                                {{ $descricao }}
                            </option>
                            @endforeach
                        </x-select>
                    </td>
                    @endif

                    <td class="flex gap-2">
                        @if ($usuarioLogado->id_permissao == 2 || $usuarioLogado->id_permissao == 1)
                            @if ($chamada->sn_mostra_painel == 'S')
                            <x-button icon="eye" class="cursor-pointer !bg-green-400" wire:click="ocultarRegistroPainel({{ $chamada->id_chamada }})" />
                            @else
                            <x-button icon="eye-slash" class="cursor-pointer !bg-red-400" wire:click="mostrarRegistroPainel({{ $chamada->id_chamada }})" />
                            @endif
                            <x-button icon="trash" class="cursor-pointer !bg-red-500 !text-white" wire:click="mostraModalDelete({{ $chamada->id_chamada }})" />
                            @else
                            @if ($chamada->sn_mostra_painel == 'S')
                            <x-button icon="eye" class="cursor-pointer !bg-green-400" wire:click="ocultarRegistroPainel({{ $chamada->id_chamada }})" disabled readonly/>
                            @else
                            <x-button icon="eye-slash" class="cursor-pointer !bg-red-400" wire:click="mostrarRegistroPainel({{ $chamada->id_chamada }})" disabled readonly/>
                            @endif
                            <x-button icon="trash" class="cursor-pointer !bg-red-500 !text-white" wire:click="mostraModalDelete({{ $chamada->id_chamada }})" disabled readonly/>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </card>
    <x-modal wire:model="modalDelete" class="backdrop-blur">
        <div class="p-[50px] text-center">
            <div>
                Deseja realmente excluir esse paciente?
            </div>
            <div class="mt-[30px]">
                <x-button class="cursor-pointer !bg-red-500 !text-white" @click="$wire.modalDelete = false">Não</x-button>
                <x-button class="cursor-pointer !bg-green-500 !text-white" wire:click="apagarRegistroLista()">Sim</x-button>
            </div>
        </div>

    </x-modal>
</div>