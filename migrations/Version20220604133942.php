<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220604133942 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE followers (account_source INT NOT NULL, account_target INT NOT NULL, INDEX IDX_8408FDA778BEB100 (account_source), INDEX IDX_8408FDA7615BE18F (account_target), PRIMARY KEY(account_source, account_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE followers ADD CONSTRAINT FK_8408FDA778BEB100 FOREIGN KEY (account_source) REFERENCES account (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE followers ADD CONSTRAINT FK_8408FDA7615BE18F FOREIGN KEY (account_target) REFERENCES account (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE followers');
    }
}
