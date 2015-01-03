<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20150102010000_HcbStoreProduct extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE  `store_product_localized_page` DROP FOREIGN KEY  `fk_store_product_localized_page_store_product_localized1` ,
ADD FOREIGN KEY (  `store_product_localized_id` ) REFERENCES  `common`.`store_product_localized` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;");
        $this->addSql("ALTER TABLE  `store_product_category_has_product` DROP FOREIGN KEY  `fk_store_product_category_has_store_product_store_product_cat1` ,
ADD FOREIGN KEY (  `store_product_category_id` ) REFERENCES  `common`.`store_product_category` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;

ALTER TABLE  `store_product_category_has_product` DROP FOREIGN KEY  `fk_store_product_category_has_store_product_store_product1` ,
ADD FOREIGN KEY (  `store_product_id` ) REFERENCES  `common`.`store_product` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;");
        $this->addSql("ALTER TABLE  `store_product_has_alias` DROP FOREIGN KEY  `fk_store_product_has_alias_store_product1` ,
ADD FOREIGN KEY (  `store_product_id` ) REFERENCES  `common`.`store_product` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;

ALTER TABLE  `store_product_has_alias` DROP FOREIGN KEY  `fk_store_product_has_alias_alias1` ,
ADD FOREIGN KEY (  `alias_id` ) REFERENCES  `common`.`alias` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE  `store_product_localized_page` DROP FOREIGN KEY  `store_product_localized_page_ibfk_1` ,
ADD FOREIGN KEY (  `store_product_localized_id` ) REFERENCES  `common`.`store_product_localized` (
`id`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;");
        $this->addSql("ALTER TABLE  `store_product_category_has_product` DROP FOREIGN KEY  `store_product_category_has_product_ibfk_1` ,
ADD FOREIGN KEY (  `store_product_category_id` ) REFERENCES  `common`.`store_product_category` (
`id`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;

ALTER TABLE  `store_product_category_has_product` DROP FOREIGN KEY  `store_product_category_has_product_ibfk_2` ,
ADD FOREIGN KEY (  `store_product_id` ) REFERENCES  `common`.`store_product` (
`id`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;");
        $this->addSql("ALTER TABLE  `store_product_has_alias` DROP FOREIGN KEY  `store_product_has_alias_ibfk_1` ,
ADD FOREIGN KEY (  `store_product_id` ) REFERENCES  `common`.`store_product` (
`id`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;

ALTER TABLE  `store_product_has_alias` DROP FOREIGN KEY  `store_product_has_alias_ibfk_2` ,
ADD FOREIGN KEY (  `alias_id` ) REFERENCES  `common`.`alias` (
`id`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;");
    }
}
