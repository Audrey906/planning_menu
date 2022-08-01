<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220801092017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dish_ingredient (id INT AUTO_INCREMENT NOT NULL, ingredient_id INT NOT NULL, dish_id INT NOT NULL, unity_id INT DEFAULT NULL, quantity DOUBLE PRECISION NOT NULL, INDEX IDX_77196056933FE08C (ingredient_id), INDEX IDX_77196056148EB0CB (dish_id), INDEX IDX_77196056F6859C8C (unity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_6BAF7870A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE preparation_time (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unity_ingredient (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dish_ingredient ADD CONSTRAINT FK_77196056933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE dish_ingredient ADD CONSTRAINT FK_77196056148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id)');
        $this->addSql('ALTER TABLE dish_ingredient ADD CONSTRAINT FK_77196056F6859C8C FOREIGN KEY (unity_id) REFERENCES unity_ingredient (id)');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF7870A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE dish ADD time_id INT DEFAULT NULL, ADD description LONGTEXT DEFAULT NULL, ADD image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE dish ADD CONSTRAINT FK_957D8CB85EEADD3B FOREIGN KEY (time_id) REFERENCES preparation_time (id)');
        $this->addSql('CREATE INDEX IDX_957D8CB85EEADD3B ON dish (time_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dish_ingredient DROP FOREIGN KEY FK_77196056933FE08C');
        $this->addSql('ALTER TABLE dish DROP FOREIGN KEY FK_957D8CB85EEADD3B');
        $this->addSql('ALTER TABLE dish_ingredient DROP FOREIGN KEY FK_77196056F6859C8C');
        $this->addSql('DROP TABLE dish_ingredient');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE preparation_time');
        $this->addSql('DROP TABLE unity_ingredient');
        $this->addSql('DROP INDEX IDX_957D8CB85EEADD3B ON dish');
        $this->addSql('ALTER TABLE dish DROP time_id, DROP description, DROP image');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
