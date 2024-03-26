<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240326205717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE picture_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE profile_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE social_media_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_social_media_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE picture (id INT NOT NULL, profile_id INT NOT NULL, link VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, posted_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_16DB4F89CCFA12B8 ON picture (profile_id)');
        $this->addSql('CREATE TABLE profile (id INT NOT NULL, associated_user_id INT NOT NULL, profile_picture_id INT DEFAULT NULL, private BOOLEAN NOT NULL, certified BOOLEAN NOT NULL, description TEXT NOT NULL, accepted_age_gap INT NOT NULL, accepted_distance INT NOT NULL, targeted_gender VARCHAR(255) NOT NULL, favorite_musician VARCHAR(255) NOT NULL, favorite_music VARCHAR(255) NOT NULL, favorite_music_style VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8157AA0FBC272CD1 ON profile (associated_user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8157AA0F292E8AE2 ON profile (profile_picture_id)');
        $this->addSql('CREATE TABLE social_media (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, birthdate DATE NOT NULL, gender VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_social_media (id INT NOT NULL, associated_user_id INT NOT NULL, social_media_id INT NOT NULL, token_account VARCHAR(255) NOT NULL, private BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A070699CBC272CD1 ON user_social_media (associated_user_id)');
        $this->addSql('CREATE INDEX IDX_A070699C64AE4959 ON user_social_media (social_media_id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0FBC272CD1 FOREIGN KEY (associated_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F292E8AE2 FOREIGN KEY (profile_picture_id) REFERENCES picture (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_social_media ADD CONSTRAINT FK_A070699CBC272CD1 FOREIGN KEY (associated_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_social_media ADD CONSTRAINT FK_A070699C64AE4959 FOREIGN KEY (social_media_id) REFERENCES social_media (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE picture_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE profile_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE social_media_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE user_social_media_id_seq CASCADE');
        $this->addSql('ALTER TABLE picture DROP CONSTRAINT FK_16DB4F89CCFA12B8');
        $this->addSql('ALTER TABLE profile DROP CONSTRAINT FK_8157AA0FBC272CD1');
        $this->addSql('ALTER TABLE profile DROP CONSTRAINT FK_8157AA0F292E8AE2');
        $this->addSql('ALTER TABLE user_social_media DROP CONSTRAINT FK_A070699CBC272CD1');
        $this->addSql('ALTER TABLE user_social_media DROP CONSTRAINT FK_A070699C64AE4959');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE social_media');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_social_media');
    }
}
