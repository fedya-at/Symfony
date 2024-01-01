<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240101105427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chercheur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, birth DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chercheur_project (chercheur_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_9572BE16F0950B34 (chercheur_id), INDEX IDX_9572BE16166D1F9C (project_id), PRIMARY KEY(chercheur_id, project_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chercheur_publication (chercheur_id INT NOT NULL, publication_id INT NOT NULL, INDEX IDX_57F20386F0950B34 (chercheur_id), INDEX IDX_57F2038638B217A7 (publication_id), PRIMARY KEY(chercheur_id, publication_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chercheur_project ADD CONSTRAINT FK_9572BE16F0950B34 FOREIGN KEY (chercheur_id) REFERENCES chercheur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chercheur_project ADD CONSTRAINT FK_9572BE16166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chercheur_publication ADD CONSTRAINT FK_57F20386F0950B34 FOREIGN KEY (chercheur_id) REFERENCES chercheur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chercheur_publication ADD CONSTRAINT FK_57F2038638B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chercheur_project DROP FOREIGN KEY FK_9572BE16F0950B34');
        $this->addSql('ALTER TABLE chercheur_project DROP FOREIGN KEY FK_9572BE16166D1F9C');
        $this->addSql('ALTER TABLE chercheur_publication DROP FOREIGN KEY FK_57F20386F0950B34');
        $this->addSql('ALTER TABLE chercheur_publication DROP FOREIGN KEY FK_57F2038638B217A7');
        $this->addSql('DROP TABLE chercheur');
        $this->addSql('DROP TABLE chercheur_project');
        $this->addSql('DROP TABLE chercheur_publication');
    }
}
