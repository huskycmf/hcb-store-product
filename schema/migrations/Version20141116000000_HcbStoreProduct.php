<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20141116000000_HcbStoreProduct extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE  `store_product_image`
                       DROP FOREIGN KEY  `fk_store_product_image_image1` ,
                       ADD FOREIGN KEY (  `image_id` )
                       REFERENCES  `image` (`id`)
                       ON DELETE CASCADE ON UPDATE CASCADE ;
                       ALTER TABLE  `store_product_image`
                       DROP FOREIGN KEY  `fk_store_product_image_store_product1` ,
                       ADD FOREIGN KEY (  `store_product_id` )
                       REFERENCES  `store_product` (`id`)
                       ON DELETE CASCADE ON UPDATE CASCADE ;");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE `store_product_image`
                       DROP FOREIGN KEY `store_product_image_ibfk_1`,
                       ADD FOREIGN KEY (`image_id`)
                       REFERENCES `image`(`id`)
                       ON DELETE NO ACTION ON UPDATE NO ACTION;
                       ALTER TABLE `store_product_image`
                       DROP FOREIGN KEY `store_product_image_ibfk_2`,
                       ADD FOREIGN KEY (`store_product_id`)
                       REFERENCES `store_product`(`id`)
                       ON DELETE NO ACTION ON UPDATE NO ACTION;");
    }
}
