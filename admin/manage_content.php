<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $type = $_POST['type'];

    if ($type == 'blog') {
        $stmt = $db->prepare('INSERT INTO blogs (title, content) VALUES (:title, :content)');
    } elseif ($type == 'case_study') {
        $stmt = $db->prepare('INSERT INTO case_studies (title, content) VALUES (:title, :content)');
    } elseif ($type == 'testimonial') {
        $stmt = $db->prepare('INSERT INTO testimonials (name, content) VALUES (:title, :content)');
    }

    $stmt->bindValue(':title', $title, SQLITE3_TEXT);
    $stmt->bindValue(':content', $content, SQLITE3_TEXT);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Content</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="manage_content.php">Manage Content</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Manage Content</h1>
        <form action="manage_content.php" method="post">
            <label for="type">Content Type:</label>
            <select id="type" name="type">
                <option value="blog">Blog</option>
                <option value="case_study">Case Study</option>
                <option value="testimonial">Testimonial</option>
            </select>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            <label for="content">Content:</label>
            <textarea id="content" name="content" required></textarea>
            <button type="submit">Submit</button>
        </form>
    </main>
</body>
</html>
