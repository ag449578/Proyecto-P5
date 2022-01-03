<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220103171455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asignatura ADD anno_imparte_id INT NOT NULL');
        $this->addSql('ALTER TABLE asignatura ADD CONSTRAINT FK_9243D6CEF0CA256E FOREIGN KEY (anno_imparte_id) REFERENCES anno (id)');
        $this->addSql('CREATE INDEX IDX_9243D6CEF0CA256E ON asignatura (anno_imparte_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asignatura DROP FOREIGN KEY FK_9243D6CEF0CA256E');
        $this->addSql('DROP INDEX IDX_9243D6CEF0CA256E ON asignatura');
        $this->addSql('ALTER TABLE asignatura DROP anno_imparte_id');
    }
}
