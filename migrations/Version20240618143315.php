<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240618143315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE incidence_camion DROP FOREIGN KEY FK_DF80FBBF3A706D3');
        $this->addSql('ALTER TABLE incidence_camion DROP FOREIGN KEY FK_DF80FBBFF22710E3');
        $this->addSql('DROP TABLE incidence_camion');
        $this->addSql('DROP TABLE mecanicien');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE incidence_camion (incidence_id INT NOT NULL, camion_id INT NOT NULL, INDEX IDX_DF80FBBF3A706D3 (camion_id), INDEX IDX_DF80FBBFF22710E3 (incidence_id), PRIMARY KEY(incidence_id, camion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE mecanicien (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, contact VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, adresse VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE incidence_camion ADD CONSTRAINT FK_DF80FBBF3A706D3 FOREIGN KEY (camion_id) REFERENCES camion (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incidence_camion ADD CONSTRAINT FK_DF80FBBFF22710E3 FOREIGN KEY (incidence_id) REFERENCES incidence (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
