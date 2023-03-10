<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308153526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE external_location ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE external_location ADD CONSTRAINT FK_B1923B38A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B1923B38A76ED395 ON external_location (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE external_location DROP FOREIGN KEY FK_B1923B38A76ED395');
        $this->addSql('DROP INDEX IDX_B1923B38A76ED395 ON external_location');
        $this->addSql('ALTER TABLE external_location DROP user_id');
    }
}
