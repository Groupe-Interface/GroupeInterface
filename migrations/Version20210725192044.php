<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210725192044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire ADD enseignant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCE455FCC0 FOREIGN KEY (enseignant_id) REFERENCES enseignant (id)');
        $this->addSql('CREATE INDEX IDX_67F068BCE455FCC0 ON commentaire (enseignant_id)');
        $this->addSql('ALTER TABLE etudiant CHANGE date_naiss date_naiss DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCE455FCC0');
        $this->addSql('DROP INDEX IDX_67F068BCE455FCC0 ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP enseignant_id');
        $this->addSql('ALTER TABLE etudiant CHANGE date_naiss date_naiss DATE DEFAULT NULL');
    }
}
