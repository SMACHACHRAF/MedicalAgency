<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200630000911 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE current_disease (id INT AUTO_INCREMENT NOT NULL, disease_name VARCHAR(255) DEFAULT NULL, disease_date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE current_treatments (id INT AUTO_INCREMENT NOT NULL, treatment_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE previous_medical_operation (id INT AUTO_INCREMENT NOT NULL, medical_operation_type VARCHAR(255) DEFAULT NULL, operation_date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE patient_informations CHANGE specialisation_id specialisation_id INT DEFAULT NULL, CHANGE tourisme_region_id tourisme_region_id INT DEFAULT NULL, CHANGE housing_id housing_id INT DEFAULT NULL, CHANGE patient_folder_id patient_folder_id INT DEFAULT NULL, CHANGE patient_doctor_id patient_doctor_id INT DEFAULT NULL, CHANGE age age INT DEFAULT NULL, CHANGE sexe sexe VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE medical_files CHANGE qte_smoking_id qte_smoking_id INT DEFAULT NULL, CHANGE qtealcohol_id qtealcohol_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE spec_id spec_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE tourisme_region CHANGE medical_city_id medical_city_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE current_disease');
        $this->addSql('DROP TABLE current_treatments');
        $this->addSql('DROP TABLE previous_medical_operation');
        $this->addSql('ALTER TABLE medical_files CHANGE qte_smoking_id qte_smoking_id INT DEFAULT NULL, CHANGE qtealcohol_id qtealcohol_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient_informations CHANGE specialisation_id specialisation_id INT DEFAULT NULL, CHANGE tourisme_region_id tourisme_region_id INT DEFAULT NULL, CHANGE housing_id housing_id INT DEFAULT NULL, CHANGE patient_folder_id patient_folder_id INT DEFAULT NULL, CHANGE patient_doctor_id patient_doctor_id INT DEFAULT NULL, CHANGE age age INT DEFAULT NULL, CHANGE sexe sexe VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE tourisme_region CHANGE medical_city_id medical_city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE spec_id spec_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
