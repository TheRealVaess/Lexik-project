<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180703105648 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__products AS SELECT id FROM products');
        $this->addSql('DROP TABLE products');
        $this->addSql('CREATE TABLE products (id INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO products (id) SELECT id FROM __temp__products');
        $this->addSql('DROP TABLE __temp__products');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__products AS SELECT id FROM products');
        $this->addSql('DROP TABLE products');
        $this->addSql('CREATE TABLE products (id INTEGER NOT NULL, name VARCHAR(100) NOT NULL COLLATE BINARY, description CLOB NOT NULL COLLATE BINARY, price INTEGER NOT NULL)');
        $this->addSql('INSERT INTO products (id) SELECT id FROM __temp__products');
        $this->addSql('DROP TABLE __temp__products');
    }
}
