<?php
include_once 'model.php';
session_start();
$pokemons = $_SESSION['pokemons'] ?? [];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Pokemon List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
  <h2>Pokemon List</h2>
  <a href="view_add.php" class="btn btn-success mb-3">Add Pokemon</a>
  <a href="view_relation.php" class="btn btn-primary mb-3">View Relations</a>
  <table class="table table-bordered">
    <thead class="table-dark">
      <tr><th>No</th><th>Name</th><th>Weight</th><th>Species</th><th>Action</th></tr>
    </thead>
    <tbody>
      <?php if (!empty($pokemons)): ?>
        <?php foreach($pokemons as $p): ?>
        <tr>
          <td><?= $p->id ?></td>
          <td><?= $p->name ?></td>
          <td><?= $p->weight ?></td>
          <td><?= $p->species ?></td>
          <td>
            <a href="update.php?id=<?= $p->id ?>" class="btn btn-warning btn-sm">Update</a>
            <a href="controller.php?delete_id=<?= $p->id ?>" class="btn btn-danger btn-sm">Delete</a>
          </td>
        </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="5" class="text-center">No Pokemon yet.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</body>
</html>
