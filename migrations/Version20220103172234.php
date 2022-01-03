<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220103172234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contenido DROP FOREIGN KEY FK_D0A7397F7A5A413A');
        $this->addSql('DROP INDEX IDX_D0A7397F7A5A413A ON contenido');
        $this->addSql('ALTER TABLE contenido DROP seccion_id');
        $this->addSql('ALTER TABLE solicitud DROP FOREIGN KEY FK_96D27CC0C5C70C5B');
        $this->addSql('DROP INDEX IDX_96D27CC0C5C70C5B ON solicitud');
        $this->addSql('ALTER TABLE solicitud DROP asignatura_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contenido ADD seccion_id INT NOT NULL');
        $this->addSql('ALTER TABLE contenido ADD CONSTRAINT FK_D0A7397F7A5A413A FOREIGN KEY (seccion_id) REFERENCES seccion_contenidos (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D0A7397F7A5A413A ON contenido (seccion_id)');
        $this->addSql('ALTER TABLE solicitud ADD asignatura_id INT NOT NULL');
        $this->addSql('ALTER TABLE solicitud ADD CONSTRAINT FK_96D27CC0C5C70C5B FOREIGN KEY (asignatura_id) REFERENCES asignatura (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_96D27CC0C5C70C5B ON solicitud (asignatura_id)');
    }
}
