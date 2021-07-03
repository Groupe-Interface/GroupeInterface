<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210703215932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abscence (id INT AUTO_INCREMENT NOT NULL, id_seance_id INT DEFAULT NULL, id_etudiant_id INT DEFAULT NULL, justifee TINYINT(1) NOT NULL, commentaire_abscence VARCHAR(255) NOT NULL, INDEX IDX_BD71CDA634CC6B3 (id_seance_id), INDEX IDX_BD71CDAC5F87C54 (id_etudiant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, id_admin_id INT NOT NULL, title_avis VARCHAR(255) NOT NULL, description_avis VARCHAR(255) NOT NULL, date_avis DATE NOT NULL, INDEX IDX_8F91ABF034F06E85 (id_admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, id_specialite_id INT DEFAULT NULL, niveau_classe INT NOT NULL, num_classe INT NOT NULL, INDEX IDX_8F87BF969FBD3195 (id_specialite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, id_publication_id INT DEFAULT NULL, id_user_id INT DEFAULT NULL, description_commentaire VARCHAR(255) NOT NULL, date_commentaire DATE NOT NULL, INDEX IDX_67F068BC5D4AAA1 (id_publication_id), INDEX IDX_67F068BC79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, id_classe_id INT DEFAULT NULL, support_cours VARCHAR(255) NOT NULL, INDEX IDX_FDCA8C9CF6B192E (id_classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, nom_departement VARCHAR(255) NOT NULL, ab_departement VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, id_enseignant_id INT DEFAULT NULL, id_specialite_id INT DEFAULT NULL, note_id INT DEFAULT NULL, nom_matiere VARCHAR(255) NOT NULL, moyenne_matiere DOUBLE PRECISION NOT NULL, coeff_matiere DOUBLE PRECISION NOT NULL, INDEX IDX_9014574A5A7D2DA5 (id_enseignant_id), INDEX IDX_9014574A9FBD3195 (id_specialite_id), INDEX IDX_9014574A26ED0855 (note_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, id_etudiant_id INT DEFAULT NULL, note_examen DOUBLE PRECISION NOT NULL, note_test DOUBLE PRECISION NOT NULL, moyenne_note DOUBLE PRECISION NOT NULL, INDEX IDX_CFBDFA14C5F87C54 (id_etudiant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publication (id INT AUTO_INCREMENT NOT NULL, id_cours_id INT DEFAULT NULL, id_user_id INT DEFAULT NULL, description_publication VARCHAR(255) NOT NULL, date_publication DATE NOT NULL, nb_comment INT NOT NULL, nb_vue INT NOT NULL, INDEX IDX_AF3C67792E149425 (id_cours_id), INDEX IDX_AF3C677979F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, title_reclamation VARCHAR(255) NOT NULL, description_reclamation VARCHAR(255) NOT NULL, date_reclamation DATE NOT NULL, INDEX IDX_CE60640479F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seance (id INT AUTO_INCREMENT NOT NULL, date_seance DATE NOT NULL, heure_debut TIME NOT NULL, heure_fin TIME NOT NULL, nbr_minute INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE semestre (id INT AUTO_INCREMENT NOT NULL, id_specialite_id INT NOT NULL, payement_semestre TINYINT(1) NOT NULL, INDEX IDX_71688FBC9FBD3195 (id_specialite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE semestre_etudiant (semestre_id INT NOT NULL, etudiant_id INT NOT NULL, INDEX IDX_3D21F9A5577AFDB (semestre_id), INDEX IDX_3D21F9ADDEAB1A3 (etudiant_id), PRIMARY KEY(semestre_id, etudiant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialite (id INT AUTO_INCREMENT NOT NULL, nom_specialite VARCHAR(255) NOT NULL, duree_specialite INT NOT NULL, nbr_semestre INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abscence ADD CONSTRAINT FK_BD71CDA634CC6B3 FOREIGN KEY (id_seance_id) REFERENCES seance (id)');
        $this->addSql('ALTER TABLE abscence ADD CONSTRAINT FK_BD71CDAC5F87C54 FOREIGN KEY (id_etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF034F06E85 FOREIGN KEY (id_admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF969FBD3195 FOREIGN KEY (id_specialite_id) REFERENCES specialite (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC5D4AAA1 FOREIGN KEY (id_publication_id) REFERENCES publication (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CF6B192E FOREIGN KEY (id_classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574A5A7D2DA5 FOREIGN KEY (id_enseignant_id) REFERENCES enseignant (id)');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574A9FBD3195 FOREIGN KEY (id_specialite_id) REFERENCES specialite (id)');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574A26ED0855 FOREIGN KEY (note_id) REFERENCES note (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14C5F87C54 FOREIGN KEY (id_etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C67792E149425 FOREIGN KEY (id_cours_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C677979F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE60640479F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE semestre ADD CONSTRAINT FK_71688FBC9FBD3195 FOREIGN KEY (id_specialite_id) REFERENCES specialite (id)');
        $this->addSql('ALTER TABLE semestre_etudiant ADD CONSTRAINT FK_3D21F9A5577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE semestre_etudiant ADD CONSTRAINT FK_3D21F9ADDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enseignant ADD login VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD type_user VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD classe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6498F5EA509 ON user (classe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CF6B192E');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498F5EA509');
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C67792E149425');
        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY FK_9014574A26ED0855');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC5D4AAA1');
        $this->addSql('ALTER TABLE abscence DROP FOREIGN KEY FK_BD71CDA634CC6B3');
        $this->addSql('ALTER TABLE semestre_etudiant DROP FOREIGN KEY FK_3D21F9A5577AFDB');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF969FBD3195');
        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY FK_9014574A9FBD3195');
        $this->addSql('ALTER TABLE semestre DROP FOREIGN KEY FK_71688FBC9FBD3195');
        $this->addSql('DROP TABLE abscence');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE publication');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE seance');
        $this->addSql('DROP TABLE semestre');
        $this->addSql('DROP TABLE semestre_etudiant');
        $this->addSql('DROP TABLE specialite');
        $this->addSql('ALTER TABLE enseignant DROP login, DROP password, DROP type_user');
        $this->addSql('DROP INDEX IDX_8D93D6498F5EA509 ON user');
        $this->addSql('ALTER TABLE user DROP classe_id');
    }
}
