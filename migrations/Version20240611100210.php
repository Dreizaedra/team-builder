<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240611100210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create language table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE language_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE language (id INT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D4DB71B55E237E06 ON language (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D4DB71B577153098 ON language (code)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE language_id_seq CASCADE');
        $this->addSql('DROP TABLE language');
    }
}
