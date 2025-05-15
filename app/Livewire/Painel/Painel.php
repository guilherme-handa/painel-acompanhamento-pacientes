<?php

namespace App\Livewire\Painel;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Painel extends Component
{
    public $chamadas = [];

    public function render()
    {
        
        $this->chamadas = DB::connection('mysql')->select("SELECT *
                                                             FROM lista_chamadas  CHA
                                                                 ,status_paciente STA
                                                            WHERE CHA.sn_mostra_painel = 'S'
                                                              AND CHA.id_status = STA.id_status
                                                             ");

        return view('livewire.painel.painel-espelho');
    }
}
