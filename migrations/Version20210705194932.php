<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210705194932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF034F06E85');
        $this->addSql('DROP INDEX IDX_8F91ABF034F06E85 ON avis');
        $this->addSql('ALTER TABLE avis DROP id_admin_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis ADD id_admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF034F06E85 FOREIGN KEY (id_admin_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF034F06E85 ON avis (id_admin_id)');
    }
}
