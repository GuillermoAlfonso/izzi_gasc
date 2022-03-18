<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CrearTablaProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE TABLE IF NOT EXISTS `izzi_gasc`.`producto` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `nombre` VARCHAR(30) NOT NULL,
            `descripcion` VARCHAR(100) NOT NULL,
            `precio` DOUBLE NOT NULL,
            `fecha_compra` DATETIME NOT NULL,
            `estado` BINARY,
            `comentarios` VARCHAR(100),
            `categoria_id` INT NOT NULL,
            `sucursal_id` INT NOT NULL,
            `updated_at` DATETIME,
            `created_at` DATETIME,
            PRIMARY KEY (`id`),
            INDEX `fk_producto_categoria1_idx` (`categoria_id` ASC) VISIBLE,
            INDEX `fk_producto_sucursal1_idx` (`sucursal_id` ASC) VISIBLE,
            CONSTRAINT `fk_producto_categoria1`
              FOREIGN KEY (`categoria_id`)
              REFERENCES `izzi_gasc`.`categoria` (`id`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION,
            CONSTRAINT `fk_producto_sucursal1`
              FOREIGN KEY (`sucursal_id`)
              REFERENCES `izzi_gasc`.`sucursal` (`id`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION)
          ENGINE = InnoDB;
          ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('producto');
    }
}
