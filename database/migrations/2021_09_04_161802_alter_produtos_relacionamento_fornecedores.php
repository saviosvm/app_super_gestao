<?php

use Faker\Extension\BloodExtension;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AlterProdutosRelacionamentoFornecedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('produtos', function (Blueprint $table){

       $fornecedor_id =  DB::table('fornecedores')->insertGetId([        
//insere um registro de fornecedor para estabelecer um relacionamento, 
//pois se criar esssa coluna enquanto existe registro em produtos vai dar erro
// pois essa FK que está sendo criada vai estar vazia, 
//poderia também ter apagado os dados de produtos que daria certo.
// tambémse fosse a primeira execução da migration daria certo pois o campo produtos estaria vazio
// porem nesta migration estamos inserindo uma fk me produtos, a fornecedor_id
            'nome' => 'Fornecedor Padrão SG',
            'site' => 'Fornecedor.com.br',
            'uf' => 'Go',
            'email' => 'Fornecedor@gmail.com',
        ]);
           //$fornecedor_id insere como valor default o registro acima para que a coluna fornecedor_id não fique vazia  e onde não existir um fornecedor_id ser inserido o valor default (um id)
           $table->unsignedBigInteger('fornecedor_id')->default($fornecedor_id)->after('id'); // after especifica para criar a coluna após a coluna id
           $table->foreign('fornecedor_id')->references('id')->on('fornecedores'); //constraint

       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produtos', function (Blueprint $table){
            $table->dropForeign('produtos_fornecedor_id_foreign');
            $table->dropColumn('fornecedor_id');
        });
    }
}
