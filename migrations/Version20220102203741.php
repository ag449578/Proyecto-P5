<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220102203741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE estudiantes (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estudiantes_asignatura (estudiantes_id INT NOT NULL, asignatura_id INT NOT NULL, INDEX IDX_DAD98FA7B82D6C21 (estudiantes_id), INDEX IDX_DAD98FA7C5C70C5B (asignatura_id), PRIMARY KEY(estudiantes_id, asignatura_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE estudiantes_asignatura ADD CONSTRAINT FK_DAD98FA7B82D6C21 FOREIGN KEY (estudiantes_id) REFERENCES estudiantes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE estudiantes_asignatura ADD CONSTRAINT FK_DAD98FA7C5C70C5B FOREIGN KEY (asignatura_id) REFERENCES asignatura (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE estudiantes_asignatura DROP FOREIGN KEY FK_DAD98FA7B82D6C21');
        $this->addSql('DROP TABLE estudiantes');
        $this->addSql('DROP TABLE estudiantes_asignatura');
    }
}
