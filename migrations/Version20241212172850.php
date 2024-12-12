<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241212172850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE obserwowane (id INT AUTO_INCREMENT NOT NULL, uzytkownik_id INT NOT NULL, usluga_id INT NOT NULL, INDEX IDX_2375A0BB31D6FDE9 (uzytkownik_id), INDEX IDX_2375A0BB589399BD (usluga_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE obserwowane ADD CONSTRAINT FK_2375A0BB31D6FDE9 FOREIGN KEY (uzytkownik_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE obserwowane ADD CONSTRAINT FK_2375A0BB589399BD FOREIGN KEY (usluga_id) REFERENCES uslugi (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE obserwowane DROP FOREIGN KEY FK_2375A0BB31D6FDE9');
        $this->addSql('ALTER TABLE obserwowane DROP FOREIGN KEY FK_2375A0BB589399BD');
        $this->addSql('DROP TABLE obserwowane');
    }
}
