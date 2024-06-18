<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240618183913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inspection ADD camion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inspection ADD CONSTRAINT FK_F9F134853A706D3 FOREIGN KEY (camion_id) REFERENCES camion (id)');
        $this->addSql('CREATE INDEX IDX_F9F134853A706D3 ON inspection (camion_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inspection DROP FOREIGN KEY FK_F9F134853A706D3');
        $this->addSql('DROP INDEX IDX_F9F134853A706D3 ON inspection');
        $this->addSql('ALTER TABLE inspection DROP camion_id');
    }
}
