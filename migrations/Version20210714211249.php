<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210714211249 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DE94513350');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E4864B651859');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E486BCFA15EB');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP INDEX UNIQ_A6BCF3DE94513350 ON personnel');
        $this->addSql('ALTER TABLE personnel ADD image_name VARCHAR(255) DEFAULT NULL, ADD image_original_name VARCHAR(255) DEFAULT NULL, ADD image_mime_type VARCHAR(255) DEFAULT NULL, ADD image_dimensions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', CHANGE id_card_id image_size INT DEFAULT NULL');
        $this->addSql('DROP INDEX UNIQ_1B80E486BCFA15EB ON vehicle');
        $this->addSql('DROP INDEX UNIQ_1B80E4864B651859 ON vehicle');
        $this->addSql('ALTER TABLE vehicle DROP carte_grise_id, DROP vtc_card_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, path LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE personnel DROP image_name, DROP image_original_name, DROP image_mime_type, DROP image_dimensions, CHANGE image_size id_card_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DE94513350 FOREIGN KEY (id_card_id) REFERENCES file (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A6BCF3DE94513350 ON personnel (id_card_id)');
        $this->addSql('ALTER TABLE vehicle ADD carte_grise_id INT DEFAULT NULL, ADD vtc_card_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E4864B651859 FOREIGN KEY (carte_grise_id) REFERENCES file (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486BCFA15EB FOREIGN KEY (vtc_card_id) REFERENCES file (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1B80E486BCFA15EB ON vehicle (vtc_card_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1B80E4864B651859 ON vehicle (carte_grise_id)');
    }
}
