<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211227024337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE administrador (id INT NOT NULL, telefono_emergencia INT NOT NULL, centro VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estudiante (id INT NOT NULL, anno_cursa VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profesor (id INT NOT NULL, categoria_docente VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, correo VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nomb_usuario VARCHAR(255) NOT NULL, solapin VARCHAR(255) NOT NULL, discr VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2265B05D77040BC9 (correo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE administrador ADD CONSTRAINT FK_44F9A521BF396750 FOREIGN KEY (id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE estudiante ADD CONSTRAINT FK_3B3F3FADBF396750 FOREIGN KEY (id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profesor ADD CONSTRAINT FK_5B7406D9BF396750 FOREIGN KEY (id) REFERENCES usuario (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE administrador DROP FOREIGN KEY FK_44F9A521BF396750');
        $this->addSql('ALTER TABLE estudiante DROP FOREIGN KEY FK_3B3F3FADBF396750');
        $this->addSql('ALTER TABLE profesor DROP FOREIGN KEY FK_5B7406D9BF396750');
        $this->addSql('DROP TABLE administrador');
        $this->addSql('DROP TABLE estudiante');
        $this->addSql('DROP TABLE profesor');
        $this->addSql('DROP TABLE usuario');
    }
}
