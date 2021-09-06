<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutoDetalhesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_detalhes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id');// tem que ser do mesmo tipo da chave primaria id acima, é só usar o describ do banco pra ver
            $table->float('comprimento', 8, 2);
            $table->float('largura', 8, 2);
            $table->float('altura', 8, 2);
            $table->timestamps();

            // constraint
            $table->foreign('produto_id')->references('id')->on('produtos');
            //garante o recebimento da chave estrangeira
            // produto-id desse tabela referencia a chave primaria id e a recebe como chave estrangeira da tabela produtos
                                                                                                              

            $table->unique('produto_id'); // garante o relacionamento 1 para 1, sem ele teriamos o relacionamento de 1 para N em que 1 produto poderia ter variso produto detalhes
            // evita que aponte para produtos repetidos
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produto_detalhes');
    }
}
