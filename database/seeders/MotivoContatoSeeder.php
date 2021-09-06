<?php

namespace Database\Seeders;
 
use App\Models\MotivoContato; // foi necesssário trazer o model para o contexto
use Illuminate\Database\Seeder;

class MotivoContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MotivoContato::create(['motivo_contato' => 'Dúvida']);
        MotivoContato::create(['motivo_contato' => 'Elogia']);
        MotivoContato::create(['motivo_contato' => 'Reclamação']);
    }
}
