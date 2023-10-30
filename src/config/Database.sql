CREATE SCHEMA IF NOT EXISTS `gerenciador` DEFAULT CHARACTER SET utf8 ;
USE `gerenciador` ;

-- -----------------------------------------------------
-- Table `gerenciador`.`cargo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gerenciador`.`cargo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(50) NOT NULL,
  `descricao` LONGTEXT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gerenciador`.`funcionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gerenciador`.`funcionario` (
  `matricula` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `sobrenome` VARCHAR(45) NOT NULL,
  `nascimento` DATE NOT NULL,
  `salario` FLOAT NOT NULL,
  `cargo_id` INT NOT NULL,
  PRIMARY KEY (`matricula`),
  INDEX `fk_funcionario_cargo_idx` (`cargo_id` ASC) VISIBLE,
  CONSTRAINT `fk_funcionario_cargo`
    FOREIGN KEY (`cargo_id`)
    REFERENCES `gerenciador`.`cargo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
