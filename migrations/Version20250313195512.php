<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250313195512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE business_type (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE claims (id INT AUTO_INCREMENT NOT NULL, patent_id_id INT NOT NULL, claim VARCHAR(512) NOT NULL, INDEX IDX_BEA313BEBE6B7AB3 (patent_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classification (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE date_types (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dates (id INT AUTO_INCREMENT NOT NULL, dates_have_types_id INT NOT NULL, patent_id_id INT NOT NULL, date_short DATETIME DEFAULT NULL, date_long DATETIME DEFAULT NULL, grace_period DATETIME DEFAULT NULL, INDEX IDX_AB74C91EE24A4ADA (dates_have_types_id), INDEX IDX_AB74C91EBE6B7AB3 (patent_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventor (id INT AUTO_INCREMENT NOT NULL, inventor_is_person_type_id INT DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, pass_hash VARCHAR(512) DEFAULT NULL, INDEX IDX_29C96264173A16A9 (inventor_is_person_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventor_patent (inventor_id INT NOT NULL, patent_id INT NOT NULL, INDEX IDX_E22C74A99CECD5D4 (inventor_id), INDEX IDX_E22C74A911AAFF4A (patent_id), PRIMARY KEY(inventor_id, patent_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(3) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE localization (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patent (id INT AUTO_INCREMENT NOT NULL, patents_are_categorized_id INT NOT NULL, patents_have_localization_id INT NOT NULL, patents_have_language_id INT NOT NULL, patents_have_status_id INT NOT NULL, patent_has_business_type_id INT DEFAULT NULL, irn VARCHAR(255) NOT NULL, patent_number VARCHAR(255) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, descript VARCHAR(1023) DEFAULT NULL, INDEX IDX_18E53F93EE2C32FD (patents_are_categorized_id), INDEX IDX_18E53F936063A59 (patents_have_localization_id), INDEX IDX_18E53F93DE2F8B27 (patents_have_language_id), INDEX IDX_18E53F93EDC450A8 (patents_have_status_id), INDEX IDX_18E53F93151368EF (patent_has_business_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patents_to_classification (id INT AUTO_INCREMENT NOT NULL, patent_id INT NOT NULL, classification_id INT NOT NULL, classification_type VARCHAR(255) NOT NULL, INDEX IDX_8A7B1DB011AAFF4A (patent_id), INDEX IDX_8A7B1DB02A86559F (classification_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(63) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE related_patents (id INT AUTO_INCREMENT NOT NULL, primary_patent_id INT NOT NULL, related_patent_id INT NOT NULL, relationship_type VARCHAR(255) DEFAULT NULL, comments VARCHAR(255) DEFAULT NULL, INDEX IDX_4D09226FDB3142AD (primary_patent_id), INDEX IDX_4D09226FB96BA351 (related_patent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stats (id INT AUTO_INCREMENT NOT NULL, stat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE claims ADD CONSTRAINT FK_BEA313BEBE6B7AB3 FOREIGN KEY (patent_id_id) REFERENCES patent (id)');
        $this->addSql('ALTER TABLE dates ADD CONSTRAINT FK_AB74C91EE24A4ADA FOREIGN KEY (dates_have_types_id) REFERENCES date_types (id)');
        $this->addSql('ALTER TABLE dates ADD CONSTRAINT FK_AB74C91EBE6B7AB3 FOREIGN KEY (patent_id_id) REFERENCES patent (id)');
        $this->addSql('ALTER TABLE inventor ADD CONSTRAINT FK_29C96264173A16A9 FOREIGN KEY (inventor_is_person_type_id) REFERENCES person_type (id)');
        $this->addSql('ALTER TABLE inventor_patent ADD CONSTRAINT FK_E22C74A99CECD5D4 FOREIGN KEY (inventor_id) REFERENCES inventor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inventor_patent ADD CONSTRAINT FK_E22C74A911AAFF4A FOREIGN KEY (patent_id) REFERENCES patent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patent ADD CONSTRAINT FK_18E53F93EE2C32FD FOREIGN KEY (patents_are_categorized_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE patent ADD CONSTRAINT FK_18E53F936063A59 FOREIGN KEY (patents_have_localization_id) REFERENCES localization (id)');
        $this->addSql('ALTER TABLE patent ADD CONSTRAINT FK_18E53F93DE2F8B27 FOREIGN KEY (patents_have_language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE patent ADD CONSTRAINT FK_18E53F93EDC450A8 FOREIGN KEY (patents_have_status_id) REFERENCES stats (id)');
        $this->addSql('ALTER TABLE patent ADD CONSTRAINT FK_18E53F93151368EF FOREIGN KEY (patent_has_business_type_id) REFERENCES business_type (id)');
        $this->addSql('ALTER TABLE patents_to_classification ADD CONSTRAINT FK_8A7B1DB011AAFF4A FOREIGN KEY (patent_id) REFERENCES patent (id)');
        $this->addSql('ALTER TABLE patents_to_classification ADD CONSTRAINT FK_8A7B1DB02A86559F FOREIGN KEY (classification_id) REFERENCES classification (id)');
        $this->addSql('ALTER TABLE related_patents ADD CONSTRAINT FK_4D09226FDB3142AD FOREIGN KEY (primary_patent_id) REFERENCES patent (id)');
        $this->addSql('ALTER TABLE related_patents ADD CONSTRAINT FK_4D09226FB96BA351 FOREIGN KEY (related_patent_id) REFERENCES patent (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE claims DROP FOREIGN KEY FK_BEA313BEBE6B7AB3');
        $this->addSql('ALTER TABLE dates DROP FOREIGN KEY FK_AB74C91EE24A4ADA');
        $this->addSql('ALTER TABLE dates DROP FOREIGN KEY FK_AB74C91EBE6B7AB3');
        $this->addSql('ALTER TABLE inventor DROP FOREIGN KEY FK_29C96264173A16A9');
        $this->addSql('ALTER TABLE inventor_patent DROP FOREIGN KEY FK_E22C74A99CECD5D4');
        $this->addSql('ALTER TABLE inventor_patent DROP FOREIGN KEY FK_E22C74A911AAFF4A');
        $this->addSql('ALTER TABLE patent DROP FOREIGN KEY FK_18E53F93EE2C32FD');
        $this->addSql('ALTER TABLE patent DROP FOREIGN KEY FK_18E53F936063A59');
        $this->addSql('ALTER TABLE patent DROP FOREIGN KEY FK_18E53F93DE2F8B27');
        $this->addSql('ALTER TABLE patent DROP FOREIGN KEY FK_18E53F93EDC450A8');
        $this->addSql('ALTER TABLE patent DROP FOREIGN KEY FK_18E53F93151368EF');
        $this->addSql('ALTER TABLE patents_to_classification DROP FOREIGN KEY FK_8A7B1DB011AAFF4A');
        $this->addSql('ALTER TABLE patents_to_classification DROP FOREIGN KEY FK_8A7B1DB02A86559F');
        $this->addSql('ALTER TABLE related_patents DROP FOREIGN KEY FK_4D09226FDB3142AD');
        $this->addSql('ALTER TABLE related_patents DROP FOREIGN KEY FK_4D09226FB96BA351');
        $this->addSql('DROP TABLE business_type');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE claims');
        $this->addSql('DROP TABLE classification');
        $this->addSql('DROP TABLE date_types');
        $this->addSql('DROP TABLE dates');
        $this->addSql('DROP TABLE inventor');
        $this->addSql('DROP TABLE inventor_patent');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE localization');
        $this->addSql('DROP TABLE patent');
        $this->addSql('DROP TABLE patents_to_classification');
        $this->addSql('DROP TABLE person_type');
        $this->addSql('DROP TABLE related_patents');
        $this->addSql('DROP TABLE stats');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
