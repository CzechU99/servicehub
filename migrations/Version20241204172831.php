<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241204172831 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE kategorie_uslugi (kategorie_id INT NOT NULL, uslugi_id INT NOT NULL, INDEX IDX_9C725424BAF991D3 (kategorie_id), INDEX IDX_9C7254249D27B152 (uslugi_id), PRIMARY KEY(kategorie_id, uslugi_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE kategorie_uslugi ADD CONSTRAINT FK_9C725424BAF991D3 FOREIGN KEY (kategorie_id) REFERENCES kategorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kategorie_uslugi ADD CONSTRAINT FK_9C7254249D27B152 FOREIGN KEY (uslugi_id) REFERENCES uslugi (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE kategorie_uslugi DROP FOREIGN KEY FK_9C725424BAF991D3');
        $this->addSql('ALTER TABLE kategorie_uslugi DROP FOREIGN KEY FK_9C7254249D27B152');
        $this->addSql('DROP TABLE kategorie_uslugi');
    }
}
