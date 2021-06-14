<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210614100912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE program ADD catergory_id INT NOT NULL');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED77849F6C9F4 FOREIGN KEY (catergory_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_92ED77849F6C9F4 ON program (catergory_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED77849F6C9F4');
        $this->addSql('DROP INDEX IDX_92ED77849F6C9F4 ON program');
        $this->addSql('ALTER TABLE program DROP catergory_id');
    }
}
