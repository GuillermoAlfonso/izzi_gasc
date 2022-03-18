<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CrearTablaSesion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE TABLE IF NOT EXISTS `izzi_gasc`.`sesion` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `fecha_sesion` DATETIME NOT NULL DEFAULT NOW(),
            `usuario_id` INT NOT NULL,
            PRIMARY KEY (`id`),
            INDEX `fk_sesion_usuario1_idx` (`usuario_id` ASC) VISIBLE,
            CONSTRAINT `fk_sesion_usuario1`
              FOREIGN KEY (`usuario_id`)
              REFERENCES `izzi_gasc`.`usuario` (`id`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION)
          ENGINE = InnoDB;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sesion');
    }
}
