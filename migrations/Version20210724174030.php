<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210724174030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE enseignant_classe (enseignant_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_F670A5F4E455FCC0 (enseignant_id), INDEX IDX_F670A5F48F5EA509 (classe_id), PRIMARY KEY(enseignant_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE enseignant_classe ADD CONSTRAINT FK_F670A5F4E455FCC0 FOREIGN KEY (enseignant_id) REFERENCES enseignant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enseignant_classe ADD CONSTRAINT FK_F670A5F48F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA18F5EA509');
        $this->addSql('DROP INDEX IDX_81A72FA18F5EA509 ON enseignant');
        $this->addSql('ALTER TABLE enseignant DROP classe_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE enseignant_classe');
        $this->addSql('ALTER TABLE enseignant ADD classe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA18F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_81A72FA18F5EA509 ON enseignant (classe_id)');
    }
}
