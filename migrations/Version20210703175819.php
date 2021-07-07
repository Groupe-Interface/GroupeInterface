<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210703175819 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, type_user VARCHAR(255) NOT NULL, nationalite VARCHAR(255) NOT NULL, num_passport INT DEFAULT NULL, cin INT DEFAULT NULL, nom_etudiant VARCHAR(255) NOT NULL, prenom_etudiant VARCHAR(255) NOT NULL, date_naiss DATE NOT NULL, paye_naiss VARCHAR(255) NOT NULL, paye_etudiant VARCHAR(255) NOT NULL, ville_etudiant VARCHAR(255) NOT NULL, photo_etudiant VARCHAR(255) NOT NULL, email_etudiant VARCHAR(255) NOT NULL, phone_etudiant INT NOT NULL, phono_urgence INT NOT NULL, session DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE etudiant');
    }
}
