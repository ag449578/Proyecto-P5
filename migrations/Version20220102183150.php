<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220102183150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE anno (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asignatura (id INT AUTO_INCREMENT NOT NULL, anno_imparte_id INT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, url_imagen VARCHAR(255) DEFAULT NULL, semestre INT NOT NULL, horas_clase INT NOT NULL, cantidad_temas INT NOT NULL, es_curricular TINYINT(1) NOT NULL, departamento VARCHAR(255) NOT NULL, INDEX IDX_9243D6CEF0CA256E (anno_imparte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE asignatura ADD CONSTRAINT FK_9243D6CEF0CA256E FOREIGN KEY (anno_imparte_id) REFERENCES anno (id)');
        $this->addSql('ALTER TABLE estudiante ADD anno_cursa_id INT NOT NULL, DROP anno_cursa');
        $this->addSql('ALTER TABLE estudiante ADD CONSTRAINT FK_3B3F3FAD90E1746E FOREIGN KEY (anno_cursa_id) REFERENCES anno (id)');
        $this->addSql('CREATE INDEX IDX_3B3F3FAD90E1746E ON estudiante (anno_cursa_id)');
        $this->addSql('ALTER TABLE profesor ADD asignatura_id INT NOT NULL');
        $this->addSql('ALTER TABLE profesor ADD CONSTRAINT FK_5B7406D9C5C70C5B FOREIGN KEY (asignatura_id) REFERENCES asignatura (id)');
        $this->addSql('CREATE INDEX IDX_5B7406D9C5C70C5B ON profesor (asignatura_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asignatura DROP FOREIGN KEY FK_9243D6CEF0CA256E');
        $this->addSql('ALTER TABLE estudiante DROP FOREIGN KEY FK_3B3F3FAD90E1746E');
        $this->addSql('ALTER TABLE profesor DROP FOREIGN KEY FK_5B7406D9C5C70C5B');
        $this->addSql('DROP TABLE anno');
        $this->addSql('DROP TABLE asignatura');
        $this->addSql('DROP INDEX IDX_3B3F3FAD90E1746E ON estudiante');
        $this->addSql('ALTER TABLE estudiante ADD anno_cursa VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP anno_cursa_id');
        $this->addSql('DROP INDEX IDX_5B7406D9C5C70C5B ON profesor');
        $this->addSql('ALTER TABLE profesor DROP asignatura_id');
    }
}
