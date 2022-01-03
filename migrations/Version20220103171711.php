<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220103171711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE asignatura_estudiante (asignatura_id INT NOT NULL, estudiante_id INT NOT NULL, INDEX IDX_731EBBE3C5C70C5B (asignatura_id), INDEX IDX_731EBBE359590C39 (estudiante_id), PRIMARY KEY(asignatura_id, estudiante_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE asignatura_estudiante ADD CONSTRAINT FK_731EBBE3C5C70C5B FOREIGN KEY (asignatura_id) REFERENCES asignatura (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE asignatura_estudiante ADD CONSTRAINT FK_731EBBE359590C39 FOREIGN KEY (estudiante_id) REFERENCES estudiante (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE asignatura_estudiante');
    }
}
