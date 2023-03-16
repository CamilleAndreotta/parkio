<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230316104611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE internal_location_laptop DROP FOREIGN KEY FK_B5B8A6BBD59905E5');
        $this->addSql('ALTER TABLE internal_location_laptop DROP FOREIGN KEY FK_B5B8A6BB3322610B');
        $this->addSql('ALTER TABLE internal_location_keyboard DROP FOREIGN KEY FK_54ABF7BF17292C6');
        $this->addSql('ALTER TABLE internal_location_keyboard DROP FOREIGN KEY FK_54ABF7B3322610B');
        $this->addSql('ALTER TABLE internal_location_computer DROP FOREIGN KEY FK_24A69848A426D518');
        $this->addSql('ALTER TABLE internal_location_computer DROP FOREIGN KEY FK_24A698483322610B');
        $this->addSql('ALTER TABLE internal_location_monitor DROP FOREIGN KEY FK_CF8A3554CE1C902');
        $this->addSql('ALTER TABLE internal_location_monitor DROP FOREIGN KEY FK_CF8A3553322610B');
        $this->addSql('ALTER TABLE internal_location_mouse DROP FOREIGN KEY FK_13E3195A23574B71');
        $this->addSql('ALTER TABLE internal_location_mouse DROP FOREIGN KEY FK_13E3195A3322610B');
        $this->addSql('ALTER TABLE internal_location_videoprojector DROP FOREIGN KEY FK_27A89C5B9DFDD8E8');
        $this->addSql('ALTER TABLE internal_location_videoprojector DROP FOREIGN KEY FK_27A89C5B3322610B');
        $this->addSql('ALTER TABLE external_location_mouse DROP FOREIGN KEY FK_C800EB2E6E8A6CF9');
        $this->addSql('ALTER TABLE external_location_mouse DROP FOREIGN KEY FK_C800EB2E23574B71');
        $this->addSql('ALTER TABLE external_location_laptop DROP FOREIGN KEY FK_E20BF06CD59905E5');
        $this->addSql('ALTER TABLE external_location_laptop DROP FOREIGN KEY FK_E20BF06C6E8A6CF9');
        $this->addSql('ALTER TABLE external_location_keyboard DROP FOREIGN KEY FK_493B4FD1F17292C6');
        $this->addSql('ALTER TABLE external_location_keyboard DROP FOREIGN KEY FK_493B4FD16E8A6CF9');
        $this->addSql('DROP TABLE internal_location_laptop');
        $this->addSql('DROP TABLE internal_location_keyboard');
        $this->addSql('DROP TABLE internal_location_computer');
        $this->addSql('DROP TABLE internal_location_monitor');
        $this->addSql('DROP TABLE internal_location_mouse');
        $this->addSql('DROP TABLE internal_location_videoprojector');
        $this->addSql('DROP TABLE external_location_mouse');
        $this->addSql('DROP TABLE external_location_laptop');
        $this->addSql('DROP TABLE external_location_keyboard');
        $this->addSql('ALTER TABLE internal_location ADD computer_id INT DEFAULT NULL, ADD laptop_id INT DEFAULT NULL, ADD monitor_id INT DEFAULT NULL, ADD videoprojector_id INT DEFAULT NULL, ADD mouse_id INT DEFAULT NULL, ADD keyboard_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE internal_location ADD CONSTRAINT FK_913C0413A426D518 FOREIGN KEY (computer_id) REFERENCES computer (id)');
        $this->addSql('ALTER TABLE internal_location ADD CONSTRAINT FK_913C0413D59905E5 FOREIGN KEY (laptop_id) REFERENCES laptop (id)');
        $this->addSql('ALTER TABLE internal_location ADD CONSTRAINT FK_913C04134CE1C902 FOREIGN KEY (monitor_id) REFERENCES monitor (id)');
        $this->addSql('ALTER TABLE internal_location ADD CONSTRAINT FK_913C04139DFDD8E8 FOREIGN KEY (videoprojector_id) REFERENCES videoprojector (id)');
        $this->addSql('ALTER TABLE internal_location ADD CONSTRAINT FK_913C041323574B71 FOREIGN KEY (mouse_id) REFERENCES mouse (id)');
        $this->addSql('ALTER TABLE internal_location ADD CONSTRAINT FK_913C0413F17292C6 FOREIGN KEY (keyboard_id) REFERENCES keyboard (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_913C0413A426D518 ON internal_location (computer_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_913C0413D59905E5 ON internal_location (laptop_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_913C04134CE1C902 ON internal_location (monitor_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_913C04139DFDD8E8 ON internal_location (videoprojector_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_913C041323574B71 ON internal_location (mouse_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_913C0413F17292C6 ON internal_location (keyboard_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE internal_location_laptop (internal_location_id INT NOT NULL, laptop_id INT NOT NULL, INDEX IDX_B5B8A6BBD59905E5 (laptop_id), INDEX IDX_B5B8A6BB3322610B (internal_location_id), PRIMARY KEY(internal_location_id, laptop_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE internal_location_keyboard (internal_location_id INT NOT NULL, keyboard_id INT NOT NULL, INDEX IDX_54ABF7B3322610B (internal_location_id), INDEX IDX_54ABF7BF17292C6 (keyboard_id), PRIMARY KEY(internal_location_id, keyboard_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE internal_location_computer (internal_location_id INT NOT NULL, computer_id INT NOT NULL, INDEX IDX_24A698483322610B (internal_location_id), INDEX IDX_24A69848A426D518 (computer_id), PRIMARY KEY(internal_location_id, computer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE internal_location_monitor (internal_location_id INT NOT NULL, monitor_id INT NOT NULL, INDEX IDX_CF8A3553322610B (internal_location_id), INDEX IDX_CF8A3554CE1C902 (monitor_id), PRIMARY KEY(internal_location_id, monitor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE internal_location_mouse (internal_location_id INT NOT NULL, mouse_id INT NOT NULL, INDEX IDX_13E3195A23574B71 (mouse_id), INDEX IDX_13E3195A3322610B (internal_location_id), PRIMARY KEY(internal_location_id, mouse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE internal_location_videoprojector (internal_location_id INT NOT NULL, videoprojector_id INT NOT NULL, INDEX IDX_27A89C5B3322610B (internal_location_id), INDEX IDX_27A89C5B9DFDD8E8 (videoprojector_id), PRIMARY KEY(internal_location_id, videoprojector_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE external_location_mouse (external_location_id INT NOT NULL, mouse_id INT NOT NULL, INDEX IDX_C800EB2E23574B71 (mouse_id), INDEX IDX_C800EB2E6E8A6CF9 (external_location_id), PRIMARY KEY(external_location_id, mouse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE external_location_laptop (external_location_id INT NOT NULL, laptop_id INT NOT NULL, INDEX IDX_E20BF06C6E8A6CF9 (external_location_id), INDEX IDX_E20BF06CD59905E5 (laptop_id), PRIMARY KEY(external_location_id, laptop_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE external_location_keyboard (external_location_id INT NOT NULL, keyboard_id INT NOT NULL, INDEX IDX_493B4FD16E8A6CF9 (external_location_id), INDEX IDX_493B4FD1F17292C6 (keyboard_id), PRIMARY KEY(external_location_id, keyboard_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE internal_location_laptop ADD CONSTRAINT FK_B5B8A6BBD59905E5 FOREIGN KEY (laptop_id) REFERENCES laptop (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location_laptop ADD CONSTRAINT FK_B5B8A6BB3322610B FOREIGN KEY (internal_location_id) REFERENCES internal_location (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location_keyboard ADD CONSTRAINT FK_54ABF7BF17292C6 FOREIGN KEY (keyboard_id) REFERENCES keyboard (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location_keyboard ADD CONSTRAINT FK_54ABF7B3322610B FOREIGN KEY (internal_location_id) REFERENCES internal_location (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location_computer ADD CONSTRAINT FK_24A69848A426D518 FOREIGN KEY (computer_id) REFERENCES computer (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location_computer ADD CONSTRAINT FK_24A698483322610B FOREIGN KEY (internal_location_id) REFERENCES internal_location (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location_monitor ADD CONSTRAINT FK_CF8A3554CE1C902 FOREIGN KEY (monitor_id) REFERENCES monitor (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location_monitor ADD CONSTRAINT FK_CF8A3553322610B FOREIGN KEY (internal_location_id) REFERENCES internal_location (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location_mouse ADD CONSTRAINT FK_13E3195A23574B71 FOREIGN KEY (mouse_id) REFERENCES mouse (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location_mouse ADD CONSTRAINT FK_13E3195A3322610B FOREIGN KEY (internal_location_id) REFERENCES internal_location (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location_videoprojector ADD CONSTRAINT FK_27A89C5B9DFDD8E8 FOREIGN KEY (videoprojector_id) REFERENCES videoprojector (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location_videoprojector ADD CONSTRAINT FK_27A89C5B3322610B FOREIGN KEY (internal_location_id) REFERENCES internal_location (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE external_location_mouse ADD CONSTRAINT FK_C800EB2E6E8A6CF9 FOREIGN KEY (external_location_id) REFERENCES external_location (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE external_location_mouse ADD CONSTRAINT FK_C800EB2E23574B71 FOREIGN KEY (mouse_id) REFERENCES mouse (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE external_location_laptop ADD CONSTRAINT FK_E20BF06CD59905E5 FOREIGN KEY (laptop_id) REFERENCES laptop (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE external_location_laptop ADD CONSTRAINT FK_E20BF06C6E8A6CF9 FOREIGN KEY (external_location_id) REFERENCES external_location (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE external_location_keyboard ADD CONSTRAINT FK_493B4FD1F17292C6 FOREIGN KEY (keyboard_id) REFERENCES keyboard (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE external_location_keyboard ADD CONSTRAINT FK_493B4FD16E8A6CF9 FOREIGN KEY (external_location_id) REFERENCES external_location (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internal_location DROP FOREIGN KEY FK_913C0413A426D518');
        $this->addSql('ALTER TABLE internal_location DROP FOREIGN KEY FK_913C0413D59905E5');
        $this->addSql('ALTER TABLE internal_location DROP FOREIGN KEY FK_913C04134CE1C902');
        $this->addSql('ALTER TABLE internal_location DROP FOREIGN KEY FK_913C04139DFDD8E8');
        $this->addSql('ALTER TABLE internal_location DROP FOREIGN KEY FK_913C041323574B71');
        $this->addSql('ALTER TABLE internal_location DROP FOREIGN KEY FK_913C0413F17292C6');
        $this->addSql('DROP INDEX UNIQ_913C0413A426D518 ON internal_location');
        $this->addSql('DROP INDEX UNIQ_913C0413D59905E5 ON internal_location');
        $this->addSql('DROP INDEX UNIQ_913C04134CE1C902 ON internal_location');
        $this->addSql('DROP INDEX UNIQ_913C04139DFDD8E8 ON internal_location');
        $this->addSql('DROP INDEX UNIQ_913C041323574B71 ON internal_location');
        $this->addSql('DROP INDEX UNIQ_913C0413F17292C6 ON internal_location');
        $this->addSql('ALTER TABLE internal_location DROP computer_id, DROP laptop_id, DROP monitor_id, DROP videoprojector_id, DROP mouse_id, DROP keyboard_id');
    }
}
