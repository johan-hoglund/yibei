<?php
	class VersioningPatchRecipeRestructure implements VersioningPatch
	{
		public static function get_version()
		{
			return 19;
		}

		public static function execute()
		{
			mysql_query('CREATE TABLE  `yibei`.`IngredientListMembers` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`list_id` INT NOT NULL ,
			`commodity_id` INT NOT NULL ,
			`amount` DECIMAL( 10, 2 ) NOT NULL ,
			`unit` VARCHAR( 20 ) NOT NULL ,
			`substitute_for` INT
			) ENGINE = MYISAM ;');


			mysql_query('CREATE TABLE  `yibei`.`IngredientLists` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY
			) ENGINE = INNODB;');

			mysql_query('CREATE TABLE  `yibei`.`RecipeIngredientLists` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`recipe_id` INT NOT NULL ,
			`list_id` INT NOT NULL ,
			`order` INT NOT NULL ,
			`label` VARCHAR( 25 ) NOT NULL
			) ENGINE = INNODB;
			');

			mysql_query('RENAME TABLE  `yibei`.`Recipies` TO  `yibei`.`Recipes` ;');

			mysql_query('ALTER TABLE  `Recipes` ADD  `description` TEXT NOT NULL , ADD  `hints` TEXT NOT NULL');
		}
	}
