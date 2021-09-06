<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AjusteProdutosFiliais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        //criando a tabela filiais
        Schema::create('filiais', function(Blueprint $table){
            $table->id();
            $table->string('filial', 30);
            $table->timestamps();

        });

        //criando a tabela produto-filiais
        Schema::create('produto_filiais', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('filial_id');
            $table->unsignedBigInteger('produto_id');

            //foi adicionada preco venda e estoques pois isso varia de filial para filial, foi pego de produtos
            $table->float('preco_venda', 8, 2)->default(0.01); // 8 a quantidade de digitos antes da virgula, 2 a quantidade de digitos apos a virgula
            $table->integer('estoque_minimo')->default(1);
            $table->integer('estoque_maximo')->default(1);
            $table->timestamps();

            // fk (constraints)
            $table->foreign('filial_id')->references('id')->on('filiais');
            $table->foreign('produto_id')->references('id')->on('produtos');

        });
        

        //removendo a coluna da tabela produtos
        Schema::table('produtos', function(Blueprint $table){ // removi as colunas de produtos que foram trazidas para ca, pois cada filial vai possuir seus precos e estoques por iso foi retirado de la e trazido para essa  tabela
            $table->dropColumn(['preco_venda', 'estoque_minimo', 'estoque_maximo']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //adicionando novamente as colunas da tabela produtos
        Schema::table('produtos', function(Blueprint $table){
            $table->float('preco_venda', 8, 2);
            $table->integer('estoque_minimo')->default(1);
            $table->integer('estoque_maximo')->default(1);
           
        });

        // removendos a fk filiais e produtos
        Schema::dropIfExists('produto_filiais');
         
        //removendo a tabela filiais
        Schema::dropIfExists('filiais');


    }
}
