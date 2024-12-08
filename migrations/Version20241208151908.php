<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241208151908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rezerwacje (id INT AUTO_INCREMENT NOT NULL, uzytkownik_id_id INT NOT NULL, usluga_do_rezerwacji_id INT NOT NULL, usluga_na_wymiane_id INT DEFAULT NULL, wiadomosc VARCHAR(1000) DEFAULT NULL, udostepnij_telefon TINYINT(1) DEFAULT NULL, od_kiedy DATETIME NOT NULL, do_kiedy DATETIME DEFAULT NULL, data_zlozenia DATETIME NOT NULL, INDEX IDX_850574D2ED0C63F (uzytkownik_id_id), INDEX IDX_850574D234D64902 (usluga_do_rezerwacji_id), INDEX IDX_850574D2D46CB69A (usluga_na_wymiane_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rezerwacje ADD CONSTRAINT FK_850574D2ED0C63F FOREIGN KEY (uzytkownik_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rezerwacje ADD CONSTRAINT FK_850574D234D64902 FOREIGN KEY (usluga_do_rezerwacji_id) REFERENCES uslugi (id)');
        $this->addSql('ALTER TABLE rezerwacje ADD CONSTRAINT FK_850574D2D46CB69A FOREIGN KEY (usluga_na_wymiane_id) REFERENCES uslugi (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rezerwacje DROP FOREIGN KEY FK_850574D2ED0C63F');
        $this->addSql('ALTER TABLE rezerwacje DROP FOREIGN KEY FK_850574D234D64902');
        $this->addSql('ALTER TABLE rezerwacje DROP FOREIGN KEY FK_850574D2D46CB69A');
        $this->addSql('DROP TABLE rezerwacje');
    }
}
