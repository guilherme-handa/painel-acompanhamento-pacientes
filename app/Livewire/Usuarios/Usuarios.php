<?php

namespace App\Livewire\Usuarios;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Usuarios extends Component
{

    public $usuarios = [];
    public $permissoesOptions = [];
    public $modalDelete = false;
    public $id_registro_delete;

    public function render()
    {

        $this->usuarios = DB::select(
            "SELECT *
               FROM users USU"
        );

        $this->permissoesOptions = DB::select(
            "SELECT PER.id_permissao id
                   ,PER.ds_permissao descricao
               FROM permissoes PER"
        );


        return view('livewire.usuarios.usuarios');
    }

    public function alterarPermissao($index, $novaPermissao)
    {

        $update = DB::connection('mysql')->statement(
            "UPDATE users
                SET users.id_permissao = :nova_permissao
              WHERE users.id = :id_user",
            [
                ':nova_permissao' => $novaPermissao,
                ':id_user'  => $index
            ]
        );

        if ($update) {
            session()->flash('message', 'Permissao atualizada com sucesso.');
            $this->redirect('/usuarios');
        } else {
            session()->flash('error', 'Erro ao atualizar permissao.');
        }
    }

    public function mostraModalDelete($id_usuario)
    {
        $this->modalDelete = true;
        $this->id_registro_delete = $id_usuario;
    }

    public function deleteAcesso()
    {
        $delete = DB::connection('mysql')->statement(
            "DELETE FROM users WHERE users.id = :id_user",
            [
                ':id_user' => $this->id_registro_delete
            ]
        );

        if ($delete) {
            $this->reset('id_registro_delete');
            $this->modalDelete = false;
            session()->flash('message', 'Registro apagado com sucesso.');
            $this->redirect('/usuarios');
        } else {
            session()->flash('error', 'Erro ao apagar registro.');
        }
    }
}
