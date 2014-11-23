<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20141122000000_HcbStoreProduct extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE  `store_product_localized_page` CHANGE  `url`  `url` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE  `store_product_localized_page` CHANGE  `url`  `url` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL");
    }
}
