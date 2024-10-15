<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241015085611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte_rendu ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE compte_rendu ADD CONSTRAINT FK_D39E69D2A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_D39E69D2A76ED395 ON compte_rendu (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte_rendu DROP FOREIGN KEY FK_D39E69D2A76ED395');
        $this->addSql('DROP INDEX IDX_D39E69D2A76ED395 ON compte_rendu');
        $this->addSql('ALTER TABLE compte_rendu DROP user_id');
    }
}
