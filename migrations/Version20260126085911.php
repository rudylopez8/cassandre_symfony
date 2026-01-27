<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260126085911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ai_assistant_history (id INT AUTO_INCREMENT NOT NULL, assistant_id INT NOT NULL, user_id INT NOT NULL, prompt VARCHAR(1023) NOT NULL, response VARCHAR(1023) NOT NULL, timestamp DATETIME NOT NULL, INDEX IDX_40F68F41E05387EF (assistant_id), INDEX IDX_40F68F41A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ai_assistant_history ADD CONSTRAINT FK_40F68F41E05387EF FOREIGN KEY (assistant_id) REFERENCES ai_assistant (id)');
        $this->addSql('ALTER TABLE ai_assistant_history ADD CONSTRAINT FK_40F68F41A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ai_assistant_history DROP FOREIGN KEY FK_40F68F41E05387EF');
        $this->addSql('ALTER TABLE ai_assistant_history DROP FOREIGN KEY FK_40F68F41A76ED395');
        $this->addSql('DROP TABLE ai_assistant_history');
    }
}
