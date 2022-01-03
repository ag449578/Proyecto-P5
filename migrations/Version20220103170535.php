<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220103170535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE administrador (id INT NOT NULL, telefono_emergencia INT NOT NULL, centro VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE anno (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asignatura (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion LONGTEXT NOT NULL, url_imagen VARCHAR(255) DEFAULT NULL, semestre INT NOT NULL, horas_clase INT NOT NULL, cantidad_temas INT NOT NULL, es_curricular TINYINT(1) NOT NULL, departamento VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contenido (id INT AUTO_INCREMENT NOT NULL, seccion_id INT NOT NULL, seccion_contenidos_id INT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion LONGTEXT NOT NULL, url_archivo VARCHAR(255) DEFAULT NULL, INDEX IDX_D0A7397F7A5A413A (seccion_id), INDEX IDX_D0A7397F192D137A (seccion_contenidos_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estudiante (id INT NOT NULL, anno_cursa_id INT NOT NULL, INDEX IDX_3B3F3FAD90E1746E (anno_cursa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profesor (id INT NOT NULL, asignatura_id INT NOT NULL, categoria_docente VARCHAR(255) NOT NULL, INDEX IDX_5B7406D9C5C70C5B (asignatura_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seccion_contenidos (id INT AUTO_INCREMENT NOT NULL, asignatura_id INT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion LONGTEXT DEFAULT NULL, INDEX IDX_99B7AE15C5C70C5B (asignatura_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE solicitud (id INT AUTO_INCREMENT NOT NULL, estudiante_id INT NOT NULL, asignatura_id INT NOT NULL, titulo VARCHAR(255) NOT NULL, descripcion LONGTEXT NOT NULL, estado VARCHAR(255) NOT NULL, INDEX IDX_96D27CC059590C39 (estudiante_id), INDEX IDX_96D27CC0C5C70C5B (asignatura_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, correo VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nomb_usuario VARCHAR(255) NOT NULL, solapin VARCHAR(255) NOT NULL, discr VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2265B05D77040BC9 (correo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE administrador ADD CONSTRAINT FK_44F9A521BF396750 FOREIGN KEY (id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contenido ADD CONSTRAINT FK_D0A7397F7A5A413A FOREIGN KEY (seccion_id) REFERENCES seccion_contenidos (id)');
        $this->addSql('ALTER TABLE contenido ADD CONSTRAINT FK_D0A7397F192D137A FOREIGN KEY (seccion_contenidos_id) REFERENCES seccion_contenidos (id)');
        $this->addSql('ALTER TABLE estudiante ADD CONSTRAINT FK_3B3F3FAD90E1746E FOREIGN KEY (anno_cursa_id) REFERENCES anno (id)');
        $this->addSql('ALTER TABLE estudiante ADD CONSTRAINT FK_3B3F3FADBF396750 FOREIGN KEY (id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profesor ADD CONSTRAINT FK_5B7406D9C5C70C5B FOREIGN KEY (asignatura_id) REFERENCES asignatura (id)');
        $this->addSql('ALTER TABLE profesor ADD CONSTRAINT FK_5B7406D9BF396750 FOREIGN KEY (id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE seccion_contenidos ADD CONSTRAINT FK_99B7AE15C5C70C5B FOREIGN KEY (asignatura_id) REFERENCES asignatura (id)');
        $this->addSql('ALTER TABLE solicitud ADD CONSTRAINT FK_96D27CC059590C39 FOREIGN KEY (estudiante_id) REFERENCES estudiante (id)');
        $this->addSql('ALTER TABLE solicitud ADD CONSTRAINT FK_96D27CC0C5C70C5B FOREIGN KEY (asignatura_id) REFERENCES asignatura (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE estudiante DROP FOREIGN KEY FK_3B3F3FAD90E1746E');
        $this->addSql('ALTER TABLE profesor DROP FOREIGN KEY FK_5B7406D9C5C70C5B');
        $this->addSql('ALTER TABLE seccion_contenidos DROP FOREIGN KEY FK_99B7AE15C5C70C5B');
        $this->addSql('ALTER TABLE solicitud DROP FOREIGN KEY FK_96D27CC0C5C70C5B');
        $this->addSql('ALTER TABLE solicitud DROP FOREIGN KEY FK_96D27CC059590C39');
        $this->addSql('ALTER TABLE contenido DROP FOREIGN KEY FK_D0A7397F7A5A413A');
        $this->addSql('ALTER TABLE contenido DROP FOREIGN KEY FK_D0A7397F192D137A');
        $this->addSql('ALTER TABLE administrador DROP FOREIGN KEY FK_44F9A521BF396750');
        $this->addSql('ALTER TABLE estudiante DROP FOREIGN KEY FK_3B3F3FADBF396750');
        $this->addSql('ALTER TABLE profesor DROP FOREIGN KEY FK_5B7406D9BF396750');
        $this->addSql('DROP TABLE administrador');
        $this->addSql('DROP TABLE anno');
        $this->addSql('DROP TABLE asignatura');
        $this->addSql('DROP TABLE contenido');
        $this->addSql('DROP TABLE estudiante');
        $this->addSql('DROP TABLE profesor');
        $this->addSql('DROP TABLE seccion_contenidos');
        $this->addSql('DROP TABLE solicitud');
        $this->addSql('DROP TABLE usuario');
    }
}
