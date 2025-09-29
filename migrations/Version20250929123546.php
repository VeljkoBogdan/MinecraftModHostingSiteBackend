<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250929123546 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE modFile (id INT AUTO_INCREMENT NOT NULL, mod_entity_id INT DEFAULT NULL, mod_version VARCHAR(255) NOT NULL, changelog VARCHAR(255) NOT NULL, checksum VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_EFF4D86BD3535E57 (mod_entity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE modFile ADD CONSTRAINT FK_EFF4D86BD3535E57 FOREIGN KEY (mod_entity_id) REFERENCES mods (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mods ADD description VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE modFile DROP FOREIGN KEY FK_EFF4D86BD3535E57');
        $this->addSql('DROP TABLE modFile');
        $this->addSql('ALTER TABLE mods DROP description');
    }
}
