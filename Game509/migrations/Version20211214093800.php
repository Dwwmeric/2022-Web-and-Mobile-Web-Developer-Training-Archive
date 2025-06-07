<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211214093800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE setting (setting_key VARCHAR(50) NOT NULL, value TEXT NOT NULL, PRIMARY KEY(setting_key)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE square_type (`key` VARCHAR(250) NOT NULL, name VARCHAR(10) NOT NULL, description TEXT NOT NULL, header_color_text VARCHAR(6) NOT NULL, header_color_bg VARCHAR(6) NOT NULL, header_display TINYINT(1) NOT NULL, body_color_text VARCHAR(6) NOT NULL, body_color_bg VARCHAR(6) NOT NULL, body_img VARCHAR(255) NOT NULL, body_text VARCHAR(50) NOT NULL, body_mode VARCHAR(255) NOT NULL, footer_color_text VARCHAR(6) NOT NULL, footer_color_bg VARCHAR(6) NOT NULL, footer_value VARCHAR(10) NOT NULL, footer_display TINYINT(1) NOT NULL, PRIMARY KEY(`key`)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE squares (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(10) NOT NULL, order_square INT NOT NULL, type_square VARCHAR(255) NOT NULL, description TEXT NOT NULL, header_color_text VARCHAR(7) DEFAULT \'#003c54\' NOT NULL, header_color_bg VARCHAR(7) DEFAULT \'#ffffff\' NOT NULL, header_display TINYINT(1) NOT NULL, body_color_text VARCHAR(7) DEFAULT \'#ffffff\' NOT NULL, body_color_bg VARCHAR(7) DEFAULT \'#ddbe6f\' NOT NULL, body_img VARCHAR(250) DEFAULT NULL, body_text VARCHAR(50) NOT NULL, footer_color_text VARCHAR(7) DEFAULT \'#003c54\' NOT NULL, footer_color_bg VARCHAR(7) DEFAULT \'#ddbe6f\' NOT NULL, footer_value VARCHAR(10) NOT NULL, footer_display TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE setting');
        $this->addSql('DROP TABLE square_type');
        $this->addSql('DROP TABLE squares');
        $this->addSql('DROP TABLE user');
    }
}
