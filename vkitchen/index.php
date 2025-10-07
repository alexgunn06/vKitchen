<?php include 'includes/db.php'; ?>
<link rel="stylesheet" href="/vkitchen/css/index_style.css">

<header>
        <h1>Virtual Kitchen</h1>
        <nav>
            <a href="/vkitchen/index.php">Home</a>
            <a href="/vkitchen/logout.php">Logout</a>
        </nav>
</header>

<a href="/vkitchen/dashboard.php">Dashboard</a>
<a href="/vkitchen/add_recipe.php">Add Recipe</a>

<h2>All Recipes</h2>

<form method="GET" action="">
    <input type="text" name="search" placeholder="Search by name or type">
    <button type="submit">Search</button>
</form>

<?php
$search = $_GET['search'] ?? '';
$query = "SELECT * FROM recipes 
          INNER JOIN users ON recipes.uid = users.uid 
          WHERE name LIKE :search OR type LIKE :search";

$stmt = $pdo->prepare($query);
$stmt->execute(['search' => "%$search%"]);
$recipes = $stmt->fetchAll();

foreach ($recipes as $recipe): ?>
    <div>
        <h3><a href="recipe.php?rid=<?= $recipe['rid'] ?>"><?= htmlspecialchars($recipe['name']) ?></a></h3>
        <p><?= htmlspecialchars($recipe['type']) ?> - <?= htmlspecialchars($recipe['description']) ?></p>
    </div>
<?php endforeach; ?>

<?php include 'includes/footer.php'; ?>