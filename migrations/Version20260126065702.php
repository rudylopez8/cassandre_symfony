<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260126065702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE audit (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, status VARCHAR(32) NOT NULL, start_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, notes VARCHAR(511) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, INDEX IDX_9218FF79979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE audit_assignment (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, audit_id INT NOT NULL, role_on_audit VARCHAR(64) NOT NULL, INDEX IDX_4D1B5C45A76ED395 (user_id), INDEX IDX_4D1B5C45BD29F359 (audit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE audit_legal_document (id INT AUTO_INCREMENT NOT NULL, audit_id INT NOT NULL, document_id INT NOT NULL, type VARCHAR(64) NOT NULL, status VARCHAR(64) DEFAULT NULL, signed_at DATETIME DEFAULT NULL, INDEX IDX_8F9BEC9EBD29F359 (audit_id), UNIQUE INDEX UNIQ_8F9BEC9EC33F7837 (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE audit_observation (id INT AUTO_INCREMENT NOT NULL, audit_id INT NOT NULL, document_id INT DEFAULT NULL, type VARCHAR(32) NOT NULL, description VARCHAR(255) NOT NULL, location VARCHAR(128) DEFAULT NULL, recommendation VARCHAR(511) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL, INDEX IDX_E809EA75BD29F359 (audit_id), INDEX IDX_E809EA75C33F7837 (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE audit_report (id INT AUTO_INCREMENT NOT NULL, audit_id INT NOT NULL, validated_by_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content VARCHAR(1023) NOT NULL, status VARCHAR(32) NOT NULL, validation_date DATETIME DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_E7F15B5FBD29F359 (audit_id), INDEX IDX_E7F15B5FC69DE5E5 (validated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE certification (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, price NUMERIC(10, 2) NOT NULL, duration INT NOT NULL, is_active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE certification_result (id INT AUTO_INCREMENT NOT NULL, certification_id INT NOT NULL, user_id INT NOT NULL, score INT NOT NULL, status VARCHAR(32) NOT NULL, evaluation_details JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_F542D8A4CB47068A (certification_id), INDEX IDX_F542D8A4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, siren VARCHAR(16) NOT NULL, siret VARCHAR(16) DEFAULT NULL, sector VARCHAR(128) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, contact_email VARCHAR(255) NOT NULL, contact_phone VARCHAR(16) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, original_name VARCHAR(255) NOT NULL, storage_name VARCHAR(255) NOT NULL, storage_path VARCHAR(255) NOT NULL, mime_type VARCHAR(128) NOT NULL, octets_size INT NOT NULL, is_public TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, audit_id INT NOT NULL, certification_result_id INT DEFAULT NULL, total_ht NUMERIC(10, 2) NOT NULL, total_ttc NUMERIC(10, 2) NOT NULL, status VARCHAR(32) NOT NULL, due_date DATE NOT NULL, payment_date DATETIME DEFAULT NULL, path VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_90651744979B1AD6 (company_id), INDEX IDX_90651744BD29F359 (audit_id), INDEX IDX_9065174469035FD2 (certification_result_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice_line (id INT AUTO_INCREMENT NOT NULL, invoice_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, quantite INT NOT NULL, unit_price_ht NUMERIC(10, 2) NOT NULL, taux_tva NUMERIC(10, 2) NOT NULL, total_line_ttc NUMERIC(10, 2) NOT NULL, INDEX IDX_D3D1D6932989F1FD (invoice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permission (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(64) NOT NULL, description VARCHAR(128) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, description VARCHAR(128) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_permission (id INT AUTO_INCREMENT NOT NULL, role_id INT NOT NULL, permission_id INT NOT NULL, INDEX IDX_6F7DF886D60322AC (role_id), INDEX IDX_6F7DF886FED90CCA (permission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, email VARCHAR(128) NOT NULL, password_hash VARCHAR(255) NOT NULL, first_name VARCHAR(64) NOT NULL, last_name VARCHAR(64) NOT NULL, phone VARCHAR(16) DEFAULT NULL, last_login DATETIME DEFAULT NULL, is_active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, INDEX IDX_8D93D649D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE audit ADD CONSTRAINT FK_9218FF79979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE audit_assignment ADD CONSTRAINT FK_4D1B5C45A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE audit_assignment ADD CONSTRAINT FK_4D1B5C45BD29F359 FOREIGN KEY (audit_id) REFERENCES audit (id)');
        $this->addSql('ALTER TABLE audit_legal_document ADD CONSTRAINT FK_8F9BEC9EBD29F359 FOREIGN KEY (audit_id) REFERENCES audit (id)');
        $this->addSql('ALTER TABLE audit_legal_document ADD CONSTRAINT FK_8F9BEC9EC33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
        $this->addSql('ALTER TABLE audit_observation ADD CONSTRAINT FK_E809EA75BD29F359 FOREIGN KEY (audit_id) REFERENCES audit (id)');
        $this->addSql('ALTER TABLE audit_observation ADD CONSTRAINT FK_E809EA75C33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
        $this->addSql('ALTER TABLE audit_report ADD CONSTRAINT FK_E7F15B5FBD29F359 FOREIGN KEY (audit_id) REFERENCES audit (id)');
        $this->addSql('ALTER TABLE audit_report ADD CONSTRAINT FK_E7F15B5FC69DE5E5 FOREIGN KEY (validated_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE certification_result ADD CONSTRAINT FK_F542D8A4CB47068A FOREIGN KEY (certification_id) REFERENCES certification (id)');
        $this->addSql('ALTER TABLE certification_result ADD CONSTRAINT FK_F542D8A4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744BD29F359 FOREIGN KEY (audit_id) REFERENCES audit (id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_9065174469035FD2 FOREIGN KEY (certification_result_id) REFERENCES certification_result (id)');
        $this->addSql('ALTER TABLE invoice_line ADD CONSTRAINT FK_D3D1D6932989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id)');
        $this->addSql('ALTER TABLE role_permission ADD CONSTRAINT FK_6F7DF886D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE role_permission ADD CONSTRAINT FK_6F7DF886FED90CCA FOREIGN KEY (permission_id) REFERENCES permission (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE audit DROP FOREIGN KEY FK_9218FF79979B1AD6');
        $this->addSql('ALTER TABLE audit_assignment DROP FOREIGN KEY FK_4D1B5C45A76ED395');
        $this->addSql('ALTER TABLE audit_assignment DROP FOREIGN KEY FK_4D1B5C45BD29F359');
        $this->addSql('ALTER TABLE audit_legal_document DROP FOREIGN KEY FK_8F9BEC9EBD29F359');
        $this->addSql('ALTER TABLE audit_legal_document DROP FOREIGN KEY FK_8F9BEC9EC33F7837');
        $this->addSql('ALTER TABLE audit_observation DROP FOREIGN KEY FK_E809EA75BD29F359');
        $this->addSql('ALTER TABLE audit_observation DROP FOREIGN KEY FK_E809EA75C33F7837');
        $this->addSql('ALTER TABLE audit_report DROP FOREIGN KEY FK_E7F15B5FBD29F359');
        $this->addSql('ALTER TABLE audit_report DROP FOREIGN KEY FK_E7F15B5FC69DE5E5');
        $this->addSql('ALTER TABLE certification_result DROP FOREIGN KEY FK_F542D8A4CB47068A');
        $this->addSql('ALTER TABLE certification_result DROP FOREIGN KEY FK_F542D8A4A76ED395');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744979B1AD6');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744BD29F359');
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_9065174469035FD2');
        $this->addSql('ALTER TABLE invoice_line DROP FOREIGN KEY FK_D3D1D6932989F1FD');
        $this->addSql('ALTER TABLE role_permission DROP FOREIGN KEY FK_6F7DF886D60322AC');
        $this->addSql('ALTER TABLE role_permission DROP FOREIGN KEY FK_6F7DF886FED90CCA');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        $this->addSql('DROP TABLE audit');
        $this->addSql('DROP TABLE audit_assignment');
        $this->addSql('DROP TABLE audit_legal_document');
        $this->addSql('DROP TABLE audit_observation');
        $this->addSql('DROP TABLE audit_report');
        $this->addSql('DROP TABLE certification');
        $this->addSql('DROP TABLE certification_result');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE invoice_line');
        $this->addSql('DROP TABLE permission');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_permission');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
