<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240611161425 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE acheteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, contact VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE affectation (id INT AUTO_INCREMENT NOT NULL, chauffeur_id INT DEFAULT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, UNIQUE INDEX UNIQ_F4DD61D385C0B3BE (chauffeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE assurance (id INT AUTO_INCREMENT NOT NULL, camion_id INT DEFAULT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, compagnie VARCHAR(500) NOT NULL, num_police VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_386829AE3A706D3 (camion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE camion (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, type_camion_id INT DEFAULT NULL, tracteur_id INT DEFAULT NULL, inspection_id INT DEFAULT NULL, remorque VARCHAR(50) NOT NULL, date_integration DATE NOT NULL, location VARCHAR(50) NOT NULL, statut VARCHAR(20) NOT NULL, observation LONGTEXT NOT NULL, km_actuel DOUBLE PRECISION NOT NULL, INDEX IDX_5DD566ECBCF5E72D (categorie_id), INDEX IDX_5DD566ECB76147C3 (type_camion_id), UNIQUE INDEX UNIQ_5DD566ECEBA686DC (tracteur_id), INDEX IDX_5DD566ECF02F2DDF (inspection_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chauffeur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, contact VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE checklist (id INT AUTO_INCREMENT NOT NULL, camion_id INT DEFAULT NULL, date_checklist DATE NOT NULL, INDEX IDX_5C696D2F3A706D3 (camion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etiquette (id INT AUTO_INCREMENT NOT NULL, etat VARCHAR(20) NOT NULL, disponibilite TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etiquette_camion (etiquette_id INT NOT NULL, camion_id INT NOT NULL, INDEX IDX_86CFA087BD2EA57 (etiquette_id), INDEX IDX_86CFA083A706D3 (camion_id), PRIMARY KEY(etiquette_id, camion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grade_videnge (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE graissage (id INT AUTO_INCREMENT NOT NULL, date_graissage DATE NOT NULL, km_graissage DOUBLE PRECISION NOT NULL, ecart_type DOUBLE PRECISION NOT NULL, nb_km_restant DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE graissage_camion (graissage_id INT NOT NULL, camion_id INT NOT NULL, INDEX IDX_8DDFFF68CDA9C01F (graissage_id), INDEX IDX_8DDFFF683A706D3 (camion_id), PRIMARY KEY(graissage_id, camion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique (id INT AUTO_INCREMENT NOT NULL, type_personnel VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique_chauffeur (historique_id INT NOT NULL, chauffeur_id INT NOT NULL, INDEX IDX_FD43CF06128735E (historique_id), INDEX IDX_FD43CF085C0B3BE (chauffeur_id), PRIMARY KEY(historique_id, chauffeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique_camion (id INT AUTO_INCREMENT NOT NULL, date_suppression DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique_camion_camion (historique_camion_id INT NOT NULL, camion_id INT NOT NULL, INDEX IDX_1226BE9550D44D9B (historique_camion_id), INDEX IDX_1226BE953A706D3 (camion_id), PRIMARY KEY(historique_camion_id, camion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incidence (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(30) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incidence_camion (incidence_id INT NOT NULL, camion_id INT NOT NULL, INDEX IDX_DF80FBBFF22710E3 (incidence_id), INDEX IDX_DF80FBBF3A706D3 (camion_id), PRIMARY KEY(incidence_id, camion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inspecteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, contact VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inspection (id INT AUTO_INCREMENT NOT NULL, inspecteur_id INT DEFAULT NULL, date_inspection DATE NOT NULL, resultat TINYINT(1) NOT NULL, commentaire LONGTEXT NOT NULL, INDEX IDX_F9F13485B7728AA0 (inspecteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE list_piece (id INT AUTO_INCREMENT NOT NULL, quantite INT NOT NULL, prix_total DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE list_piece_piece (list_piece_id INT NOT NULL, piece_id INT NOT NULL, INDEX IDX_D9C639C3BA62FCC8 (list_piece_id), INDEX IDX_D9C639C3C40FCFA8 (piece_id), PRIMARY KEY(list_piece_id, piece_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE piece (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, marque VARCHAR(50) NOT NULL, nb_reference VARCHAR(50) NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recu (id INT AUTO_INCREMENT NOT NULL, image_recu VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recu_vendeur (recu_id INT NOT NULL, vendeur_id INT NOT NULL, INDEX IDX_795D7D15A5D1C184 (recu_id), INDEX IDX_795D7D15858C065E (vendeur_id), PRIMARY KEY(recu_id, vendeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recu_acheteur (recu_id INT NOT NULL, acheteur_id INT NOT NULL, INDEX IDX_44F884E3A5D1C184 (recu_id), INDEX IDX_44F884E396A7BB5F (acheteur_id), PRIMARY KEY(recu_id, acheteur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reparation (id INT AUTO_INCREMENT NOT NULL, incident_id INT DEFAULT NULL, date_reparation DATE NOT NULL, description VARCHAR(255) NOT NULL, cout DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_8FDF219D59E53FB9 (incident_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tracabilite (id INT AUTO_INCREMENT NOT NULL, intervenant VARCHAR(100) NOT NULL, date_intervention DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tracabilite_camion (tracabilite_id INT NOT NULL, camion_id INT NOT NULL, INDEX IDX_604DFFBAFB4204EB (tracabilite_id), INDEX IDX_604DFFBA3A706D3 (camion_id), PRIMARY KEY(tracabilite_id, camion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tracteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_camion (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, km_videnge DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vendeur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, contact VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE videnge (id INT AUTO_INCREMENT NOT NULL, grade_videnge_id INT DEFAULT NULL, km_videnge DOUBLE PRECISION NOT NULL, ecart_type DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_8483CDC85A68B0 (grade_videnge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE videnge_camion (videnge_id INT NOT NULL, camion_id INT NOT NULL, INDEX IDX_160A14EFE926B931 (videnge_id), INDEX IDX_160A14EF3A706D3 (camion_id), PRIMARY KEY(videnge_id, camion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE videnge_list_piece (videnge_id INT NOT NULL, list_piece_id INT NOT NULL, INDEX IDX_3F37CD38E926B931 (videnge_id), INDEX IDX_3F37CD38BA62FCC8 (list_piece_id), PRIMARY KEY(videnge_id, list_piece_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE affectation ADD CONSTRAINT FK_F4DD61D385C0B3BE FOREIGN KEY (chauffeur_id) REFERENCES chauffeur (id)');
        $this->addSql('ALTER TABLE assurance ADD CONSTRAINT FK_386829AE3A706D3 FOREIGN KEY (camion_id) REFERENCES camion (id)');
        $this->addSql('ALTER TABLE camion ADD CONSTRAINT FK_5DD566ECBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE camion ADD CONSTRAINT FK_5DD566ECB76147C3 FOREIGN KEY (type_camion_id) REFERENCES type_camion (id)');
        $this->addSql('ALTER TABLE camion ADD CONSTRAINT FK_5DD566ECEBA686DC FOREIGN KEY (tracteur_id) REFERENCES tracteur (id)');
        $this->addSql('ALTER TABLE camion ADD CONSTRAINT FK_5DD566ECF02F2DDF FOREIGN KEY (inspection_id) REFERENCES inspection (id)');
        $this->addSql('ALTER TABLE checklist ADD CONSTRAINT FK_5C696D2F3A706D3 FOREIGN KEY (camion_id) REFERENCES camion (id)');
        $this->addSql('ALTER TABLE etiquette_camion ADD CONSTRAINT FK_86CFA087BD2EA57 FOREIGN KEY (etiquette_id) REFERENCES etiquette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etiquette_camion ADD CONSTRAINT FK_86CFA083A706D3 FOREIGN KEY (camion_id) REFERENCES camion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE graissage_camion ADD CONSTRAINT FK_8DDFFF68CDA9C01F FOREIGN KEY (graissage_id) REFERENCES graissage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE graissage_camion ADD CONSTRAINT FK_8DDFFF683A706D3 FOREIGN KEY (camion_id) REFERENCES camion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE historique_chauffeur ADD CONSTRAINT FK_FD43CF06128735E FOREIGN KEY (historique_id) REFERENCES historique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE historique_chauffeur ADD CONSTRAINT FK_FD43CF085C0B3BE FOREIGN KEY (chauffeur_id) REFERENCES chauffeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE historique_camion_camion ADD CONSTRAINT FK_1226BE9550D44D9B FOREIGN KEY (historique_camion_id) REFERENCES historique_camion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE historique_camion_camion ADD CONSTRAINT FK_1226BE953A706D3 FOREIGN KEY (camion_id) REFERENCES camion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incidence_camion ADD CONSTRAINT FK_DF80FBBFF22710E3 FOREIGN KEY (incidence_id) REFERENCES incidence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incidence_camion ADD CONSTRAINT FK_DF80FBBF3A706D3 FOREIGN KEY (camion_id) REFERENCES camion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inspection ADD CONSTRAINT FK_F9F13485B7728AA0 FOREIGN KEY (inspecteur_id) REFERENCES inspecteur (id)');
        $this->addSql('ALTER TABLE list_piece_piece ADD CONSTRAINT FK_D9C639C3BA62FCC8 FOREIGN KEY (list_piece_id) REFERENCES list_piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE list_piece_piece ADD CONSTRAINT FK_D9C639C3C40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recu_vendeur ADD CONSTRAINT FK_795D7D15A5D1C184 FOREIGN KEY (recu_id) REFERENCES recu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recu_vendeur ADD CONSTRAINT FK_795D7D15858C065E FOREIGN KEY (vendeur_id) REFERENCES vendeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recu_acheteur ADD CONSTRAINT FK_44F884E3A5D1C184 FOREIGN KEY (recu_id) REFERENCES recu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recu_acheteur ADD CONSTRAINT FK_44F884E396A7BB5F FOREIGN KEY (acheteur_id) REFERENCES acheteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reparation ADD CONSTRAINT FK_8FDF219D59E53FB9 FOREIGN KEY (incident_id) REFERENCES incidence (id)');
        $this->addSql('ALTER TABLE tracabilite_camion ADD CONSTRAINT FK_604DFFBAFB4204EB FOREIGN KEY (tracabilite_id) REFERENCES tracabilite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tracabilite_camion ADD CONSTRAINT FK_604DFFBA3A706D3 FOREIGN KEY (camion_id) REFERENCES camion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE videnge ADD CONSTRAINT FK_8483CDC85A68B0 FOREIGN KEY (grade_videnge_id) REFERENCES grade_videnge (id)');
        $this->addSql('ALTER TABLE videnge_camion ADD CONSTRAINT FK_160A14EFE926B931 FOREIGN KEY (videnge_id) REFERENCES videnge (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE videnge_camion ADD CONSTRAINT FK_160A14EF3A706D3 FOREIGN KEY (camion_id) REFERENCES camion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE videnge_list_piece ADD CONSTRAINT FK_3F37CD38E926B931 FOREIGN KEY (videnge_id) REFERENCES videnge (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE videnge_list_piece ADD CONSTRAINT FK_3F37CD38BA62FCC8 FOREIGN KEY (list_piece_id) REFERENCES list_piece (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE affectation DROP FOREIGN KEY FK_F4DD61D385C0B3BE');
        $this->addSql('ALTER TABLE assurance DROP FOREIGN KEY FK_386829AE3A706D3');
        $this->addSql('ALTER TABLE camion DROP FOREIGN KEY FK_5DD566ECBCF5E72D');
        $this->addSql('ALTER TABLE camion DROP FOREIGN KEY FK_5DD566ECB76147C3');
        $this->addSql('ALTER TABLE camion DROP FOREIGN KEY FK_5DD566ECEBA686DC');
        $this->addSql('ALTER TABLE camion DROP FOREIGN KEY FK_5DD566ECF02F2DDF');
        $this->addSql('ALTER TABLE checklist DROP FOREIGN KEY FK_5C696D2F3A706D3');
        $this->addSql('ALTER TABLE etiquette_camion DROP FOREIGN KEY FK_86CFA087BD2EA57');
        $this->addSql('ALTER TABLE etiquette_camion DROP FOREIGN KEY FK_86CFA083A706D3');
        $this->addSql('ALTER TABLE graissage_camion DROP FOREIGN KEY FK_8DDFFF68CDA9C01F');
        $this->addSql('ALTER TABLE graissage_camion DROP FOREIGN KEY FK_8DDFFF683A706D3');
        $this->addSql('ALTER TABLE historique_chauffeur DROP FOREIGN KEY FK_FD43CF06128735E');
        $this->addSql('ALTER TABLE historique_chauffeur DROP FOREIGN KEY FK_FD43CF085C0B3BE');
        $this->addSql('ALTER TABLE historique_camion_camion DROP FOREIGN KEY FK_1226BE9550D44D9B');
        $this->addSql('ALTER TABLE historique_camion_camion DROP FOREIGN KEY FK_1226BE953A706D3');
        $this->addSql('ALTER TABLE incidence_camion DROP FOREIGN KEY FK_DF80FBBFF22710E3');
        $this->addSql('ALTER TABLE incidence_camion DROP FOREIGN KEY FK_DF80FBBF3A706D3');
        $this->addSql('ALTER TABLE inspection DROP FOREIGN KEY FK_F9F13485B7728AA0');
        $this->addSql('ALTER TABLE list_piece_piece DROP FOREIGN KEY FK_D9C639C3BA62FCC8');
        $this->addSql('ALTER TABLE list_piece_piece DROP FOREIGN KEY FK_D9C639C3C40FCFA8');
        $this->addSql('ALTER TABLE recu_vendeur DROP FOREIGN KEY FK_795D7D15A5D1C184');
        $this->addSql('ALTER TABLE recu_vendeur DROP FOREIGN KEY FK_795D7D15858C065E');
        $this->addSql('ALTER TABLE recu_acheteur DROP FOREIGN KEY FK_44F884E3A5D1C184');
        $this->addSql('ALTER TABLE recu_acheteur DROP FOREIGN KEY FK_44F884E396A7BB5F');
        $this->addSql('ALTER TABLE reparation DROP FOREIGN KEY FK_8FDF219D59E53FB9');
        $this->addSql('ALTER TABLE tracabilite_camion DROP FOREIGN KEY FK_604DFFBAFB4204EB');
        $this->addSql('ALTER TABLE tracabilite_camion DROP FOREIGN KEY FK_604DFFBA3A706D3');
        $this->addSql('ALTER TABLE videnge DROP FOREIGN KEY FK_8483CDC85A68B0');
        $this->addSql('ALTER TABLE videnge_camion DROP FOREIGN KEY FK_160A14EFE926B931');
        $this->addSql('ALTER TABLE videnge_camion DROP FOREIGN KEY FK_160A14EF3A706D3');
        $this->addSql('ALTER TABLE videnge_list_piece DROP FOREIGN KEY FK_3F37CD38E926B931');
        $this->addSql('ALTER TABLE videnge_list_piece DROP FOREIGN KEY FK_3F37CD38BA62FCC8');
        $this->addSql('DROP TABLE acheteur');
        $this->addSql('DROP TABLE affectation');
        $this->addSql('DROP TABLE assurance');
        $this->addSql('DROP TABLE camion');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE chauffeur');
        $this->addSql('DROP TABLE checklist');
        $this->addSql('DROP TABLE etiquette');
        $this->addSql('DROP TABLE etiquette_camion');
        $this->addSql('DROP TABLE grade_videnge');
        $this->addSql('DROP TABLE graissage');
        $this->addSql('DROP TABLE graissage_camion');
        $this->addSql('DROP TABLE historique');
        $this->addSql('DROP TABLE historique_chauffeur');
        $this->addSql('DROP TABLE historique_camion');
        $this->addSql('DROP TABLE historique_camion_camion');
        $this->addSql('DROP TABLE incidence');
        $this->addSql('DROP TABLE incidence_camion');
        $this->addSql('DROP TABLE inspecteur');
        $this->addSql('DROP TABLE inspection');
        $this->addSql('DROP TABLE list_piece');
        $this->addSql('DROP TABLE list_piece_piece');
        $this->addSql('DROP TABLE piece');
        $this->addSql('DROP TABLE recu');
        $this->addSql('DROP TABLE recu_vendeur');
        $this->addSql('DROP TABLE recu_acheteur');
        $this->addSql('DROP TABLE reparation');
        $this->addSql('DROP TABLE tracabilite');
        $this->addSql('DROP TABLE tracabilite_camion');
        $this->addSql('DROP TABLE tracteur');
        $this->addSql('DROP TABLE type_camion');
        $this->addSql('DROP TABLE vendeur');
        $this->addSql('DROP TABLE videnge');
        $this->addSql('DROP TABLE videnge_camion');
        $this->addSql('DROP TABLE videnge_list_piece');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
