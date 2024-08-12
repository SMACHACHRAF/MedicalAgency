<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200612121848 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE medical_files ADD qte_smoking_id INT DEFAULT NULL, ADD qtealcohol_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE medical_files ADD CONSTRAINT FK_33D31B098101B95A FOREIGN KEY (qte_smoking_id) REFERENCES smoking_qte (id)');
        $this->addSql('ALTER TABLE medical_files ADD CONSTRAINT FK_33D31B09DE04DCEA FOREIGN KEY (qtealcohol_id) REFERENCES alcohol_qte (id)');
        $this->addSql('CREATE INDEX IDX_33D31B098101B95A ON medical_files (qte_smoking_id)');
        $this->addSql('CREATE INDEX IDX_33D31B09DE04DCEA ON medical_files (qtealcohol_id)');
        $this->addSql('ALTER TABLE patient_informations CHANGE specialisation_id specialisation_id INT DEFAULT NULL, CHANGE tourisme_region_id tourisme_region_id INT DEFAULT NULL, CHANGE housing_id housing_id INT DEFAULT NULL, CHANGE patient_folder_id patient_folder_id INT DEFAULT NULL, CHANGE age age INT DEFAULT NULL, CHANGE sexe sexe VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE tourisme_region CHANGE medical_city_id medical_city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE spec_id spec_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE medical_files DROP FOREIGN KEY FK_33D31B098101B95A');
        $this->addSql('ALTER TABLE medical_files DROP FOREIGN KEY FK_33D31B09DE04DCEA');
        $this->addSql('DROP INDEX IDX_33D31B098101B95A ON medical_files');
        $this->addSql('DROP INDEX IDX_33D31B09DE04DCEA ON medical_files');
        $this->addSql('ALTER TABLE medical_files DROP qte_smoking_id, DROP qtealcohol_id');
        $this->addSql('ALTER TABLE patient_informations CHANGE specialisation_id specialisation_id INT DEFAULT NULL, CHANGE tourisme_region_id tourisme_region_id INT DEFAULT NULL, CHANGE housing_id housing_id INT DEFAULT NULL, CHANGE patient_folder_id patient_folder_id INT DEFAULT NULL, CHANGE age age INT DEFAULT NULL, CHANGE sexe sexe VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE tourisme_region CHANGE medical_city_id medical_city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE spec_id spec_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
