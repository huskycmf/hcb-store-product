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
        $this->addSql("ALTER TABLE `store_product_label` ADD COLUMN `priority`
                        TINYINT(3) UNSIGNED NOT NULL DEFAULT 1 AFTER `id`;");
    }

    public function down(Schema $schema)
    {
        $schema->getTable('store_product_label')->dropColumn('priority');
    }
}
