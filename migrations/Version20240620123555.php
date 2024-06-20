<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240620123555 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE controleur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, numero_de_tel VARCHAR(255) NOT NULL, adresse_email VARCHAR(255) NOT NULL, numero_de_badge VARCHAR(255) NOT NULL, date_de_naissance DATE NOT NULL, categories_permis VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE list_piece_piece (list_piece_id INT NOT NULL, piece_id INT NOT NULL, INDEX IDX_D9C639C3BA62FCC8 (list_piece_id), INDEX IDX_D9C639C3C40FCFA8 (piece_id), PRIMARY KEY(list_piece_id, piece_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mecanicien (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(100) NOT NULL, contact VARCHAR(255) NOT NULL, adresse VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE videnge_list_piece (videnge_id INT NOT NULL, list_piece_id INT NOT NULL, INDEX IDX_3F37CD38E926B931 (videnge_id), INDEX IDX_3F37CD38BA62FCC8 (list_piece_id), PRIMARY KEY(videnge_id, list_piece_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE list_piece_piece ADD CONSTRAINT FK_D9C639C3BA62FCC8 FOREIGN KEY (list_piece_id) REFERENCES list_piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE list_piece_piece ADD CONSTRAINT FK_D9C639C3C40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE videnge_list_piece ADD CONSTRAINT FK_3F37CD38E926B931 FOREIGN KEY (videnge_id) REFERENCES videnge (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE videnge_list_piece ADD CONSTRAINT FK_3F37CD38BA62FCC8 FOREIGN KEY (list_piece_id) REFERENCES list_piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incidence_camion DROP FOREIGN KEY FK_DF80FBBF3A706D3');
        $this->addSql('ALTER TABLE incidence_camion DROP FOREIGN KEY FK_DF80FBBFF22710E3');
        $this->addSql('DROP TABLE incidence_camion');
        $this->addSql('ALTER TABLE etiquette CHANGE etat etat VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE inspection ADD camion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inspection ADD CONSTRAINT FK_F9F134853A706D3 FOREIGN KEY (camion_id) REFERENCES camion (id)');
        $this->addSql('CREATE INDEX IDX_F9F134853A706D3 ON inspection (camion_id)');
        $this->addSql('ALTER TABLE list_piece DROP FOREIGN KEY FK_9D599F20C40FCFA8');
        $this->addSql('ALTER TABLE list_piece DROP FOREIGN KEY FK_9D599F20E926B931');
        $this->addSql('DROP INDEX UNIQ_9D599F20C40FCFA8 ON list_piece');
        $this->addSql('DROP INDEX UNIQ_9D599F20E926B931 ON list_piece');
        $this->addSql('ALTER TABLE list_piece DROP videnge_id, DROP piece_id');
        $this->addSql('ALTER TABLE videnge DROP FOREIGN KEY FK_8483CDCBA62FCC8');
        $this->addSql('DROP INDEX UNIQ_8483CDCBA62FCC8 ON videnge');
        $this->addSql('ALTER TABLE videnge DROP list_piece_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE incidence_camion (incidence_id INT NOT NULL, camion_id INT NOT NULL, INDEX IDX_DF80FBBF3A706D3 (camion_id), INDEX IDX_DF80FBBFF22710E3 (incidence_id), PRIMARY KEY(incidence_id, camion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE incidence_camion ADD CONSTRAINT FK_DF80FBBF3A706D3 FOREIGN KEY (camion_id) REFERENCES camion (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incidence_camion ADD CONSTRAINT FK_DF80FBBFF22710E3 FOREIGN KEY (incidence_id) REFERENCES incidence (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE list_piece_piece DROP FOREIGN KEY FK_D9C639C3BA62FCC8');
        $this->addSql('ALTER TABLE list_piece_piece DROP FOREIGN KEY FK_D9C639C3C40FCFA8');
        $this->addSql('ALTER TABLE videnge_list_piece DROP FOREIGN KEY FK_3F37CD38E926B931');
        $this->addSql('ALTER TABLE videnge_list_piece DROP FOREIGN KEY FK_3F37CD38BA62FCC8');
        $this->addSql('DROP TABLE controleur');
        $this->addSql('DROP TABLE list_piece_piece');
        $this->addSql('DROP TABLE mecanicien');
        $this->addSql('DROP TABLE videnge_list_piece');
        $this->addSql('ALTER TABLE etiquette CHANGE etat etat VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE inspection DROP FOREIGN KEY FK_F9F134853A706D3');
        $this->addSql('DROP INDEX IDX_F9F134853A706D3 ON inspection');
        $this->addSql('ALTER TABLE inspection DROP camion_id');
        $this->addSql('ALTER TABLE list_piece ADD videnge_id INT DEFAULT NULL, ADD piece_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE list_piece ADD CONSTRAINT FK_9D599F20C40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE list_piece ADD CONSTRAINT FK_9D599F20E926B931 FOREIGN KEY (videnge_id) REFERENCES videnge (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9D599F20C40FCFA8 ON list_piece (piece_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9D599F20E926B931 ON list_piece (videnge_id)');
        $this->addSql('ALTER TABLE videnge ADD list_piece_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE videnge ADD CONSTRAINT FK_8483CDCBA62FCC8 FOREIGN KEY (list_piece_id) REFERENCES list_piece (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8483CDCBA62FCC8 ON videnge (list_piece_id)');
    }
}
