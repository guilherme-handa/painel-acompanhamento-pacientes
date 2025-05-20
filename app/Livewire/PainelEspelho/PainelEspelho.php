<?php

namespace App\Livewire\PainelEspelho;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use app\Helpers\CalculaIdade;

class PainelEspelho extends Component
{
    public $chamadas = [];

    public function render()
    {
        
        $this->chamadas = DB::connection('mysql')->select("SELECT *
                                                             FROM lista_chamadas  CHA
                                                                 ,status_paciente STA
                                                            WHERE CHA.sn_mostra_painel = 'S'
                                                              AND CHA.id_status = STA.id_status
                                                            ORDER BY STA.id_status
                                                             ");

        return view('livewire.painel.painel');
    }
}
