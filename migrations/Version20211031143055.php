<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211031143055 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE planning_menu (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, planning_name VARCHAR(255) NOT NULL, planning_created_date DATETIME NOT NULL, INDEX IDX_B5D332DDA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planning_menu_detail (id INT AUTO_INCREMENT NOT NULL, planning_menu_id INT NOT NULL, day_id INT NOT NULL, period_id INT NOT NULL, week_id INT NOT NULL, INDEX IDX_B06AE71211BAB4F9 (planning_menu_id), INDEX IDX_B06AE7129C24126 (day_id), INDEX IDX_B06AE712EC8B7ADE (period_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE planning_menu ADD CONSTRAINT FK_B5D332DDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE planning_menu_detail ADD CONSTRAINT FK_B06AE71211BAB4F9 FOREIGN KEY (planning_menu_id) REFERENCES planning_menu (id)');
        $this->addSql('ALTER TABLE planning_menu_detail ADD CONSTRAINT FK_B06AE7129C24126 FOREIGN KEY (day_id) REFERENCES day (id)');
        $this->addSql('ALTER TABLE planning_menu_detail ADD CONSTRAINT FK_B06AE712EC8B7ADE FOREIGN KEY (period_id) REFERENCES period (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE planning_menu_detail DROP FOREIGN KEY FK_B06AE71211BAB4F9');
        $this->addSql('DROP TABLE planning_menu');
        $this->addSql('DROP TABLE planning_menu_detail');
    }
}
