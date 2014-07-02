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
        $this->addSql("CREATE TABLE IF NOT EXISTS `store_product_kit` (
                          `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                          `price` SMALLINT UNSIGNED NOT NULL,
                          PRIMARY KEY (`id`))
                        ENGINE = InnoDB");

        $this->addSql("CREATE TABLE IF NOT EXISTS `store_product_kit_has_product` (
                          `store_product_kit_id` INT UNSIGNED NOT NULL,
                          `store_product_id` INT UNSIGNED NOT NULL,
                          PRIMARY KEY (`store_product_kit_id`, `store_product_id`),
                          INDEX `fk_store_product_kit_has_store_product_store_product1_idx`
                                (`store_product_id` ASC),
                          INDEX `fk_store_product_kit_has_store_product_store_product_kit1_idx`
                                (`store_product_kit_id` ASC),
                          CONSTRAINT `fk_store_product_kit_has_store_product_store_product_kit1`
                            FOREIGN KEY (`store_product_kit_id`)
                            REFERENCES `store_product_kit` (`id`)
                            ON DELETE NO ACTION
                            ON UPDATE NO ACTION,
                          CONSTRAINT `fk_store_product_kit_has_store_product_store_product1`
                            FOREIGN KEY (`store_product_id`)
                            REFERENCES `store_product` (`id`)
                            ON DELETE CASCADE
                            ON UPDATE CASCADE)
                        ENGINE = InnoDB");

        $this->addSql("CREATE TABLE IF NOT EXISTS `store_product_kit_has_image` (
                          `store_product_kit_id` INT UNSIGNED NOT NULL,
                          `image_id` INT UNSIGNED NOT NULL,
                          PRIMARY KEY (`store_product_kit_id`, `image_id`),
                          INDEX `fk_store_product_kit_has_image_image1_idx` (`image_id` ASC),
                          INDEX `fk_store_product_kit_has_image_store_product_kit1_idx`
                                (`store_product_kit_id` ASC),
                          CONSTRAINT `fk_store_product_kit_has_image_store_product_kit1`
                            FOREIGN KEY (`store_product_kit_id`)
                            REFERENCES `store_product_kit` (`id`)
                            ON DELETE CASCADE
                            ON UPDATE CASCADE,
                          CONSTRAINT `fk_store_product_kit_has_image_image1`
                            FOREIGN KEY (`image_id`)
                            REFERENCES `image` (`id`)
                            ON DELETE CASCADE
                            ON UPDATE CASCADE)
                        ENGINE = InnoDB");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE `store_product_kit`");
        $this->addSql("DROP TABLE `store_product_kit_has_product`");
        $this->addSql("DROP TABLE `store_product_kit_has_image`");
    }
}
