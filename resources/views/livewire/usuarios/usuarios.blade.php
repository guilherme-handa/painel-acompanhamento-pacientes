@php
$usuarioLogado = auth()->user();
@endphp
<div class="max-w-7xl mx-auto p-6">
    @if ($usuarioLogado->id_permissao == 1)
    <card class="overflow-x-auto">
        <table class="table w-full border bg-white">
            <thead class="bg-blue-700 text-white">
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>E=mail</th>
                    <th>Data de criação</th>
                    <th>Permissão</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr class="hover:bg-gray-100">
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->created_at }}</td>
                    <td>
                        <x-select class="cursor-pointer" wire:change="alterarPermissao({{ $usuario->id }}, $event.target.value)">
                            @foreach ($permissoesOptions as $permissao)
                            <option value="{{ $permissao->id }}" {{ $usuario->id_permissao == $permissao->id ? 'selected' : '' }}>
                                {{ $permissao->descricao }}
                            </option>
                            @endforeach

                        </x-select>
                    </td>
                    <td>
                        <x-button icon="trash" class="cursor-pointer !bg-red-500 !text-white" wire:click="mostraModalDelete({{ $usuario->id }})" />
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </card>
    <x-modal wire:model="modalDelete" class="backdrop-blur">
        <div class="p-[50px] text-center">
            <div>
                Deseja realmente excluir esse acesso?
            </div>
            <div class="mt-[30px]">
                <x-button class="cursor-pointer !bg-red-500 !text-white" @click="$wire.modalDelete = false">Não</x-button>
                <x-button class="cursor-pointer !bg-green-500 !text-white" wire:click="deleteAcesso()">Sim</x-button>
            </div>
        </div>
    </x-modal>
    @else
    <div>
        <h2>Seu acesso não tem permissão para acessar essa página.</h2>
    </div>
    @endif
</div>