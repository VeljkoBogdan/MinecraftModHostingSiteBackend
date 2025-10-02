<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251002105508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mod_file_game_version (mod_file_id INT NOT NULL, game_version_id INT NOT NULL, INDEX IDX_797D5AD85305A2FE (mod_file_id), INDEX IDX_797D5AD8A560E0E8 (game_version_id), PRIMARY KEY(mod_file_id, game_version_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mod_file_game_version ADD CONSTRAINT FK_797D5AD85305A2FE FOREIGN KEY (mod_file_id) REFERENCES modFile (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mod_file_game_version ADD CONSTRAINT FK_797D5AD8A560E0E8 FOREIGN KEY (game_version_id) REFERENCES game_version (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mod_file_game_version DROP FOREIGN KEY FK_797D5AD85305A2FE');
        $this->addSql('ALTER TABLE mod_file_game_version DROP FOREIGN KEY FK_797D5AD8A560E0E8');
        $this->addSql('DROP TABLE mod_file_game_version');
    }
}
