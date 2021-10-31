<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211031084919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1D356F0B5');
        $this->addSql('DROP INDEX IDX_64C19C1D356F0B5 ON category');
        $this->addSql('ALTER TABLE category DROP category_dish_id');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_64C19C1727ACA70 ON category (parent_id)');
        $this->addSql('ALTER TABLE dish DROP FOREIGN KEY FK_957D8CB89D86650F');
        $this->addSql('DROP INDEX UNIQ_957D8CB89D86650F ON dish');
        $this->addSql('ALTER TABLE dish ADD user_id INT NOT NULL, CHANGE user_id_id category_id INT NOT NULL');
        $this->addSql('ALTER TABLE dish ADD CONSTRAINT FK_957D8CB812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE dish ADD CONSTRAINT FK_957D8CB8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_957D8CB812469DE2 ON dish (category_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957D8CB8A76ED395 ON dish (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('DROP INDEX IDX_64C19C1727ACA70 ON category');
        $this->addSql('ALTER TABLE category ADD category_dish_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1D356F0B5 FOREIGN KEY (category_dish_id) REFERENCES dish (id)');
        $this->addSql('CREATE INDEX IDX_64C19C1D356F0B5 ON category (category_dish_id)');
        $this->addSql('ALTER TABLE dish DROP FOREIGN KEY FK_957D8CB812469DE2');
        $this->addSql('ALTER TABLE dish DROP FOREIGN KEY FK_957D8CB8A76ED395');
        $this->addSql('DROP INDEX IDX_957D8CB812469DE2 ON dish');
        $this->addSql('DROP INDEX UNIQ_957D8CB8A76ED395 ON dish');
        $this->addSql('ALTER TABLE dish ADD user_id_id INT NOT NULL, DROP category_id, DROP user_id');
        $this->addSql('ALTER TABLE dish ADD CONSTRAINT FK_957D8CB89D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957D8CB89D86650F ON dish (user_id_id)');
    }
}
