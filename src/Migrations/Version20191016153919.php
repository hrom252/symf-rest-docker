<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191016153919 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $articleTable = $schema->getTable('article');
        $categoryTable = $schema->getTable('category');
        $articleCategoryTable = $schema->getTable('article_category');
        $articleCategoryTable->addIndex(['article_id'], 'FK_article_id_idx');
        $articleCategoryTable->addIndex(['category_id'], 'FK_category_id_idx');
        $articleCategoryTable->addForeignKeyConstraint(
            $articleTable,
            ['article_id'],
            ['id'],
            ['onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE'],
            'FK_article_id'
        );
        $articleCategoryTable->addForeignKeyConstraint(
            $categoryTable,
            ['category_id'],
            ['id'],
            ['onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE'],
            'FK_category_id'
        );
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
