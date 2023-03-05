<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230305195418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE pack_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE round_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE theme_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE pack (id INT NOT NULL, name VARCHAR(255) NOT NULL, authors JSON DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, provider VARCHAR(255) DEFAULT NULL, language VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, tags JSON DEFAULT NULL, is_adult BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE question (id INT NOT NULL, theme_id INT NOT NULL, cost INT NOT NULL, type VARCHAR(255) NOT NULL, answers JSON NOT NULL, incorrect_answers JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B6F7494E59027487 ON question (theme_id)');
        $this->addSql('CREATE TABLE round (id INT NOT NULL, pack_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, is_final BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C5EEEA341919B217 ON round (pack_id)');
        $this->addSql('CREATE TABLE theme (id INT NOT NULL, round_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9775E708A6005CA0 ON theme (round_id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E59027487 FOREIGN KEY (theme_id) REFERENCES theme (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE round ADD CONSTRAINT FK_C5EEEA341919B217 FOREIGN KEY (pack_id) REFERENCES pack (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE theme ADD CONSTRAINT FK_9775E708A6005CA0 FOREIGN KEY (round_id) REFERENCES round (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE pack_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE round_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE theme_id_seq CASCADE');
        $this->addSql('ALTER TABLE question DROP CONSTRAINT FK_B6F7494E59027487');
        $this->addSql('ALTER TABLE round DROP CONSTRAINT FK_C5EEEA341919B217');
        $this->addSql('ALTER TABLE theme DROP CONSTRAINT FK_9775E708A6005CA0');
        $this->addSql('DROP TABLE pack');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE round');
        $this->addSql('DROP TABLE theme');
    }
}
