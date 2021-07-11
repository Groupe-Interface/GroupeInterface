<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210708182315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE specialite DROP FOREIGN KEY FK_E7D6FCC1CCF9E01E');
        $this->addSql('DROP INDEX IDX_E7D6FCC1CCF9E01E ON specialite');
        $this->addSql('ALTER TABLE specialite ADD departement VARCHAR(255) DEFAULT NULL, DROP departement_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE specialite ADD departement_id INT NOT NULL, DROP departement');
        $this->addSql('ALTER TABLE specialite ADD CONSTRAINT FK_E7D6FCC1CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('CREATE INDEX IDX_E7D6FCC1CCF9E01E ON specialite (departement_id)');
    }
}
