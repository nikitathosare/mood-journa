<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mood_date = $_POST['mood_date'];
    $mood = $_POST['mood'];

    if (!empty($mood_date) && !empty($mood)) {
        $stmt = $conn->prepare("INSERT INTO entries (mood_date, mood) VALUES (?, ?)");
        $stmt->bind_param("ss", $mood_date, $mood);

        if ($stmt->execute()) {
            header("Location: view.php?success=1");
            exit();
        } else {
            echo "Error: Could not save entry.";
        }

        $stmt->close();
    } else {
        echo "Please fill in all fields.";
    }
}

$conn->close();
?>
