<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20140613183358_HcbStoreProduct extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE `store_product_selection` (
                          `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                          `image_id` INT UNSIGNED NULL,
                          `price` SMALLINT UNSIGNED NOT NULL,
                          PRIMARY KEY (`id`),
                          INDEX `fk_store_product_selection_image1_idx` (`image_id` ASC),
                          CONSTRAINT `fk_store_product_selection_image1`
                            FOREIGN KEY (`image_id`)
                            REFERENCES `image` (`id`)
                            ON DELETE SET NULL
                            ON UPDATE SET NULL)
                        ENGINE = InnoDB");

        $this->addSql("CREATE TABLE `store_product_selection_has_product` (
                          `store_product_selection_id` INT UNSIGNED NOT NULL,
                          `store_product_id` INT UNSIGNED NOT NULL,
                          PRIMARY KEY (`store_product_selection_id`, `store_product_id`),
                          INDEX `fk_store_product_selection_has_store_product_store_product1_idx`
                                (`store_product_id` ASC),
                          INDEX `fk_store_product_selection_has_store_product_store_product__idx`
                                (`store_product_selection_id` ASC),
                          CONSTRAINT `fk_store_product_selection_has_store_product_store_product_se1`
                            FOREIGN KEY (`store_product_selection_id`)
                            REFERENCES `store_product_selection` (`id`)
                            ON DELETE CASCADE
                            ON UPDATE CASCADE,
                          CONSTRAINT `fk_store_product_selection_has_store_product_store_product1`
                            FOREIGN KEY (`store_product_id`)
                            REFERENCES `store_product` (`id`)
                            ON DELETE CASCADE
                            ON UPDATE CASCADE)
                        ENGINE = InnoDB");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE `store_product_selection`");
        $this->addSql("DROP TABLE `store_product_selection_has_product`");
    }
}
