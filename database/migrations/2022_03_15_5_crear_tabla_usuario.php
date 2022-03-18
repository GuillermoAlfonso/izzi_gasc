<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CrearTablaUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE TABLE IF NOT EXISTS `izzi_gasc`.`usuario` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `usuario` VARCHAR(12) NOT NULL,
            `contrasena` VARCHAR(255) NOT NULL,
            `nombre` VARCHAR(45) NULL,
            `apellido_paterno` VARCHAR(45) NULL,
            `apellido_materno` VARCHAR(45) NULL,
            `acceso` INT NOT NULL DEFAULT 1,
            `perfil_id` INT NOT NULL,
            PRIMARY KEY (`id`),
            INDEX `fk_usuario_perfil_idx` (`perfil_id` ASC) VISIBLE,
            UNIQUE INDEX `usuario_UNIQUE` (`usuario` ASC) VISIBLE,
            CONSTRAINT `fk_usuario_perfil`
              FOREIGN KEY (`perfil_id`)
              REFERENCES `izzi_gasc`.`perfil` (`id`)
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
        Schema::drop('usuario');
    }
}
