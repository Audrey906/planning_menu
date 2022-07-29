<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220728172727 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, category_name VARCHAR(255) NOT NULL, category_visible TINYINT(1) NOT NULL, INDEX IDX_64C19C1727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE day (id INT AUTO_INCREMENT NOT NULL, day_name VARCHAR(255) NOT NULL, day_small_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dish (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, user_id INT NOT NULL, dish_name VARCHAR(255) NOT NULL, INDEX IDX_957D8CB812469DE2 (category_id), INDEX IDX_957D8CB8A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE period (id INT AUTO_INCREMENT NOT NULL, period_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planning_menu (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, type_id INT DEFAULT NULL, planning_name VARCHAR(255) NOT NULL, planning_created_date DATETIME NOT NULL, INDEX IDX_B5D332DDA76ED395 (user_id), INDEX IDX_B5D332DDC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planning_menu_detail (id INT AUTO_INCREMENT NOT NULL, planning_menu_id INT NOT NULL, day_id INT NOT NULL, period_id INT NOT NULL, category_id INT NOT NULL, dish_id INT NOT NULL, week_id INT NOT NULL, INDEX IDX_B06AE71211BAB4F9 (planning_menu_id), INDEX IDX_B06AE7129C24126 (day_id), INDEX IDX_B06AE712EC8B7ADE (period_id), INDEX IDX_B06AE71212469DE2 (category_id), INDEX IDX_B06AE712148EB0CB (dish_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE dish ADD CONSTRAINT FK_957D8CB812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE dish ADD CONSTRAINT FK_957D8CB8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE planning_menu ADD CONSTRAINT FK_B5D332DDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE planning_menu ADD CONSTRAINT FK_B5D332DDC54C8C93 FOREIGN KEY (type_id) REFERENCES period (id)');
        $this->addSql('ALTER TABLE planning_menu_detail ADD CONSTRAINT FK_B06AE71211BAB4F9 FOREIGN KEY (planning_menu_id) REFERENCES planning_menu (id)');
        $this->addSql('ALTER TABLE planning_menu_detail ADD CONSTRAINT FK_B06AE7129C24126 FOREIGN KEY (day_id) REFERENCES day (id)');
        $this->addSql('ALTER TABLE planning_menu_detail ADD CONSTRAINT FK_B06AE712EC8B7ADE FOREIGN KEY (period_id) REFERENCES period (id)');
        $this->addSql('ALTER TABLE planning_menu_detail ADD CONSTRAINT FK_B06AE71212469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE planning_menu_detail ADD CONSTRAINT FK_B06AE712148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('ALTER TABLE dish DROP FOREIGN KEY FK_957D8CB812469DE2');
        $this->addSql('ALTER TABLE planning_menu_detail DROP FOREIGN KEY FK_B06AE71212469DE2');
        $this->addSql('ALTER TABLE planning_menu_detail DROP FOREIGN KEY FK_B06AE7129C24126');
        $this->addSql('ALTER TABLE planning_menu_detail DROP FOREIGN KEY FK_B06AE712148EB0CB');
        $this->addSql('ALTER TABLE planning_menu DROP FOREIGN KEY FK_B5D332DDC54C8C93');
        $this->addSql('ALTER TABLE planning_menu_detail DROP FOREIGN KEY FK_B06AE712EC8B7ADE');
        $this->addSql('ALTER TABLE planning_menu_detail DROP FOREIGN KEY FK_B06AE71211BAB4F9');
        $this->addSql('ALTER TABLE dish DROP FOREIGN KEY FK_957D8CB8A76ED395');
        $this->addSql('ALTER TABLE planning_menu DROP FOREIGN KEY FK_B5D332DDA76ED395');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE day');
        $this->addSql('DROP TABLE dish');
        $this->addSql('DROP TABLE period');
        $this->addSql('DROP TABLE planning_menu');
        $this->addSql('DROP TABLE planning_menu_detail');
        $this->addSql('DROP TABLE user');
    }
}
