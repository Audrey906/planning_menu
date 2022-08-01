<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220731160332 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dish DROP FOREIGN KEY FK_957D8CB8A76ED395');
        $this->addSql('ALTER TABLE dish ADD CONSTRAINT FK_957D8CB8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE planning_menu DROP FOREIGN KEY FK_B5D332DDA76ED395');
        $this->addSql('ALTER TABLE planning_menu ADD CONSTRAINT FK_B5D332DDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE planning_menu_detail DROP FOREIGN KEY FK_B06AE71211BAB4F9');
        $this->addSql('ALTER TABLE planning_menu_detail DROP FOREIGN KEY FK_B06AE712148EB0CB');
        $this->addSql('ALTER TABLE planning_menu_detail ADD CONSTRAINT FK_B06AE71211BAB4F9 FOREIGN KEY (planning_menu_id) REFERENCES planning_menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE planning_menu_detail ADD CONSTRAINT FK_B06AE712148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dish DROP FOREIGN KEY FK_957D8CB8A76ED395');
        $this->addSql('ALTER TABLE dish ADD CONSTRAINT FK_957D8CB8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE planning_menu DROP FOREIGN KEY FK_B5D332DDA76ED395');
        $this->addSql('ALTER TABLE planning_menu ADD CONSTRAINT FK_B5D332DDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE planning_menu_detail DROP FOREIGN KEY FK_B06AE71211BAB4F9');
        $this->addSql('ALTER TABLE planning_menu_detail DROP FOREIGN KEY FK_B06AE712148EB0CB');
        $this->addSql('ALTER TABLE planning_menu_detail ADD CONSTRAINT FK_B06AE71211BAB4F9 FOREIGN KEY (planning_menu_id) REFERENCES planning_menu (id)');
        $this->addSql('ALTER TABLE planning_menu_detail ADD CONSTRAINT FK_B06AE712148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id)');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
