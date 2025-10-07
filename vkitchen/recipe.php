<?php
session_start();
include 'includes/db.php';

// Checks if a recipe ID is given
if (!isset($_GET['rid']) || empty($_GET['rid'])) {
    echo "No recipe selected.";
    exit;
}

$recipe_id = $_GET['rid'];

// retrieves the recipe details from database
$stmt = $pdo->prepare("
    SELECT recipes.*, users.username 
    FROM recipes 
    JOIN users ON recipes.uid = users.uid 
    WHERE recipes.rid = ?
");
$stmt->execute([$recipe_id]);
$recipe = $stmt->fetch();

if (!$recipe) {
    echo "Recipe not found.";
    exit;
}
?>
 

<head>
    
    <title><?= htmlspecialchars($recipe['name']) ?> - Recipe Details</title>
    
    <link rel="stylesheet" href="/vkitchen/css/recipe_style.css"> 
</head>
<body>
    <header>
        <h1><?= htmlspecialchars($recipe['name']) ?></h1>
        <nav>
            <a href="index.php">Home</a>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="dashboard.php">My Dashboard</a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>
        
    <?php
    //echo $recipe['image'];

    $image_url = '/vkitchen/uploads/' . $recipe['image'];
    $image_path = __DIR__ . '/uploads/' . $recipe['image'];
// && file_exists($image_path)
    if (!empty($recipe['image'])&& file_exists($image_path)): ?>
        <img src="<?= htmlspecialchars($image_url) ?>" alt="Recipe Image" class="recipe-image">
    <?php endif; ?>
        
        <p><strong>Type:</strong> <?= htmlspecialchars($recipe['type']) ?></p>
        <p><strong>Cooking Time:</strong> <?= htmlspecialchars($recipe['Cookingtime']) ?> minutes</p>
        <p><strong>Description:</strong> <?= nl2br(htmlspecialchars($recipe['description'])) ?></p>
        
        <h3>Ingredients</h3>
        <p><?= nl2br(htmlspecialchars($recipe['ingredients'])) ?></p>

        <h3>Instructions</h3>
        <p><?= nl2br(htmlspecialchars($recipe['instructions'])) ?></p>

        <p><strong>Submitted by:</strong> <?= htmlspecialchars($recipe['username']) ?></p>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>