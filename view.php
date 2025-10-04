<?php
include 'db.php';

// Delete entry
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM entries WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: view.php?deleted=1");
    exit();
}

// Fetch all entries
$result = $conn->query("SELECT * FROM entries ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Past Entries</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <h1>🕊️ Past Mood Entries</h1>

    <?php if (isset($_GET['success'])): ?>
      <p class="success">✅ Mood saved successfully!</p>
    <?php elseif (isset($_GET['deleted'])): ?>
      <p class="deleted">🗑️ Entry deleted successfully!</p>
    <?php endif; ?>

    <?php if ($result->num_rows > 0): ?>
      <table>
        <tr>
          <th>Date</th>
          <th>Mood</th>
          <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['mood_date']) ?></td>
          <td><?= htmlspecialchars($row['mood']) ?></td>
          <td>
            <a class="delete-btn" href="view.php?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this entry?')">Delete</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </table>
    <?php else: ?>
      <p>No entries found.</p>
    <?php endif; ?>

    <a href="index.html" class="back-link">➕ Add New Entry</a>
  </div>
</body>
</html>
