<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220102200757 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contenido (id INT AUTO_INCREMENT NOT NULL, seccion_id INT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion LONGTEXT NOT NULL, url_archivo VARCHAR(255) DEFAULT NULL, INDEX IDX_D0A7397F7A5A413A (seccion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seccion_contenidos (id INT AUTO_INCREMENT NOT NULL, asignatura_id INT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion LONGTEXT DEFAULT NULL, INDEX IDX_99B7AE15C5C70C5B (asignatura_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE solicitud (id INT AUTO_INCREMENT NOT NULL, estudiante_id INT NOT NULL, asignatura_id INT NOT NULL, titulo VARCHAR(255) NOT NULL, descripcion LONGTEXT NOT NULL, estado VARCHAR(255) NOT NULL, INDEX IDX_96D27CC059590C39 (estudiante_id), INDEX IDX_96D27CC0C5C70C5B (asignatura_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contenido ADD CONSTRAINT FK_D0A7397F7A5A413A FOREIGN KEY (seccion_id) REFERENCES seccion_contenidos (id)');
        $this->addSql('ALTER TABLE seccion_contenidos ADD CONSTRAINT FK_99B7AE15C5C70C5B FOREIGN KEY (asignatura_id) REFERENCES asignatura (id)');
        $this->addSql('ALTER TABLE solicitud ADD CONSTRAINT FK_96D27CC059590C39 FOREIGN KEY (estudiante_id) REFERENCES estudiante (id)');
        $this->addSql('ALTER TABLE solicitud ADD CONSTRAINT FK_96D27CC0C5C70C5B FOREIGN KEY (asignatura_id) REFERENCES asignatura (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contenido DROP FOREIGN KEY FK_D0A7397F7A5A413A');
        $this->addSql('DROP TABLE contenido');
        $this->addSql('DROP TABLE seccion_contenidos');
        $this->addSql('DROP TABLE solicitud');
    }
}
