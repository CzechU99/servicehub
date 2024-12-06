<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241205220051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE uslugi ADD opis_uslugi VARCHAR(1000) NOT NULL, ADD do_negocjacji TINYINT(1) NOT NULL, ADD czy_firma TINYINT(1) NOT NULL, ADD czy_wymiana TINYINT(1) NOT NULL, ADD czy_stawka_godzinowa TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE uslugi DROP opis_uslugi, DROP do_negocjacji, DROP czy_firma, DROP czy_wymiana, DROP czy_stawka_godzinowa');
    }
}
