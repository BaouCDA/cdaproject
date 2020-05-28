<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200521152029 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post_like MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE post_like DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE post_like DROP id, CHANGE post_id post_id INT NOT NULL, CHANGE member_id member_id INT NOT NULL');
        $this->addSql('ALTER TABLE post_like ADD PRIMARY KEY (post_id, member_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post_like ADD id INT AUTO_INCREMENT NOT NULL, CHANGE post_id post_id INT DEFAULT NULL, CHANGE member_id member_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
