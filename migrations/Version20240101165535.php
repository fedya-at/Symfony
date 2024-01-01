<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240101165535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipment (id INT AUTO_INCREMENT NOT NULL, chercheur_id INT DEFAULT NULL, project_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, state VARCHAR(255) NOT NULL, availability VARCHAR(255) NOT NULL, INDEX IDX_D338D583F0950B34 (chercheur_id), INDEX IDX_D338D583166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D583F0950B34 FOREIGN KEY (chercheur_id) REFERENCES chercheur (id)');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D583166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipment DROP FOREIGN KEY FK_D338D583F0950B34');
        $this->addSql('ALTER TABLE equipment DROP FOREIGN KEY FK_D338D583166D1F9C');
        $this->addSql('DROP TABLE equipment');
    }
}
