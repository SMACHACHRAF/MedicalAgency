<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200611152640 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE medical_files ADD folder_info_id INT DEFAULT NULL, ADD history_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE medical_files ADD CONSTRAINT FK_33D31B09E408AD8B FOREIGN KEY (folder_info_id) REFERENCES folder_informations (id)');
        $this->addSql('ALTER TABLE medical_files ADD CONSTRAINT FK_33D31B091E058452 FOREIGN KEY (history_id) REFERENCES patient_history (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_33D31B09E408AD8B ON medical_files (folder_info_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_33D31B091E058452 ON medical_files (history_id)');
        $this->addSql('ALTER TABLE patient_informations CHANGE specialisation_id specialisation_id INT DEFAULT NULL, CHANGE tourisme_region_id tourisme_region_id INT DEFAULT NULL, CHANGE housing_id housing_id INT DEFAULT NULL, CHANGE patient_folder_id patient_folder_id INT DEFAULT NULL, CHANGE age age INT DEFAULT NULL, CHANGE sexe sexe VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE tourisme_region CHANGE medical_city_id medical_city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE spec_id spec_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE medical_files DROP FOREIGN KEY FK_33D31B09E408AD8B');
        $this->addSql('ALTER TABLE medical_files DROP FOREIGN KEY FK_33D31B091E058452');
        $this->addSql('DROP INDEX UNIQ_33D31B09E408AD8B ON medical_files');
        $this->addSql('DROP INDEX UNIQ_33D31B091E058452 ON medical_files');
        $this->addSql('ALTER TABLE medical_files DROP folder_info_id, DROP history_id');
        $this->addSql('ALTER TABLE patient_informations CHANGE specialisation_id specialisation_id INT DEFAULT NULL, CHANGE tourisme_region_id tourisme_region_id INT DEFAULT NULL, CHANGE housing_id housing_id INT DEFAULT NULL, CHANGE patient_folder_id patient_folder_id INT DEFAULT NULL, CHANGE age age INT DEFAULT NULL, CHANGE sexe sexe VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE tourisme_region CHANGE medical_city_id medical_city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE spec_id spec_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
