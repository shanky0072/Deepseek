<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>
    <main>
        <h1>Testimonials</h1>
        <?php
        $result = $db->query('SELECT * FROM testimonials ORDER BY created_at DESC');
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            echo '<article>';
            echo '<h2>' . htmlspecialchars($row['name']) . '</h2>';
            echo '<p>' . nl2br(htmlspecialchars($row['content'])) . '</p>';
            echo '<p><em>' . $row['created_at'] . '</em></p>';
            echo '</article>';
        }
        ?>
    </main>
<?php include 'includes/footer.php'; ?>
