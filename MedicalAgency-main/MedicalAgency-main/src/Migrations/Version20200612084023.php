<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200612084023 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE medical_files DROP FOREIGN KEY FK_33D31B09E408AD8B');
        $this->addSql('ALTER TABLE medical_files DROP FOREIGN KEY FK_33D31B091E058452');
        $this->addSql('DROP TABLE folder_informations');
        $this->addSql('DROP TABLE patient_history');
        $this->addSql('DROP INDEX UNIQ_33D31B09E408AD8B ON medical_files');
        $this->addSql('DROP INDEX UNIQ_33D31B091E058452 ON medical_files');
        $this->addSql('ALTER TABLE medical_files DROP folder_info_id, DROP history_id');
        $this->addSql('ALTER TABLE patient_informations DROP FOREIGN KEY FK_89C53BB7B0A76B7D');
        $this->addSql('DROP INDEX UNIQ_89C53BB7B0A76B7D ON patient_informations');
        $this->addSql('ALTER TABLE patient_informations DROP patient_folder_id, CHANGE specialisation_id specialisation_id INT DEFAULT NULL, CHANGE tourisme_region_id tourisme_region_id INT DEFAULT NULL, CHANGE housing_id housing_id INT DEFAULT NULL, CHANGE age age INT DEFAULT NULL, CHANGE sexe sexe VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE tourisme_region CHANGE medical_city_id medical_city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE spec_id spec_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE folder_informations (id INT AUTO_INCREMENT NOT NULL, weight INT NOT NULL, size INT NOT NULL, is_smoking TINYINT(1) NOT NULL, is_alcoholic TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE patient_history (id INT AUTO_INCREMENT NOT NULL, current_disease VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, current_medications VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, previous_operations VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, health_description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE medical_files ADD folder_info_id INT DEFAULT NULL, ADD history_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE medical_files ADD CONSTRAINT FK_33D31B091E058452 FOREIGN KEY (history_id) REFERENCES patient_history (id)');
        $this->addSql('ALTER TABLE medical_files ADD CONSTRAINT FK_33D31B09E408AD8B FOREIGN KEY (folder_info_id) REFERENCES folder_informations (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_33D31B09E408AD8B ON medical_files (folder_info_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_33D31B091E058452 ON medical_files (history_id)');
        $this->addSql('ALTER TABLE patient_informations ADD patient_folder_id INT DEFAULT NULL, CHANGE specialisation_id specialisation_id INT DEFAULT NULL, CHANGE tourisme_region_id tourisme_region_id INT DEFAULT NULL, CHANGE housing_id housing_id INT DEFAULT NULL, CHANGE age age INT DEFAULT NULL, CHANGE sexe sexe VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE patient_informations ADD CONSTRAINT FK_89C53BB7B0A76B7D FOREIGN KEY (patient_folder_id) REFERENCES medical_files (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_89C53BB7B0A76B7D ON patient_informations (patient_folder_id)');
        $this->addSql('ALTER TABLE tourisme_region CHANGE medical_city_id medical_city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE spec_id spec_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
