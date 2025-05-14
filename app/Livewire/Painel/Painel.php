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
                                                             FROM lista_chamadas
                                                            WHERE lista_chamadas.sn_mostra_painel = 'S' 
                                                             ");

        return view('livewire.painel.painel-espelho');
    }
}
