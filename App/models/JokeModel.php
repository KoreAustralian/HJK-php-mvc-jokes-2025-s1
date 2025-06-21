<?php

namespace App\Models;

use PDO;

class JokeModel
{
    public static function all(PDO $db)
    {
        $stmt = $db->query('SELECT jokes.*, categories.name AS category_name, users.nickname AS author_name
                            FROM jokes
                            LEFT JOIN categories ON jokes.category_id = categories.id
                            LEFT JOIN users ON jokes.author_id = users.id
                            ORDER BY created_at DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function countAll(PDO $db): int
    {
        return (int) $db->query('SELECT COUNT(*) FROM jokes')->fetchColumn();
    }

    public static function find(PDO $db, $id)
    {
        $stmt = $db->prepare('SELECT jokes.*, categories.name AS category_name, users.nickname AS author_name
                              FROM jokes
                              LEFT JOIN categories ON jokes.category_id = categories.id
                              LEFT JOIN users ON jokes.author_id = users.id
                              WHERE jokes.id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function randomOne(PDO $pdo): ?array
    {
        $stmt = $pdo->query("
        SELECT jokes.*, categories.name AS category_name, users.nickname AS author_name
        FROM jokes
        LEFT JOIN categories ON jokes.category_id = categories.id
        LEFT JOIN users ON jokes.author_id = users.id
        ORDER BY RAND()
        LIMIT 1
    ");

        $joke = $stmt->fetch(PDO::FETCH_ASSOC);
        return $joke ?: null;
    }


    public static function create(PDO $db, array $data)
    {
        $stmt = $db->prepare('INSERT INTO jokes (title, body, category_id, tags, author_id)
                          VALUES (:title, :body, :category_id, :tags, :author_id)');

        $stmt->execute([
            'title'       => $data['title'],
            'body'        => $data['body'],
            'category_id' => $data['category_id'],
            'tags'        => $data['tags'],
            'author_id'   => $data['author_id'],
        ]);
    }

    public static function update(PDO $db, int $id, array $data): bool
    {
        $sql = "
        UPDATE jokes
        SET body = :body,
            category_id = :category_id,
            tags = :tags,
            updated_at = NOW()
        WHERE id = :id
    ";

        $stmt = $db->prepare($sql);

        return $stmt->execute([
            'body' => $data['content'],
            'category_id' => $data['category_id'],
            'tags' => $data['tags'],
            'id' => $id
        ]);
    }

    public static function delete(PDO $db, int $id): void
    {
        $stmt = $db->prepare('DELETE FROM jokes WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    public static function searchByBody(PDO $db, string $query): array
    {
        $stmt = $db->prepare('
        SELECT jokes.id, jokes.title, jokes.tags, users.nickname AS author_name, categories.name AS category_name
        FROM jokes
        LEFT JOIN users ON jokes.author_id = users.id
        LEFT JOIN categories ON jokes.category_id = categories.id
        WHERE jokes.body LIKE :query
        ORDER BY jokes.created_at DESC
    ');

        $stmt->execute([
            'query' => '%' . $query . '%'
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findWithCategoryAndAuthor(PDO $db, int $id): array|false
    {
        $sql = "
        SELECT 
            j.id,
            j.title,
            j.body,
            j.tags,
            j.author_id,
            c.name AS category,
            u.nickname AS author
        FROM jokes j
        LEFT JOIN categories c ON j.category_id = c.id
        LEFT JOIN users u ON j.author_id = u.id
        WHERE j.id = :id
        LIMIT 1
    ";

        $stmt = $db->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findForEdit(PDO $db, int $id): array|false
    {
        $sql = "
        SELECT 
            j.id,
            j.body AS content, 
            j.tags, 
            j.category_id AS category
        FROM jokes j
        WHERE j.id = :id
        LIMIT 1
    ";

        $stmt = $db->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
