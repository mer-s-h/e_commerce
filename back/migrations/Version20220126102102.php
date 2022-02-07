<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220126102102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE credit_card DROP cvv');
        $this->addSql('ALTER TABLE orders ADD status VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE quantity_product quantity_product INT NOT NULL, CHANGE price_product reduction_product INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE credit_card ADD cvv VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE orders DROP status');
        $this->addSql('ALTER TABLE product CHANGE quantity_product quantity_product INT DEFAULT NULL, CHANGE reduction_product price_product INT NOT NULL');
    }
}
