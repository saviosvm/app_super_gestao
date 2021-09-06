<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;// ADICIONADO PARA SUPORTAR O DB



class AlterTableSiteContatosAddFkMotivoContatos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // estamos adicionando a coluna motivo_contato-id
        Schema::table('site_contatos', function(Blueprint $table){
            $table->unsignedBigInteger('motivo_contatos_id');
        });

        //executa uma query no banco de dados, escreve um comando sql e esse comando é executado no banco
        // fiz um update em site_contatos definindo motivo_contatos_id com o valor motivo_contato
        // estou atribuindo a coluna motivo_contato  para a nova colununa motivo_contatos_id
        DB::statement('update site_contatos set motivo_contatos_id = motivo_contato ');

        //criando a fk e removendo a coluna motivo_contato de site_contatos
        Schema::table('site_contatos', function(Blueprint $table){
            $table->foreign('motivo_contatos_id')->references('id')->on('motivo_contatos'); // criando a constraint e apontando para motivo_contatos, recebendo uma chave primaria da coluna id  contina na tabela motivo_contatos
            $table->dropColumn('motivo_contato');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //criar a coluna motivo_contato e remover a constraintFK
     Schema::table('site_contatos', function(Blueprint $table){
         $table->integer('motivo_contato');
         $table->dropForeign('site_contatos_motivo_contatos_id_foreign');
     });

     //executa uma query no banco de dados, escreve um comando sql e esse comando é executado no banco
        // estou atribuindo a coluna motivo_contatos_id  para a  colununa motivo_contato asssim revertendo o que fiz no up
        DB::statement('update site_contatos set motivo_contato = motivo_contatos_id');
     
        // estamos removendo coluna motivo_contato-id
        Schema::table('site_contatos', function(Blueprint $table){
            $table->dropColumn('motivo_contatos_id');
        });

    }
}
