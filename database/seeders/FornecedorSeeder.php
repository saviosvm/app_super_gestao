<?php

namespace Database\Seeders;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use App\Models\Fornecedor; //Para usar o model para inserir dados no banco
use Illuminate\Support\Facades\DB; //para usar o DB


class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        //instanciando o objeto
        $fornecedor = new Fornecedor();
        $fornecedor->nome = 'Dihonantan Figueiredo';
        $fornecedor->site = 'dihonatanfigueiredo.com.br';
        $fornecedor->uf = 'Go';
        $fornecedor->email = 'dihonatanfigueiredo@hotmail.com';
        $fornecedor->save();
 
        //usando o metodo create
        Fornecedor::create([ //para usar o metodo create é necessário liberar os atributos no model com o metodo protectes fillable
            'nome' => 'Sávio Figueiredo de Morais',
            'site' => 'savio.com.br',
            'uf' => 'SC',
            'email' => 'saviofg1@hotmail.com'
        ]);

        //usando o insert, não coloca dados no created_at e updated_at
        DB::table('fornecedores')->insert([
            'nome' => 'thais Caroline',
            'site' => 'thais.com.br',
            'uf' => 'SC',
            'email' => 'thaisfg1@hotmail.com'
        ]);

        $fornecedor = new Fornecedor();
        $fornecedor->fill([
            'nome' => 'teste',
            'site' => 'teste.com.br',
            'uf' => 'SC',
            'email' => 'teste@hotmail.com'
        ])->save();
*/
   \App\Models\Fornecedor::Factory()->count(100)->create();
        
    }
}
