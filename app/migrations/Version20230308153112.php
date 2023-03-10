<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308153112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE internal_location_material (internal_location_id INT NOT NULL, material_id INT NOT NULL, INDEX IDX_FA804A7B3322610B (internal_location_id), INDEX IDX_FA804A7BE308AC6F (material_id), PRIMARY KEY(internal_location_id, material_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE internal_location_material ADD CONSTRAINT FK_FA804A7B3322610B FOREIGN KEY (internal_location_id) REFERENCES internal_location (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location_material ADD CONSTRAINT FK_FA804A7BE308AC6F FOREIGN KEY (material_id) REFERENCES material (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE internal_location_material DROP FOREIGN KEY FK_FA804A7B3322610B');
        $this->addSql('ALTER TABLE internal_location_material DROP FOREIGN KEY FK_FA804A7BE308AC6F');
        $this->addSql('DROP TABLE internal_location_material');
    }
}
