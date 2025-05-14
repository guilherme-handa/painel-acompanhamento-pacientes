<?php

namespace App\Livewire\Cadastro;

use App\Models\ListaChamada;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Cadastro extends Component
{

    public $chamadas = [];
    public $nm_paciente, $dt_nascimento, $id_medico, $id_status, $sn_mostra_painel;

    public function render()
    {
        $this->chamadas = DB::connection('mysql')->select("SELECT CHA.*
                                                                 ,STA.descricao
                                                             FROM lista_chamadas  CHA
                                                                 ,status_paciente STA
                                                            WHERE CHA.id_status = STA.id_status     
                                                                 ");

        // dd($this->chamadas);

        return view('livewire.cadastro.cadastro');
    }

    public function atualizarStatus($index, $novoStatus)
    {
        dd($index);

        $this->items[$index]['status'] = $novoStatus;
        // Aqui você poderia fazer update no banco, exemplo:
        // Item::find($this->items[$index]['id'])->update(['status' => $novoStatus]);
    }

    public function adicionarPaciente()
    {

        // dd($this->dt_nascimento);

        $insert = DB::connection('mysql')->statement(
            "INSERT INTO lista_chamadas (nome_paciente, dt_nascimento, id_medico, id_status, sn_mostra_painel)
             VALUES (:nm_paciente, :dt_nascimento, :id_medico, :id_status, :sn_mostra_painel)",
            [
                ':nm_paciente'      => $this->nm_paciente,
                ':dt_nascimento'    => $this->dt_nascimento,
                ':id_medico'        => $this->id_medico,
                ':id_status'        => $this->id_status,
                ':sn_mostra_painel' => $this->sn_mostra_painel,
            ]
        );

        if ($insert) {
            session()->flash('message', 'Paciente adicionado com sucesso.');
        } else {
            session()->flash('error', 'Erro ao adicionar paciente.');
        }


        // Validação e criação do paciente
        // Exemplo:
        // $this->validate([
        //     'nome_paciente' => 'required|string',
        //     'dt_nascimento' => 'required|date',
        //     'id_medico' => 'required|integer',
        //     'id_status' => 'required|integer',
        //     'sn_mostra_painel' => 'required|string',
        // ]);

        // // ListaChamada::create([
        // //     'nome_paciente' => $this->nm_paciente,
        // //     'dt_nascimento' => $this->dt_nascimento,
        // //     'id_medico' => $this->id_medico,
        // //     'id_status' => $this->id_status,
        // //     'sn_mostra_painel' => $this->sn_mostra_painel,
        // // ]);

        // Limpar campos ou feedback
        // $this->reset(['nome', 'nascimento', 'medico', 'status', 'mostraPainel']);
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
}
