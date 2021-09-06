<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteContato;
use Illuminate\Support\Facades\DB;

class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        $contato = new SiteContato();
        $contato->nome = 'Sávio Figueiredo';
        $contato->telefone = '(62) 9917-78908';
        $contato->email = 'saviofg1@hotmail.com';
        $contato->motivo_contato = 2;
        $contato->mensagem = 'testando a seeder site contato';
        $contato->save();

    SiteContato::create([
        'nome' => 'Thais',
        'telefone' => '1564654654',
        'email' => 'thais@hotmail.com',
        'motivo_contato' => 1,
        'mensagem' => 'testando o seeder site contato thais',

    ]);

    $contato = new SiteContato();
    $contato->fill([
        'nome' => 'Dora',
        'telefone' => '784545487',
        'email' => 'Dora@hotmail.com',
        'motivo_contato' => 3,
        'mensagem' => 'testando o seeder site contato Dora',
    ])->save();

    DB::table('site_contatos')->insert([
        'nome' => 'Silvio',
        'telefone' => '784545487',
        'email' => 'Silvio@hotmail.com',
        'motivo_contato' => 2,
        'mensagem' => 'testando o seeder site contato Silvio',
    ]);
    */
    \App\Models\SiteContato::Factory()->count(100)->create(); //chamando a facroty dentro de SiteContatoSeeder

    }

}
