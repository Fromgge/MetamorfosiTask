<?php
    $servername = "localhost:3307";
    $username = "root";
    $password = "root";
    $dbname = "categories";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $sql = "SELECT blogs.id, blogs.title, blogs.content, blogs.created_at, blogs.updated_at, blogs.author_id, categories.title AS category_title, users.firstname, users.lastname
            FROM blogs
            LEFT JOIN blog_category ON blogs.id = blog_category.blog_id
            LEFT JOIN categories ON categories.id = blog_category.category_id
            LEFT JOIN users ON users.id = blogs.author_id
            ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $blogs = [];

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {
        $blogId = $row['id'];

        if (!isset($blogs[$blogId])) {
            $blogs[$blogId] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'content' => $row['content'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at'],
                'author' => array(
                    'firstname' => $row['firstname'],
                    'lastname' => $row['lastname']
                ),
                'categories' => array()
            );
        }

        if (!empty($row['category_title'])) {
            $blogs[$blogId]['categories'][] = $row['category_title'];
        }
    }

    echo json_encode(array_values($blogs));
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    $conn = null;
}
?>
