<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250408101606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE comment ADD recipe_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment ADD CONSTRAINT FK_9474526C59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_9474526C59D8A214 ON comment (recipe_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_9474526CA76ED395 ON comment (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ingredient ADD recipe_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF787059D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_6BAF787059D8A214 ON ingredient (recipe_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `like` ADD recipe_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B359D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_AC6340B359D8A214 ON `like` (recipe_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe ADD user_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_DA88B137A76ED395 ON recipe (user_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE comment DROP FOREIGN KEY FK_9474526C59D8A214
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_9474526C59D8A214 ON comment
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_9474526CA76ED395 ON comment
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment DROP recipe_id, DROP user_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF787059D8A214
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_6BAF787059D8A214 ON ingredient
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ingredient DROP recipe_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B359D8A214
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_AC6340B359D8A214 ON `like`
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `like` DROP recipe_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_DA88B137A76ED395 ON recipe
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipe DROP user_id
        SQL);
    }
}
