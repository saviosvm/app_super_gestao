<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string('unidade', 5); // cm, mm, kg .....
            $table->string('descricao', 30);

            $table->timestamps();

//como é um relacionamento de 1 para n , então a tabela de cardinalidade 1 viaja como chave estrangeira para as tabelas de cardinalidade n
// id da tabela unidades viaja como chave estrangeira para as tableas produtos e produto_detalhes
    
        });
         //(poderia ser criada uma migration separada para a implementação desses metodoos)
        // adicionar o relacionamento com a tabela produtos
        Schema::table('produtos', function(Blueprint $table){ //  produto n -> 1 unidade // muitos produtos podem estar associados a apenas uma unidades // 1 unidade pode ter muitos produtos
            $table->unsignedBigInteger('unidade_id'); //definindo o tipo da coluna, tem que ser o mesmo da coluna id 
/*chave estrangeira*/$table->foreign('unidade_id')->references('id')->on('unidades'); // recebendo a chave estrangeira da tabela unidades dentro da tabela produto, por isso essa coluna foi criada
            
        });

        //adicionar o relacionamento com a tabela produto_detalhes
        Schema::table('produto_detalhes', function(Blueprint $table){//  produto_detalhes n -> 1 unidade // muitos produtos_detalhes podem estar associados a apenas uma unidades / 1 unidade poder ter muitos produto-detalhes
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    { /*É preciso seguir uma ordem de exclusão, é preciso remover as colunas que foram adicionadas as tabelas produtos e produto_detalhes
        antes de excluir a tabela de unidades, para não dar erro no banco*/ 

        // remover o relacionamento com a tabela produtos
        Schema::table('produto_detalhes', function(Blueprint $table){
            // remover a fk
            $table->dropForeign('produto_detalhes_unidade_id_foreign'); // [nome da tabela]_[nome da coluna onde a foreign foi atribuida]_foreign

            // remover a coluna unidade_id
            $table->dropColumn('unidade_id');
       });



        // remover o relacionamento com a tabela produto_detalhes
       Schema::table('produtos', function(Blueprint $table){
            // remover a fk
            $table->dropForeign('produtos_unidade_id_foreign');// [nome da tabela]_[nome da coluna onde a foreign foi atribuida]_foreign

            // remover a coluna unidade_id
           $table->dropColumn('unidade_id');
       });



        // remover a tabela unidades
        Schema::dropIfExists('unidades');
        
        
    }
}
