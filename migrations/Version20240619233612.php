<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240619233612 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE list_piece_piece DROP FOREIGN KEY FK_D9C639C3BA62FCC8');
        $this->addSql('ALTER TABLE list_piece_piece DROP FOREIGN KEY FK_D9C639C3C40FCFA8');
        $this->addSql('ALTER TABLE videnge_list_piece DROP FOREIGN KEY FK_3F37CD38BA62FCC8');
        $this->addSql('ALTER TABLE videnge_list_piece DROP FOREIGN KEY FK_3F37CD38E926B931');
        $this->addSql('DROP TABLE list_piece_piece');
        $this->addSql('DROP TABLE videnge_list_piece');
        $this->addSql('ALTER TABLE list_piece ADD videnge_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE list_piece ADD CONSTRAINT FK_9D599F20E926B931 FOREIGN KEY (videnge_id) REFERENCES videnge (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9D599F20E926B931 ON list_piece (videnge_id)');
        $this->addSql('ALTER TABLE videnge ADD list_piece_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE videnge ADD CONSTRAINT FK_8483CDCBA62FCC8 FOREIGN KEY (list_piece_id) REFERENCES list_piece (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8483CDCBA62FCC8 ON videnge (list_piece_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE list_piece_piece (list_piece_id INT NOT NULL, piece_id INT NOT NULL, INDEX IDX_D9C639C3BA62FCC8 (list_piece_id), INDEX IDX_D9C639C3C40FCFA8 (piece_id), PRIMARY KEY(list_piece_id, piece_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE videnge_list_piece (videnge_id INT NOT NULL, list_piece_id INT NOT NULL, INDEX IDX_3F37CD38BA62FCC8 (list_piece_id), INDEX IDX_3F37CD38E926B931 (videnge_id), PRIMARY KEY(videnge_id, list_piece_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE list_piece_piece ADD CONSTRAINT FK_D9C639C3BA62FCC8 FOREIGN KEY (list_piece_id) REFERENCES list_piece (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE list_piece_piece ADD CONSTRAINT FK_D9C639C3C40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE videnge_list_piece ADD CONSTRAINT FK_3F37CD38BA62FCC8 FOREIGN KEY (list_piece_id) REFERENCES list_piece (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE videnge_list_piece ADD CONSTRAINT FK_3F37CD38E926B931 FOREIGN KEY (videnge_id) REFERENCES videnge (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE list_piece DROP FOREIGN KEY FK_9D599F20E926B931');
        $this->addSql('DROP INDEX UNIQ_9D599F20E926B931 ON list_piece');
        $this->addSql('ALTER TABLE list_piece DROP videnge_id');
        $this->addSql('ALTER TABLE videnge DROP FOREIGN KEY FK_8483CDCBA62FCC8');
        $this->addSql('DROP INDEX UNIQ_8483CDCBA62FCC8 ON videnge');
        $this->addSql('ALTER TABLE videnge DROP list_piece_id');
    }
}
