<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241203233700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dane_uzytkownika ADD szerokosc_geograficzna DOUBLE PRECISION NOT NULL, ADD dlugosc_geograficzna DOUBLE PRECISION NOT NULL');
        $this->addSql('DROP INDEX nazwa_uslugi ON uslugi');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dane_uzytkownika DROP szerokosc_geograficzna, DROP dlugosc_geograficzna');
        $this->addSql('CREATE FULLTEXT INDEX nazwa_uslugi ON uslugi (nazwa_uslugi)');
    }
}
