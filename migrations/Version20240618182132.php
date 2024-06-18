<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240618182132 extends AbstractMigration
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
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE incidence_camion DROP FOREIGN KEY FK_DF80FBBFF22710E3');
        $this->addSql('ALTER TABLE incidence_camion DROP FOREIGN KEY FK_DF80FBBF3A706D3');
        $this->addSql('DROP TABLE incidence_camion');
    }
}
