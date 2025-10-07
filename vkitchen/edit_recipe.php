<?php
session_start();
include 'includes/db.php';

// If the user isnt logged in it will take you to the homepage
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];


if (!isset($_GET['rid']) || !is_numeric($_GET['rid'])) {
    echo "Invalid recipe ID.";
    exit;
}

$rid = (int)$_GET['rid'];

// Fetch the recipe and check that it belongs to the user
$stmt = $pdo->prepare("SELECT * FROM recipes WHERE rid = ? AND uid = ?");
$stmt->execute([$rid, $user_id]);
$recipe = $stmt->fetch();

if (!$recipe) {
    echo "Recipe not found or you don't have permission to edit it.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $type = trim($_POST['type']);
    $description = trim($_POST['description']);

    if ($name && $type && $description) {
        $update_stmt = $pdo->prepare("UPDATE recipes SET name = ?, type = ?, description = ? WHERE rid = ? AND uid = ?");
        $update_stmt->execute([$name, $type, $description, $rid, $user_id]);

        header("Location: dashboard.php");
        exit;
    } else {
        $error = "All fields are required.";
    }
}
?>

<link rel="stylesheet" href="/vkitchen/css/editRecipe_style.css">

<header>
    <h1>Edit Recipe</h1>
    <nav>
        <a href="/vkitchen/index.php">Home</a>
        <a href="/vkitchen/your_recipes.php">Your Recipes</a>
        <a href="/vkitchen/logout.php">Logout</a>
    </nav>
</header>

<?php if (isset($error)): ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="">
    <label for="name">Recipe Name:</label><br>
    <input type="text" name="name" id="name" value="<?= htmlspecialchars($recipe['name']) ?>" required><br>

    <label for="type">Type:</label><br>
    <select name="type" id="type" required>
        <option value="French" <?= $recipe['type'] === 'French' ? 'selected' : '' ?>>French</option>
        <option value="Italian" <?= $recipe['type'] === 'Italian' ? 'selected' : '' ?>>Italian</option>
        <option value="Chinese" <?= $recipe['type'] === 'Chinese' ? 'selected' : '' ?>>Chinese</option>
        <option value="Indian" <?= $recipe['type'] === 'Indian' ? 'selected' : '' ?>>Indian</option>
        <option value="Mexican" <?= $recipe['type'] === 'Mexican' ? 'selected' : '' ?>>Mexican</option>
        <option value="Others" <?= $recipe['type'] === 'Others' ? 'selected' : '' ?>>Others</option>
    </select><br>

    <label for="description">Description:</label><br>
    <textarea name="description" id="description" required><?= htmlspecialchars($recipe['description']) ?></textarea><br>

    <button type="submit">Update Recipe</button>
</form>

<?php include 'includes/footer.php'; ?>