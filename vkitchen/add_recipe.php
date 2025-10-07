<?php
session_start();
include 'includes/db.php';


// If the user isnt logged in it will take you to the homepage
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get the info from the form
    $name = $_POST['name'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    $cookingtime = $_POST['cookingtime'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];

    // upload Image
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    // Insert into the database
    $stmt = $pdo->prepare("INSERT INTO recipes (name, description, type, cookingtime, ingredients, instructions, image, uid) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $description, $type, $cookingtime, $ingredients, $instructions, $image, $_SESSION['user_id']]);

    header("Location: dashboard.php");
    exit;
}
?>
<link rel="stylesheet" href="/vkitchen/css/recipeAdd_style.css">

<header>
        <h1>Add New Recipe</h1>
        <nav>
            <a href="/vkitchen/index.php">Home</a>
            <a href="/vkitchen/logout.php">Logout</a>
        </nav>
</header>

<form method="POST" enctype="multipart/form-data">
    <label for="name">Recipe Name:</label>
    <input type="text" name="name" id="name" required>

    <label for="description">Description:</label>
    <textarea name="description" id="description" required></textarea>

    <label for="type">Type:</label>
    <select name="type" id="type" required>
        <option value="French">French</option>
        <option value="Italian">Italian</option>
        <option value="Chinese">Chinese</option>
        <option value="Indian">Indian</option>
        <option value="Mexican">Mexican</option>
        <option value="Others">Others</option>
    </select>

    <label for="cookingtime">Cooking Time (in minutes):</label>
    <input type="number" name="cookingtime" id="cookingtime" required>

    <label for="ingredients">Ingredients:</label>
    <textarea name="ingredients" id="ingredients" required></textarea>

    <label for="instructions">Instructions:</label>
    <textarea name="instructions" id="instructions" required></textarea>

    <label for="image">Recipe Image:</label>
    <input type="file" name="image" id="image">

    <button type="submit">Add Recipe</button>
</form>

<?php include 'includes/footer.php'; ?>