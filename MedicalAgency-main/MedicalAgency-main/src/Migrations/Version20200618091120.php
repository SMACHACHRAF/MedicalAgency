<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200618091120 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE patient_infromations (id INT AUTO_INCREMENT NOT NULL, patient_doctor_id INT DEFAULT NULL, INDEX IDX_33F4BA6B217F2928 (patient_doctor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE patient_infromations ADD CONSTRAINT FK_33F4BA6B217F2928 FOREIGN KEY (patient_doctor_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE medical_files CHANGE qte_smoking_id qte_smoking_id INT DEFAULT NULL, CHANGE qtealcohol_id qtealcohol_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient_informations CHANGE specialisation_id specialisation_id INT DEFAULT NULL, CHANGE tourisme_region_id tourisme_region_id INT DEFAULT NULL, CHANGE housing_id housing_id INT DEFAULT NULL, CHANGE patient_folder_id patient_folder_id INT DEFAULT NULL, CHANGE age age INT DEFAULT NULL, CHANGE sexe sexe VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE spec_id spec_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE tourisme_region CHANGE medical_city_id medical_city_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE patient_infromations');
        $this->addSql('ALTER TABLE medical_files CHANGE qte_smoking_id qte_smoking_id INT DEFAULT NULL, CHANGE qtealcohol_id qtealcohol_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient_informations CHANGE specialisation_id specialisation_id INT DEFAULT NULL, CHANGE tourisme_region_id tourisme_region_id INT DEFAULT NULL, CHANGE housing_id housing_id INT DEFAULT NULL, CHANGE patient_folder_id patient_folder_id INT DEFAULT NULL, CHANGE age age INT DEFAULT NULL, CHANGE sexe sexe VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE tourisme_region CHANGE medical_city_id medical_city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE spec_id spec_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
