<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240619235149 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE list_piece ADD piece_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE list_piece ADD CONSTRAINT FK_9D599F20C40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9D599F20C40FCFA8 ON list_piece (piece_id)');
        $this->addSql('ALTER TABLE piece DROP FOREIGN KEY FK_44CA0B23BA62FCC8');
        $this->addSql('DROP INDEX IDX_44CA0B23BA62FCC8 ON piece');
        $this->addSql('ALTER TABLE piece DROP list_piece_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE list_piece DROP FOREIGN KEY FK_9D599F20C40FCFA8');
        $this->addSql('DROP INDEX UNIQ_9D599F20C40FCFA8 ON list_piece');
        $this->addSql('ALTER TABLE list_piece DROP piece_id');
        $this->addSql('ALTER TABLE piece ADD list_piece_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE piece ADD CONSTRAINT FK_44CA0B23BA62FCC8 FOREIGN KEY (list_piece_id) REFERENCES list_piece (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_44CA0B23BA62FCC8 ON piece (list_piece_id)');
    }
}
