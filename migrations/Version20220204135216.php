<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220204135216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE planning_menu_detail ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE planning_menu_detail ADD CONSTRAINT FK_B06AE71212469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_B06AE71212469DE2 ON planning_menu_detail (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE planning_menu_detail DROP FOREIGN KEY FK_B06AE71212469DE2');
        $this->addSql('DROP INDEX IDX_B06AE71212469DE2 ON planning_menu_detail');
        $this->addSql('ALTER TABLE planning_menu_detail DROP category_id');
    }
}
