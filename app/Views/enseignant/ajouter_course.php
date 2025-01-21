<?php
require_once "../../../vendor/autoload.php";
use App\Controllers\Admin\CategorieControllers;
use App\Controllers\Admin\TagControllers;
use App\Controllers\Courses\CourseController;
session_start();

$tagController = new TagControllers();
$tags = $tagController->getAllTags();

if (isset($_POST["addCourse"])) {
    $titre = $_POST['title'];
    $description = $_POST['description'];
    $content = $_POST['content'];
    $selectedTags = $_POST['tags'];
    $enseignant_id = $_SESSION['id'];
    $categoryId = $_POST['course_id'];

    $courseController = new CourseController();
    try {
        $courseId = $courseController->createCourse([
            'title' => $titre,
            'description' => $description,
            'content' => $content,
            'enseignant_id' => $enseignant_id,
            'category_id' => $categoryId,
            'tags' => $selectedTags
        ]);

        if ($courseId) {
            $_SESSION['success_message'] = "Cours créé avec succès.";
        } else {
            $_SESSION['error_message'] = "Erreur lors de la création du cours.";
        }
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Erreur lors de la création du cours : " . $e->getMessage();
    }
    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un cours</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 60px;
            background-color: #f8f9fa;
        }
        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .tag-checkbox {
            display: block;
        }
        .tags-container, button {
            display: block !important;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-container">
                <h2 class="mb-4">Ajouter un cours</h2>
                <?php 
                if (isset($_SESSION['error_message'])) {
                    echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
                    unset($_SESSION['error_message']);
                }
                if (isset($_SESSION['success_message'])) {
                    echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
                    unset($_SESSION['success_message']);
                }
                ?>
                <form method="post" class="course-form">
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre du cours:</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">URL de vidéo:</label>
                        <input type="text" class="form-control" id="content" name="content" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        
                        <label for="tags" class="form-label">Tags:</label>
                        <select class="form-select" id="tags" name="tags[]" multiple required>
                            <option value="">Sélectionner une tag</option>
                            <?php 
                            foreach ($tags as $tag): ?>
                                <option value="<?php echo $tag->getId(); ?>">
                                    <?php echo $tag->getName(); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="course_id" class="form-label">Catégorie:</label>
                        <select class="form-select" id="course_id" name="course_id" required>
                            <option value="">Sélectionner une catégorie</option>
                            <?php 
                            $categoryController = new CategorieControllers();
                            $categories = $categoryController->allCategories();

                            foreach ($categories as $category): ?>
                                <option value="<?php echo $category->getId(); ?>">
                                    <?php echo $category->getName(); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" name="addCourse" class="btn btn-primary w-100">Ajouter le cours</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
