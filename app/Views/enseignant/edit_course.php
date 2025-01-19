<?php
require_once "../../../vendor/autoload.php";
use App\Controllers\Admin\CategorieControllers;
use App\Controllers\TagController\Tag;
use App\Controllers\Courses\CourseController;
session_start();

$courseId = $_GET['id'];

$courseController = new CourseController();
$course = $courseController->getCourseById($courseId);



$tagController = new Tag();
$tags = $tagController->getAllTags();

if (isset($_POST["editCourse"])) {
    $courseId = $_GET['id'];
    $data = [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'content' => $_POST['content'],
        'category_id' => $_POST['course_id'],
        'tags' => isset($_POST['tags']) ? $_POST['tags'] : []
    ];

    $courseController = new CourseController();
    if ($courseController->updateCourse($courseId, $data)) {
        $_SESSION['success_message'] = "Cours mis à jour avec succès.";
    } else {
        $_SESSION['error_message'] = "Erreur lors de la mise à jour du cours.";
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
    <title>Modifier le cours</title>
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
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-container">
                    <h2 class="mb-4">Modifier le cours</h2>
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
                            <input type="text" class="form-control" id="title" name="title"
                                value='<?php echo htmlspecialchars($course[0]['title']); ?>' required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">URL de vidéo:</label>
                            <input type="text" class="form-control" id="content" name="content" value='<?php
                            $courseContent = isset($course[0]['content']) ? $course[0]['content'] : '';
                            echo htmlspecialchars($courseContent); ?>' required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <input type="text" class="form-control" id="description" name="description" value='<?php
                            $courseContent = isset($course[0]['content']) ? $course[0]['content'] : '';
                            echo htmlspecialchars($course[0]['description']); ?>' required>
                        </div>
                        <div class="mb-3">
                            <label for="course_id" class="form-label">Catégorie:</label>
                            <select class="form-select" id="course_id" name="course_id" required>
                                <option value="">Sélectionner une catégorie</option>
                                <?php 
                                $categoryController = new CategorieControllers();
                                $categories = $categoryController->allCategories();
                                foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['id']; ?>" <?php echo $category['id'] == $course[0]['category_id'] ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($category['category']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags:</label>
                            <select class="form-select" id="tags" name="tags[]" multiple required>
                                <?php foreach ($tags as $tag): ?>
                                    <option value="<?php echo $tag['id']; ?>" <?php echo in_array($tag['id'], $course[0]['tags']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($tag['tag']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        

                        <button type="submit" name="editCourse" class="btn btn-primary w-100">Mettre à jour le
                            cours</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>