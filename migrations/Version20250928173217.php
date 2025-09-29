<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250928173217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game_version (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mod_game_version (mod_id INT NOT NULL, game_version_id INT NOT NULL, INDEX IDX_20868A00338E21CD (mod_id), INDEX IDX_20868A00A560E0E8 (game_version_id), PRIMARY KEY(mod_id, game_version_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mod_game_version ADD CONSTRAINT FK_20868A00338E21CD FOREIGN KEY (mod_id) REFERENCES mods (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mod_game_version ADD CONSTRAINT FK_20868A00A560E0E8 FOREIGN KEY (game_version_id) REFERENCES game_version (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mod_mod_version DROP FOREIGN KEY FK_275AC3DF338E21CD');
        $this->addSql('ALTER TABLE mod_mod_version DROP FOREIGN KEY FK_275AC3DFAB3BB838');
        $this->addSql('DROP TABLE mod_mod_version');
        $this->addSql('DROP TABLE mod_version');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mod_mod_version (mod_id INT NOT NULL, mod_version_id INT NOT NULL, INDEX IDX_275AC3DFAB3BB838 (mod_version_id), INDEX IDX_275AC3DF338E21CD (mod_id), PRIMARY KEY(mod_id, mod_version_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE mod_version (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE mod_mod_version ADD CONSTRAINT FK_275AC3DF338E21CD FOREIGN KEY (mod_id) REFERENCES mods (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mod_mod_version ADD CONSTRAINT FK_275AC3DFAB3BB838 FOREIGN KEY (mod_version_id) REFERENCES mod_version (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mod_game_version DROP FOREIGN KEY FK_20868A00338E21CD');
        $this->addSql('ALTER TABLE mod_game_version DROP FOREIGN KEY FK_20868A00A560E0E8');
        $this->addSql('DROP TABLE game_version');
        $this->addSql('DROP TABLE mod_game_version');
    }
}
