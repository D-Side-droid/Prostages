<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210115152549 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE stage (id INT AUTO_INCREMENT NOT NULL, formation_id INT NOT NULL, entreprises_id INT NOT NULL, intitule VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, duree VARCHAR(255) NOT NULL, competence_requise VARCHAR(255) NOT NULL, experience_requise VARCHAR(255) NOT NULL, INDEX IDX_C27C93695200282E (formation_id), INDEX IDX_C27C9369A70A18EC (entreprises_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C93695200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C9369A70A18EC FOREIGN KEY (entreprises_id) REFERENCES entreprise (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE stage');
    }
}
