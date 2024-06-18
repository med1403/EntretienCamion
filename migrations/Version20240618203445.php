<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240618203445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mecanicien (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(100) NOT NULL, contact VARCHAR(255) NOT NULL, adresse VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inspection DROP FOREIGN KEY FK_F9F134853A706D3');
        $this->addSql('DROP INDEX IDX_F9F134853A706D3 ON inspection');
        $this->addSql('ALTER TABLE inspection DROP camion_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE mecanicien');
        $this->addSql('ALTER TABLE inspection ADD camion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inspection ADD CONSTRAINT FK_F9F134853A706D3 FOREIGN KEY (camion_id) REFERENCES camion (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F9F134853A706D3 ON inspection (camion_id)');
    }
}
