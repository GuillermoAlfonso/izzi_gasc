-- -----------------------------------------------------
-- Schema izzi_gasc
-- -----------------------------------------------------

CREATE SCHEMA IF NOT EXISTS `izzi_gasc` DEFAULT CHARACTER SET utf8 ;
USE `izzi_gasc` ;

-- -----------------------------------------------------
-- Table `izzi_gasc`.`perfil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `izzi_gasc`.`perfil` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre_perfil` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_perfil_UNIQUE` (`nombre_perfil` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `izzi_gasc`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `izzi_gasc`.`usuario` (
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
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `izzi_gasc`.`sesion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `izzi_gasc`.`sesion` (
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
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `izzi_gasc`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `izzi_gasc`.`categoria` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre_categoria` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_categoria_UNIQUE` (`nombre_categoria` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `izzi_gasc`.`sucursal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `izzi_gasc`.`sucursal` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre_sucursal` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_sucursal_UNIQUE` (`nombre_sucursal` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `izzi_gasc`.`producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `izzi_gasc`.`producto` (
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
