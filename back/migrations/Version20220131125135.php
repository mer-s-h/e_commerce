<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220131125135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD price_10ml DOUBLE PRECISION DEFAULT NULL, ADD price_30ml DOUBLE PRECISION DEFAULT NULL, ADD price_50ml DOUBLE PRECISION DEFAULT NULL, ADD price_100ml DOUBLE PRECISION DEFAULT NULL, ADD price_200ml DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP price_10ml, DROP price_30ml, DROP price_50ml, DROP price_100ml, DROP price_200ml');
    }
}
