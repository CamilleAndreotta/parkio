<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230310200014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE material DROP FOREIGN KEY FK_7CBE759512469DE2');
        $this->addSql('ALTER TABLE material DROP FOREIGN KEY FK_7CBE75956BF700BD');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP INDEX IDX_7CBE75956BF700BD ON material');
        $this->addSql('DROP INDEX IDX_7CBE759512469DE2 ON material');
        $this->addSql('ALTER TABLE material ADD category VARCHAR(255) NOT NULL, ADD status VARCHAR(255) NOT NULL, DROP category_id, DROP status_id, CHANGE affectation affectation VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE material ADD category_id INT DEFAULT NULL, ADD status_id INT DEFAULT NULL, DROP category, DROP status, CHANGE affectation affectation VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE759512469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE75956BF700BD FOREIGN KEY (status_id) REFERENCES status (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_7CBE75956BF700BD ON material (status_id)');
        $this->addSql('CREATE INDEX IDX_7CBE759512469DE2 ON material (category_id)');
    }
}
