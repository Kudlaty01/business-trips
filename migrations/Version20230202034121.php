<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230202034121 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create main BusinessTrip Entity';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE business_trip (id INT AUTO_INCREMENT NOT NULL, country VARCHAR(2) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, allowance DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE business_trip');
    }
}
