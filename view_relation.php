<?php
include_once 'model.php';
session_start();
$pokemons = $_SESSION['pokemons'] ?? [];
$types = $_SESSION['types'] ?? [];
$relations = $_SESSION['relations'] ?? [];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Relations</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
  <h2>Pokemon - Type Relations</h2>
  <table class="table table-bordered">
    <thead class="table-dark">
      <tr><th>Pokemon</th><th>Type</th><th>Pro</th><th>Contra</th><th>Action</th></tr>
    </thead>
    <tbody>
      <?php if (!empty($relations)): ?>
        <?php foreach($relations as $i => $rel): 
          $poke = null; $type = null;
          foreach ($pokemons as $p) if ($p->id == $rel->pokemon_id) $poke = $p;
          foreach ($types as $t) if ($t->id == $rel->type_id) $type = $t;
        ?>
        <tr>
          <td><?= $poke ? $poke->name : '-' ?></td>
          <td><?= $type ? $type->name : '-' ?></td>
          <td><?= $type ? $type->pro : '-' ?></td>
          <td><?= $type ? $type->contra : '-' ?></td>
          <td>
            <a href="update_relation.php?id=<?= $i ?>" class="btn btn-warning btn-sm">Update</a>
            <a href="controller.php?delete_rel_id=<?= $i ?>" class="btn btn-danger btn-sm">Delete</a>
          </td>
        </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="5" class="text-center">No relations yet.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
  <h3>Add Relation</h3>
  <form method="POST" action="controller.php">
    <input type="hidden" name="add_relation" value="1">
    <div class="mb-3">
      <label>Pokemon</label>
      <select name="pokemon_id" class="form-select">
        <?php foreach($pokemons as $p): ?>
          <option value="<?= $p->id ?>"><?= $p->name ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3">
      <label>Type</label>
      <select name="type_id" class="form-select">
        <?php foreach($types as $t): ?>
          <option value="<?= $t->id ?>"><?= $t->name ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Save Relation</button>
    <a href="view_pokemon.php" class="btn btn-secondary">Back</a>
  </form>
</body>
</html>
