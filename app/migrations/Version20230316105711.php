<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230316105711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE external_location ADD laptop_id INT DEFAULT NULL, ADD mouse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE external_location ADD CONSTRAINT FK_B1923B38D59905E5 FOREIGN KEY (laptop_id) REFERENCES laptop (id)');
        $this->addSql('ALTER TABLE external_location ADD CONSTRAINT FK_B1923B3823574B71 FOREIGN KEY (mouse_id) REFERENCES mouse (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B1923B38D59905E5 ON external_location (laptop_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B1923B3823574B71 ON external_location (mouse_id)');
        $this->addSql('ALTER TABLE keyboard DROP affectation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE keyboard ADD affectation VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE external_location DROP FOREIGN KEY FK_B1923B38D59905E5');
        $this->addSql('ALTER TABLE external_location DROP FOREIGN KEY FK_B1923B3823574B71');
        $this->addSql('DROP INDEX UNIQ_B1923B38D59905E5 ON external_location');
        $this->addSql('DROP INDEX UNIQ_B1923B3823574B71 ON external_location');
        $this->addSql('ALTER TABLE external_location DROP laptop_id, DROP mouse_id');
    }
}
