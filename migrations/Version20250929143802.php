<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250929143802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mod_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mod_loader (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mod_mod_category (mod_id INT NOT NULL, mod_category_id INT NOT NULL, INDEX IDX_12D5039E338E21CD (mod_id), INDEX IDX_12D5039E4ACE566C (mod_category_id), PRIMARY KEY(mod_id, mod_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mod_mod_loader (mod_id INT NOT NULL, mod_loader_id INT NOT NULL, INDEX IDX_2B635234338E21CD (mod_id), INDEX IDX_2B635234B0A37116 (mod_loader_id), PRIMARY KEY(mod_id, mod_loader_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mod_mod_category ADD CONSTRAINT FK_12D5039E338E21CD FOREIGN KEY (mod_id) REFERENCES mods (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mod_mod_category ADD CONSTRAINT FK_12D5039E4ACE566C FOREIGN KEY (mod_category_id) REFERENCES mod_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mod_mod_loader ADD CONSTRAINT FK_2B635234338E21CD FOREIGN KEY (mod_id) REFERENCES mods (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mod_mod_loader ADD CONSTRAINT FK_2B635234B0A37116 FOREIGN KEY (mod_loader_id) REFERENCES mod_loader (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modfile ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE mods ADD deleted TINYINT(1) NOT NULL, DROP categories, DROP loaders');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mod_mod_category DROP FOREIGN KEY FK_12D5039E338E21CD');
        $this->addSql('ALTER TABLE mod_mod_category DROP FOREIGN KEY FK_12D5039E4ACE566C');
        $this->addSql('ALTER TABLE mod_mod_loader DROP FOREIGN KEY FK_2B635234338E21CD');
        $this->addSql('ALTER TABLE mod_mod_loader DROP FOREIGN KEY FK_2B635234B0A37116');
        $this->addSql('DROP TABLE mod_category');
        $this->addSql('DROP TABLE mod_loader');
        $this->addSql('DROP TABLE mod_mod_category');
        $this->addSql('DROP TABLE mod_mod_loader');
        $this->addSql('ALTER TABLE modFile DROP name');
        $this->addSql('ALTER TABLE mods ADD categories LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', ADD loaders JSON NOT NULL COMMENT \'(DC2Type:json)\', DROP deleted');
    }
}
