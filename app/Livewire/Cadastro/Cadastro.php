<?php

namespace App\Livewire\Cadastro;

use App\Models\ListaChamada;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use app\Helpers\CalculaIdade;
use Toast;

class Cadastro extends Component
{

    public $chamadas = [];
    public $statusOptions = [];
    public $modalDelete = false;
    public $nm_paciente, $dt_nascimento, $id_medico, $id_status, $sn_mostra_painel, $id_registro_delete;
    public $users = [
        ['id' => 1, 'name' => 'Joe'],
        ['id' => 2,'name' => 'Mary','disabled' => true] // <-- this
    ];

    public function render()
    {
        $this->chamadas = DB::connection('mysql')->select("
            SELECT CHA.*
                  ,STA.descricao
              FROM lista_chamadas  CHA
                  ,status_paciente STA
             WHERE CHA.id_status = STA.id_status
        ");

        $this->statusOptions = DB::connection('mysql')->table('status_paciente')->pluck('descricao', 'id_status')->toArray();
        

        return view('livewire.cadastro.cadastro');
    }

    public function adicionarPaciente()
    {

        $this->id_status = (int)$this->id_status;

        if ($this->is_correct($this->dt_nascimento)) {

            $insert = DB::connection('mysql')->statement(
                "INSERT INTO lista_chamadas (nome_paciente, dt_nascimento, id_status, sn_mostra_painel)
                 VALUES (:nm_paciente, :dt_nascimento, :id_status, :sn_mostra_painel)",
                [
                    ':nm_paciente'      => $this->nm_paciente,
                    ':dt_nascimento'    => $this->dt_nascimento,
                    // ':id_medico'        => $this->id_medico,
                    ':id_status'        => 1,
                    ':sn_mostra_painel' => $this->sn_mostra_painel,
                ]
            );
    
            if ($insert) {
                session()->flash('message', 'Paciente adicionado com sucesso.');
                $this->reset('nm_paciente', 'dt_nascimento', 'id_status', 'sn_mostra_painel');
                $this->redirect('/cadastro');
            } else {
                session()->flash('error', 'Erro ao adicionar paciente.');
            }
        } else {
            session()->flash('Data de nascimento inválida.');
        }

    }

    public function is_correct($data)
    {

        $d = \DateTime::createFromFormat('Y-m-d', $data);
        return $d && $d->format('Y-m-d') === $data;

    }


    public function atualizarStatus($index, $novoStatus)
    {
        
        $update = DB::connection('mysql')->statement(
            "UPDATE lista_chamadas
                SET lista_chamadas.id_status = :novo_status
              WHERE lista_chamadas.id_chamada = :id_chamada",
              [
                ':novo_status' => $novoStatus,
                ':id_chamada'  => $index
              ]
        );

        if ($update) {
            session()->flash('message', 'Status atualizado com sucesso.');
            
        } else {
            session()->flash('error', 'Erro ao atualizar status.');
        }
        
    }

    public function apagarRegistroLista()
    {
        $delete = DB::connection('mysql')->statement(
            "DELETE FROM lista_chamadas WHERE lista_chamadas.id_chamada = :id_chamada",
            [
                ':id_chamada' => $this->id_registro_delete
            ]
        );

        if ($delete) {
            $this->reset('id_registro_delete');
            $this->modalDelete = false;
            session()->flash('message', 'Registro apagado com sucesso.');   
            $this->redirect('/cadastro');
        } else {
            session()->flash('error', 'Erro ao apagar registro.');
        }

    }

    public function ocultarRegistroPainel($id)
    {
        DB::connection('mysql')->statement(
            "UPDATE lista_chamadas
                SET lista_chamadas.sn_mostra_painel = 'N'
              WHERE lista_chamadas.id_chamada = :id_chamada 
                ",
            [
                ':id_chamada' => $id
            ]
        );
    }

    public function mostrarRegistroPainel($id)
    {
        DB::connection('mysql')->statement(
            "UPDATE lista_chamadas
                SET lista_chamadas.sn_mostra_painel = 'S'
              WHERE lista_chamadas.id_chamada = :id_chamada 
                ",
            [
                ':id_chamada' => $id
            ]
        );
    }

    public function mostraModalDelete($id_chamada)
    {
        $this->modalDelete = true;
        $this->id_registro_delete = $id_chamada;
    }

}
