<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230311133915 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE computer (id INT AUTO_INCREMENT NOT NULL, model VARCHAR(255) NOT NULL, serial_number VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, purchase_date DATE NOT NULL, affectation VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE external_location (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, external_user VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, message LONGTEXT DEFAULT NULL, date_start DATE NOT NULL, date_end DATE NOT NULL, INDEX IDX_B1923B38A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE external_location_laptop (external_location_id INT NOT NULL, laptop_id INT NOT NULL, INDEX IDX_E20BF06C6E8A6CF9 (external_location_id), INDEX IDX_E20BF06CD59905E5 (laptop_id), PRIMARY KEY(external_location_id, laptop_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE external_location_mouse (external_location_id INT NOT NULL, mouse_id INT NOT NULL, INDEX IDX_C800EB2E6E8A6CF9 (external_location_id), INDEX IDX_C800EB2E23574B71 (mouse_id), PRIMARY KEY(external_location_id, mouse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE external_location_keyboard (external_location_id INT NOT NULL, keyboard_id INT NOT NULL, INDEX IDX_493B4FD16E8A6CF9 (external_location_id), INDEX IDX_493B4FD1F17292C6 (keyboard_id), PRIMARY KEY(external_location_id, keyboard_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE internal_location (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, date_start DATE NOT NULL, date_end DATE DEFAULT NULL, information LONGTEXT DEFAULT NULL, INDEX IDX_913C0413A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE internal_location_laptop (internal_location_id INT NOT NULL, laptop_id INT NOT NULL, INDEX IDX_B5B8A6BB3322610B (internal_location_id), INDEX IDX_B5B8A6BBD59905E5 (laptop_id), PRIMARY KEY(internal_location_id, laptop_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE internal_location_computer (internal_location_id INT NOT NULL, computer_id INT NOT NULL, INDEX IDX_24A698483322610B (internal_location_id), INDEX IDX_24A69848A426D518 (computer_id), PRIMARY KEY(internal_location_id, computer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE internal_location_monitor (internal_location_id INT NOT NULL, monitor_id INT NOT NULL, INDEX IDX_CF8A3553322610B (internal_location_id), INDEX IDX_CF8A3554CE1C902 (monitor_id), PRIMARY KEY(internal_location_id, monitor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE internal_location_videoprojector (internal_location_id INT NOT NULL, videoprojector_id INT NOT NULL, INDEX IDX_27A89C5B3322610B (internal_location_id), INDEX IDX_27A89C5B9DFDD8E8 (videoprojector_id), PRIMARY KEY(internal_location_id, videoprojector_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE internal_location_mouse (internal_location_id INT NOT NULL, mouse_id INT NOT NULL, INDEX IDX_13E3195A3322610B (internal_location_id), INDEX IDX_13E3195A23574B71 (mouse_id), PRIMARY KEY(internal_location_id, mouse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE internal_location_keyboard (internal_location_id INT NOT NULL, keyboard_id INT NOT NULL, INDEX IDX_54ABF7B3322610B (internal_location_id), INDEX IDX_54ABF7BF17292C6 (keyboard_id), PRIMARY KEY(internal_location_id, keyboard_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE keyboard (id INT AUTO_INCREMENT NOT NULL, model VARCHAR(255) NOT NULL, affectation VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE laptop (id INT AUTO_INCREMENT NOT NULL, model VARCHAR(255) NOT NULL, serial_number VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, purchase_date DATE NOT NULL, affectation VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE monitor (id INT AUTO_INCREMENT NOT NULL, model VARCHAR(255) NOT NULL, purchase_date DATE NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mouse (id INT AUTO_INCREMENT NOT NULL, model VARCHAR(255) NOT NULL, affectation VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, internal_user VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE videoprojector (id INT AUTO_INCREMENT NOT NULL, model VARCHAR(255) NOT NULL, purchase_date DATE NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE external_location ADD CONSTRAINT FK_B1923B38A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE external_location_laptop ADD CONSTRAINT FK_E20BF06C6E8A6CF9 FOREIGN KEY (external_location_id) REFERENCES external_location (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE external_location_laptop ADD CONSTRAINT FK_E20BF06CD59905E5 FOREIGN KEY (laptop_id) REFERENCES laptop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE external_location_mouse ADD CONSTRAINT FK_C800EB2E6E8A6CF9 FOREIGN KEY (external_location_id) REFERENCES external_location (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE external_location_mouse ADD CONSTRAINT FK_C800EB2E23574B71 FOREIGN KEY (mouse_id) REFERENCES mouse (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE external_location_keyboard ADD CONSTRAINT FK_493B4FD16E8A6CF9 FOREIGN KEY (external_location_id) REFERENCES external_location (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE external_location_keyboard ADD CONSTRAINT FK_493B4FD1F17292C6 FOREIGN KEY (keyboard_id) REFERENCES keyboard (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location ADD CONSTRAINT FK_913C0413A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE internal_location_laptop ADD CONSTRAINT FK_B5B8A6BB3322610B FOREIGN KEY (internal_location_id) REFERENCES internal_location (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location_laptop ADD CONSTRAINT FK_B5B8A6BBD59905E5 FOREIGN KEY (laptop_id) REFERENCES laptop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location_computer ADD CONSTRAINT FK_24A698483322610B FOREIGN KEY (internal_location_id) REFERENCES internal_location (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location_computer ADD CONSTRAINT FK_24A69848A426D518 FOREIGN KEY (computer_id) REFERENCES computer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location_monitor ADD CONSTRAINT FK_CF8A3553322610B FOREIGN KEY (internal_location_id) REFERENCES internal_location (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location_monitor ADD CONSTRAINT FK_CF8A3554CE1C902 FOREIGN KEY (monitor_id) REFERENCES monitor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location_videoprojector ADD CONSTRAINT FK_27A89C5B3322610B FOREIGN KEY (internal_location_id) REFERENCES internal_location (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location_videoprojector ADD CONSTRAINT FK_27A89C5B9DFDD8E8 FOREIGN KEY (videoprojector_id) REFERENCES videoprojector (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location_mouse ADD CONSTRAINT FK_13E3195A3322610B FOREIGN KEY (internal_location_id) REFERENCES internal_location (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location_mouse ADD CONSTRAINT FK_13E3195A23574B71 FOREIGN KEY (mouse_id) REFERENCES mouse (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location_keyboard ADD CONSTRAINT FK_54ABF7B3322610B FOREIGN KEY (internal_location_id) REFERENCES internal_location (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location_keyboard ADD CONSTRAINT FK_54ABF7BF17292C6 FOREIGN KEY (keyboard_id) REFERENCES keyboard (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE external_location DROP FOREIGN KEY FK_B1923B38A76ED395');
        $this->addSql('ALTER TABLE external_location_laptop DROP FOREIGN KEY FK_E20BF06C6E8A6CF9');
        $this->addSql('ALTER TABLE external_location_laptop DROP FOREIGN KEY FK_E20BF06CD59905E5');
        $this->addSql('ALTER TABLE external_location_mouse DROP FOREIGN KEY FK_C800EB2E6E8A6CF9');
        $this->addSql('ALTER TABLE external_location_mouse DROP FOREIGN KEY FK_C800EB2E23574B71');
        $this->addSql('ALTER TABLE external_location_keyboard DROP FOREIGN KEY FK_493B4FD16E8A6CF9');
        $this->addSql('ALTER TABLE external_location_keyboard DROP FOREIGN KEY FK_493B4FD1F17292C6');
        $this->addSql('ALTER TABLE internal_location DROP FOREIGN KEY FK_913C0413A76ED395');
        $this->addSql('ALTER TABLE internal_location_laptop DROP FOREIGN KEY FK_B5B8A6BB3322610B');
        $this->addSql('ALTER TABLE internal_location_laptop DROP FOREIGN KEY FK_B5B8A6BBD59905E5');
        $this->addSql('ALTER TABLE internal_location_computer DROP FOREIGN KEY FK_24A698483322610B');
        $this->addSql('ALTER TABLE internal_location_computer DROP FOREIGN KEY FK_24A69848A426D518');
        $this->addSql('ALTER TABLE internal_location_monitor DROP FOREIGN KEY FK_CF8A3553322610B');
        $this->addSql('ALTER TABLE internal_location_monitor DROP FOREIGN KEY FK_CF8A3554CE1C902');
        $this->addSql('ALTER TABLE internal_location_videoprojector DROP FOREIGN KEY FK_27A89C5B3322610B');
        $this->addSql('ALTER TABLE internal_location_videoprojector DROP FOREIGN KEY FK_27A89C5B9DFDD8E8');
        $this->addSql('ALTER TABLE internal_location_mouse DROP FOREIGN KEY FK_13E3195A3322610B');
        $this->addSql('ALTER TABLE internal_location_mouse DROP FOREIGN KEY FK_13E3195A23574B71');
        $this->addSql('ALTER TABLE internal_location_keyboard DROP FOREIGN KEY FK_54ABF7B3322610B');
        $this->addSql('ALTER TABLE internal_location_keyboard DROP FOREIGN KEY FK_54ABF7BF17292C6');
        $this->addSql('DROP TABLE computer');
        $this->addSql('DROP TABLE external_location');
        $this->addSql('DROP TABLE external_location_laptop');
        $this->addSql('DROP TABLE external_location_mouse');
        $this->addSql('DROP TABLE external_location_keyboard');
        $this->addSql('DROP TABLE internal_location');
        $this->addSql('DROP TABLE internal_location_laptop');
        $this->addSql('DROP TABLE internal_location_computer');
        $this->addSql('DROP TABLE internal_location_monitor');
        $this->addSql('DROP TABLE internal_location_videoprojector');
        $this->addSql('DROP TABLE internal_location_mouse');
        $this->addSql('DROP TABLE internal_location_keyboard');
        $this->addSql('DROP TABLE keyboard');
        $this->addSql('DROP TABLE laptop');
        $this->addSql('DROP TABLE monitor');
        $this->addSql('DROP TABLE mouse');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE videoprojector');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
