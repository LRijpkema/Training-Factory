<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230613132100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesson ADD trainer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F3FB08EDF6 FOREIGN KEY (trainer_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F87474F3FB08EDF6 ON lesson (trainer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F3FB08EDF6');
        $this->addSql('DROP INDEX IDX_F87474F3FB08EDF6 ON lesson');
        $this->addSql('ALTER TABLE lesson DROP trainer_id');
    }
}
