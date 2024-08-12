<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200311150052 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE housing (id INT AUTO_INCREMENT NOT NULL, place VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medical_city (id INT AUTO_INCREMENT NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient_informations (id INT AUTO_INCREMENT NOT NULL, housing_id INT DEFAULT NULL, specialisation_id INT DEFAULT NULL, tourisme_region_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, age INT NOT NULL, sexe VARCHAR(50) NOT NULL, INDEX IDX_89C53BB7AD5873E3 (housing_id), INDEX IDX_89C53BB75627D44C (specialisation_id), INDEX IDX_89C53BB79FA2126B (tourisme_region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialisation (id INT AUTO_INCREMENT NOT NULL, spec VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tourisme_region (id INT AUTO_INCREMENT NOT NULL, medical_city_id INT DEFAULT NULL, arrival_date DATE NOT NULL, estimate_period VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, guide VARCHAR(255) NOT NULL, car VARCHAR(255) NOT NULL, INDEX IDX_86EDC08ACDAE8261 (medical_city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE patient_informations ADD CONSTRAINT FK_89C53BB7AD5873E3 FOREIGN KEY (housing_id) REFERENCES housing (id)');
        $this->addSql('ALTER TABLE patient_informations ADD CONSTRAINT FK_89C53BB75627D44C FOREIGN KEY (specialisation_id) REFERENCES specialisation (id)');
        $this->addSql('ALTER TABLE patient_informations ADD CONSTRAINT FK_89C53BB79FA2126B FOREIGN KEY (tourisme_region_id) REFERENCES tourisme_region (id)');
        $this->addSql('ALTER TABLE tourisme_region ADD CONSTRAINT FK_86EDC08ACDAE8261 FOREIGN KEY (medical_city_id) REFERENCES medical_city (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE patient_informations DROP FOREIGN KEY FK_89C53BB7AD5873E3');
        $this->addSql('ALTER TABLE tourisme_region DROP FOREIGN KEY FK_86EDC08ACDAE8261');
        $this->addSql('ALTER TABLE patient_informations DROP FOREIGN KEY FK_89C53BB75627D44C');
        $this->addSql('ALTER TABLE patient_informations DROP FOREIGN KEY FK_89C53BB79FA2126B');
        $this->addSql('DROP TABLE housing');
        $this->addSql('DROP TABLE medical_city');
        $this->addSql('DROP TABLE patient_informations');
        $this->addSql('DROP TABLE specialisation');
        $this->addSql('DROP TABLE tourisme_region');
    }
}
