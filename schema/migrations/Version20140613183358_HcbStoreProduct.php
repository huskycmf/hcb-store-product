<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20140613183357_HcbStoreProduct extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE IF NOT EXISTS `store_product_set` (
                          `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                          `price` SMALLINT UNSIGNED NOT NULL,
                          PRIMARY KEY (`id`))
                        ENGINE = InnoDB");
        
        $this->addSql("CREATE TABLE IF NOT EXISTS `store_product_set_has_product` (
                          `store_product_set_id` INT UNSIGNED NOT NULL,
                          `store_product_id` INT UNSIGNED NOT NULL,
                          PRIMARY KEY (`store_product_set_id`, `store_product_id`),
                          INDEX `fk_store_product_set_has_store_product_store_product1_idx`
                                (`store_product_id` ASC),
                          INDEX `fk_store_product_set_has_store_product_store_product_set1_idx`
                                (`store_product_set_id` ASC),
                          CONSTRAINT `fk_store_product_set_has_store_product_store_product_set1`
                            FOREIGN KEY (`store_product_set_id`)
                            REFERENCES `store_product_set` (`id`)
                            ON DELETE NO ACTION
                            ON UPDATE NO ACTION,
                          CONSTRAINT `fk_store_product_set_has_store_product_store_product1`
                            FOREIGN KEY (`store_product_id`)
                            REFERENCES `store_product` (`id`)
                            ON DELETE NO ACTION
                            ON UPDATE NO ACTION)
                        ENGINE = InnoDB");
    }

    public function down(Schema $schema)
    {
        $schema->dropTable('store_product_set');
        $schema->dropTable('store_product_set_has_product');
    }
}
