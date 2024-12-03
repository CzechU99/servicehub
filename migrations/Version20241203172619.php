<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241203172619 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dane_uzytkownika (id INT AUTO_INCREMENT NOT NULL, uzytkownik_id INT NOT NULL, imie VARCHAR(255) NOT NULL, nazwisko VARCHAR(255) NOT NULL, miejscowosc VARCHAR(255) NOT NULL, numer_domu VARCHAR(255) NOT NULL, kod_pocztowy VARCHAR(255) NOT NULL, miasto VARCHAR(255) NOT NULL, telefon VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E1DD69B131D6FDE9 (uzytkownik_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, created DATETIME NOT NULL, level VARCHAR(255) NOT NULL, description VARCHAR(500) DEFAULT NULL, INDEX IDX_5E3DE477A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE uslugi (id INT AUTO_INCREMENT NOT NULL, uzytkownik_id INT NOT NULL, nazwa_uslugi VARCHAR(255) NOT NULL, cena DOUBLE PRECISION NOT NULL, data_dodania DATETIME NOT NULL, INDEX IDX_6947615231D6FDE9 (uzytkownik_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dane_uzytkownika ADD CONSTRAINT FK_E1DD69B131D6FDE9 FOREIGN KEY (uzytkownik_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE477A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE uslugi ADD CONSTRAINT FK_6947615231D6FDE9 FOREIGN KEY (uzytkownik_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dane_uzytkownika DROP FOREIGN KEY FK_E1DD69B131D6FDE9');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE477A76ED395');
        $this->addSql('ALTER TABLE uslugi DROP FOREIGN KEY FK_6947615231D6FDE9');
        $this->addSql('DROP TABLE dane_uzytkownika');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE uslugi');
    }
}
