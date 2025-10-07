<?php
session_start();
include 'includes/db.php';



// If the user isnt logged in it will take you to the homepage
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// fetching recipes submitted by the user
$stmt = $pdo->prepare("SELECT * FROM recipes WHERE uid = ?");
$stmt->execute([$user_id]);
$recipes = $stmt->fetchAll();

?>
<link rel="stylesheet" href="/vkitchen/css/dash_style.css">
<header>
        <h1>Your Recipes</h1>
        <nav>
            <a href="/vkitchen/index.php">Home</a>
            <a href="/vkitchen/logout.php">Logout</a>
        </nav>
</header>

<?php if ($recipes): ?>
    <ul>
    <?php foreach ($recipes as $recipe): ?>
        <li>
            <h3><a href="recipe.php?rid=<?= $recipe['rid'] ?>"><?= htmlspecialchars($recipe['name']) ?></a></h3>
            <p><?= htmlspecialchars($recipe['type']) ?> - <?= htmlspecialchars($recipe['description']) ?></p>
            <a href="edit_recipe.php?rid=<?= $recipe['rid'] ?>">Edit</a> | 
            <a href="delete_recipe.php?rid=<?= $recipe['rid'] ?>" onclick="return confirm('Are you sure you want to delete this recipe?')">Delete</a>
        </li>
    <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>You haven't submitted any recipes yet.</p>
<?php endif; ?>

<a href="add_recipe.php">Add New Recipe</a>

<?php include 'includes/footer.php'; ?>