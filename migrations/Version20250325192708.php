<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250325192708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE patent_inventor (patent_id INT NOT NULL, inventor_id INT NOT NULL, INDEX IDX_16E1116811AAFF4A (patent_id), INDEX IDX_16E111689CECD5D4 (inventor_id), PRIMARY KEY(patent_id, inventor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE patent_inventor ADD CONSTRAINT FK_16E1116811AAFF4A FOREIGN KEY (patent_id) REFERENCES patent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patent_inventor ADD CONSTRAINT FK_16E111689CECD5D4 FOREIGN KEY (inventor_id) REFERENCES inventor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inventor_patent DROP FOREIGN KEY FK_E22C74A911AAFF4A');
        $this->addSql('ALTER TABLE inventor_patent DROP FOREIGN KEY FK_E22C74A99CECD5D4');
        $this->addSql('DROP TABLE inventor_patent');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON inventor (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inventor_patent (inventor_id INT NOT NULL, patent_id INT NOT NULL, INDEX IDX_E22C74A99CECD5D4 (inventor_id), INDEX IDX_E22C74A911AAFF4A (patent_id), PRIMARY KEY(inventor_id, patent_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE inventor_patent ADD CONSTRAINT FK_E22C74A911AAFF4A FOREIGN KEY (patent_id) REFERENCES patent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inventor_patent ADD CONSTRAINT FK_E22C74A99CECD5D4 FOREIGN KEY (inventor_id) REFERENCES inventor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patent_inventor DROP FOREIGN KEY FK_16E1116811AAFF4A');
        $this->addSql('ALTER TABLE patent_inventor DROP FOREIGN KEY FK_16E111689CECD5D4');
        $this->addSql('DROP TABLE patent_inventor');
        $this->addSql('DROP INDEX UNIQ_IDENTIFIER_EMAIL ON inventor');
    }
}
