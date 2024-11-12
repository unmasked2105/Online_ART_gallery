<?php
if (isset($_GET['query'])) {
    $query = $_GET['query'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '1234', 'online_art_gallery');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to search for matching artworks
    $sql = "SELECT id, name, artist, price, image FROM paintings WHERE name LIKE ? OR artist LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . $query . "%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    // Generate HTML for each search result
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="art-card">';
            echo '<img src="' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '">';
            echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
            echo '<p>By ' . htmlspecialchars($row['artist']) . '</p>';
            echo '<p>$' . htmlspecialchars($row['price']) . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p>No results found.</p>';
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
