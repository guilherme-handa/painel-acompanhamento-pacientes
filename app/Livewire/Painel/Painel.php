<?php

namespace App\Livewire\Painel;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use app\Helpers\CalculaIdade;
use Livewire\Attributes\Layout;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;

class Painel extends Component
{
    public $chamadas = [];

    #[Layout('components.layouts.app-withoutsidebar')]
    public function render()
    {
        // dd('teste');
        
        $this->chamadas = DB::connection('mysql')->select("SELECT *
                                                             FROM lista_chamadas  CHA
                                                                 ,status_paciente STA
                                                            WHERE CHA.sn_mostra_painel = 'S'
                                                              AND CHA.id_status = STA.id_status
                                                            ORDER BY STA.id_status, CHA.nome_paciente
                                                             ");

        return view('livewire.painel.painel');
    }
}
