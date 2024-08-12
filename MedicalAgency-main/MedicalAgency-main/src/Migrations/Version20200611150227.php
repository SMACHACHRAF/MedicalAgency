<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200611150227 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE folder_informations DROP FOREIGN KEY FK_7660060593CB796C');
        $this->addSql('DROP INDEX UNIQ_7660060593CB796C ON folder_informations');
        $this->addSql('ALTER TABLE folder_informations DROP file_id');
        $this->addSql('ALTER TABLE patient_history DROP FOREIGN KEY FK_7AD925A093CB796C');
        $this->addSql('DROP INDEX UNIQ_7AD925A093CB796C ON patient_history');
        $this->addSql('ALTER TABLE patient_history DROP file_id');
        $this->addSql('ALTER TABLE patient_informations DROP file_id, CHANGE specialisation_id specialisation_id INT DEFAULT NULL, CHANGE tourisme_region_id tourisme_region_id INT DEFAULT NULL, CHANGE housing_id housing_id INT DEFAULT NULL, CHANGE age age INT DEFAULT NULL, CHANGE sexe sexe VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE tourisme_region CHANGE medical_city_id medical_city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE spec_id spec_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE folder_informations ADD file_id INT NOT NULL');
        $this->addSql('ALTER TABLE folder_informations ADD CONSTRAINT FK_7660060593CB796C FOREIGN KEY (file_id) REFERENCES medical_files (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7660060593CB796C ON folder_informations (file_id)');
        $this->addSql('ALTER TABLE patient_history ADD file_id INT NOT NULL');
        $this->addSql('ALTER TABLE patient_history ADD CONSTRAINT FK_7AD925A093CB796C FOREIGN KEY (file_id) REFERENCES medical_files (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7AD925A093CB796C ON patient_history (file_id)');
        $this->addSql('ALTER TABLE patient_informations ADD file_id INT NOT NULL, CHANGE specialisation_id specialisation_id INT DEFAULT NULL, CHANGE tourisme_region_id tourisme_region_id INT DEFAULT NULL, CHANGE housing_id housing_id INT DEFAULT NULL, CHANGE age age INT DEFAULT NULL, CHANGE sexe sexe VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE tourisme_region CHANGE medical_city_id medical_city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE spec_id spec_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
