<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210713110502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, address_line1 VARCHAR(255) DEFAULT NULL, address_line2 VARCHAR(255) DEFAULT NULL, address_line3 VARCHAR(255) DEFAULT NULL, type INT NOT NULL, codepostal INT NOT NULL, ville VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, status INT NOT NULL, created_at DATETIME NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email2 VARCHAR(255) NOT NULL, email3 VARCHAR(255) NOT NULL, phone2 VARCHAR(255) NOT NULL, INDEX IDX_4FBF094FB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, text LONGTEXT NOT NULL, created_at DATETIME NOT NULL, status SMALLINT NOT NULL, is_readed TINYINT(1) NOT NULL, INDEX IDX_B6BD307FB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rate (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, name VARCHAR(255) NOT NULL, par_kilometer TINYINT(1) NOT NULL, par_time TINYINT(1) NOT NULL, is_fixed TINYINT(1) NOT NULL, amount DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_DFEC3F39B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trip (id INT AUTO_INCREMENT NOT NULL, start_from_id INT NOT NULL, end_to_id INT DEFAULT NULL, driver_id INT NOT NULL, passanger_id INT NOT NULL, rate_id INT DEFAULT NULL, created_at DATETIME NOT NULL, start_time DATETIME DEFAULT NULL, end_time DATETIME DEFAULT NULL, is_accepted TINYINT(1) NOT NULL, INDEX IDX_7656F53B880B85D8 (start_from_id), INDEX IDX_7656F53B41AA0D60 (end_to_id), INDEX IDX_7656F53BC3423909 (driver_id), INDEX IDX_7656F53BC148EB9F (passanger_id), INDEX IDX_7656F53BBC999F9F (rate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, carte_grise_id INT DEFAULT NULL, vtc_card_id INT DEFAULT NULL, number_cv VARCHAR(255) NOT NULL, number_cg VARCHAR(255) NOT NULL, number_ins VARCHAR(255) NOT NULL, ins_exp DATETIME NOT NULL, number_vtc_card VARCHAR(255) NOT NULL, vtc_card_exp DATETIME NOT NULL, type VARCHAR(255) NOT NULL, number VARCHAR(255) NOT NULL, capacity INT NOT NULL, is_avaliable TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_1B80E4864B651859 (carte_grise_id), UNIQUE INDEX UNIQ_1B80E486BCFA15EB (vtc_card_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_user (vehicle_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_FF0EE515545317D1 (vehicle_id), INDEX IDX_FF0EE515A76ED395 (user_id), PRIMARY KEY(vehicle_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F39B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53B880B85D8 FOREIGN KEY (start_from_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53B41AA0D60 FOREIGN KEY (end_to_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53BC3423909 FOREIGN KEY (driver_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53BC148EB9F FOREIGN KEY (passanger_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53BBC999F9F FOREIGN KEY (rate_id) REFERENCES rate (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E4864B651859 FOREIGN KEY (carte_grise_id) REFERENCES file (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486BCFA15EB FOREIGN KEY (vtc_card_id) REFERENCES file (id)');
        $this->addSql('ALTER TABLE vehicle_user ADD CONSTRAINT FK_FF0EE515545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicle_user ADD CONSTRAINT FK_FF0EE515A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610217BBB47');
        $this->addSql('DROP INDEX IDX_8C9F3610217BBB47 ON file');
        $this->addSql('ALTER TABLE file DROP person_id');
        $this->addSql('ALTER TABLE personnel ADD address_id INT NOT NULL');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DEF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A6BCF3DEF5B7AF75 ON personnel (address_id)');
        $this->addSql('ALTER TABLE user ADD company_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649979B1AD6 ON user (company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DEF5B7AF75');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53B880B85D8');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53B41AA0D60');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649979B1AD6');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53BBC999F9F');
        $this->addSql('ALTER TABLE vehicle_user DROP FOREIGN KEY FK_FF0EE515545317D1');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE rate');
        $this->addSql('DROP TABLE trip');
        $this->addSql('DROP TABLE vehicle');
        $this->addSql('DROP TABLE vehicle_user');
        $this->addSql('ALTER TABLE file ADD person_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610217BBB47 FOREIGN KEY (person_id) REFERENCES personnel (id)');
        $this->addSql('CREATE INDEX IDX_8C9F3610217BBB47 ON file (person_id)');
        $this->addSql('DROP INDEX UNIQ_A6BCF3DEF5B7AF75 ON personnel');
        $this->addSql('ALTER TABLE personnel DROP address_id');
        $this->addSql('DROP INDEX IDX_8D93D649979B1AD6 ON user');
        $this->addSql('ALTER TABLE user DROP company_id');
    }
}
