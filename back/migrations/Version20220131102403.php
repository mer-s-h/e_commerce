<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220131102403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adress (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, n_voie INT NOT NULL, rue VARCHAR(255) NOT NULL, complement_adress VARCHAR(255) DEFAULT NULL, code_postale INT NOT NULL, ville VARCHAR(255) NOT NULL, INDEX IDX_5CECC7BEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE credit_card (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, card_number BIGINT NOT NULL, card_firstname VARCHAR(255) NOT NULL, card_lastname VARCHAR(255) NOT NULL, expiration_date VARCHAR(255) NOT NULL, INDEX IDX_11D627EEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE opinion (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, product_id INT NOT NULL, remark VARCHAR(255) NOT NULL, rating INT NOT NULL, INDEX IDX_AB02B027A76ED395 (user_id), INDEX IDX_AB02B0274584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE price (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, price_10ml DOUBLE PRECISION DEFAULT NULL, price_30ml DOUBLE PRECISION DEFAULT NULL, price_50ml DOUBLE PRECISION DEFAULT NULL, price_100ml DOUBLE PRECISION DEFAULT NULL, price_200ml DOUBLE PRECISION DEFAULT NULL, INDEX IDX_CAC822D94584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adress ADD CONSTRAINT FK_5CECC7BEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE credit_card ADD CONSTRAINT FK_11D627EEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE opinion ADD CONSTRAINT FK_AB02B027A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE opinion ADD CONSTRAINT FK_AB02B0274584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D94584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE orders ADD adress_id INT NOT NULL, ADD status VARCHAR(255) DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE product_id product_id INT NOT NULL, CHANGE order_date order_date VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE8486F9AC FOREIGN KEY (adress_id) REFERENCES adress (id)');
        $this->addSql('CREATE INDEX IDX_E52FFDEE8486F9AC ON orders (adress_id)');
        $this->addSql('ALTER TABLE product ADD orders_id INT DEFAULT NULL, CHANGE description_product description_product LONGTEXT DEFAULT NULL, CHANGE reduction_product reduction_product INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADCFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADCFFE9AD6 ON product (orders_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles VARCHAR(180) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE8486F9AC');
        $this->addSql('DROP TABLE adress');
        $this->addSql('DROP TABLE credit_card');
        $this->addSql('DROP TABLE opinion');
        $this->addSql('DROP TABLE price');
        $this->addSql('DROP INDEX IDX_E52FFDEE8486F9AC ON orders');
        $this->addSql('ALTER TABLE orders DROP adress_id, DROP status, CHANGE user_id user_id INT NOT NULL, CHANGE product_id product_id INT DEFAULT NULL, CHANGE order_date order_date DATE NOT NULL');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADCFFE9AD6');
        $this->addSql('DROP INDEX IDX_D34A04ADCFFE9AD6 ON product');
        $this->addSql('ALTER TABLE product DROP orders_id, CHANGE description_product description_product VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reduction_product reduction_product INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }
}
