<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240620115239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE incidence_camion (incidence_id INT NOT NULL, camion_id INT NOT NULL, INDEX IDX_DF80FBBFF22710E3 (incidence_id), INDEX IDX_DF80FBBF3A706D3 (camion_id), PRIMARY KEY(incidence_id, camion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE incidence_camion ADD CONSTRAINT FK_DF80FBBFF22710E3 FOREIGN KEY (incidence_id) REFERENCES incidence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incidence_camion ADD CONSTRAINT FK_DF80FBBF3A706D3 FOREIGN KEY (camion_id) REFERENCES camion (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE controleur');
        $this->addSql('DROP TABLE mecanicien');
        $this->addSql('ALTER TABLE etiquette CHANGE etat etat VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE inspection DROP FOREIGN KEY FK_F9F134853A706D3');
        $this->addSql('DROP INDEX IDX_F9F134853A706D3 ON inspection');
        $this->addSql('ALTER TABLE inspection DROP camion_id');
        $this->addSql('ALTER TABLE videnge DROP statut');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE controleur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, numero_de_tel VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, adresse_email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, numero_de_badge VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_de_naissance DATE NOT NULL, categories_permis VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE mecanicien (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, contact VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, adresse VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE incidence_camion DROP FOREIGN KEY FK_DF80FBBFF22710E3');
        $this->addSql('ALTER TABLE incidence_camion DROP FOREIGN KEY FK_DF80FBBF3A706D3');
        $this->addSql('DROP TABLE incidence_camion');
        $this->addSql('ALTER TABLE etiquette CHANGE etat etat VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE inspection ADD camion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inspection ADD CONSTRAINT FK_F9F134853A706D3 FOREIGN KEY (camion_id) REFERENCES camion (id)');
        $this->addSql('CREATE INDEX IDX_F9F134853A706D3 ON inspection (camion_id)');
        $this->addSql('ALTER TABLE videnge ADD statut TINYINT(1) NOT NULL');
    }
}
