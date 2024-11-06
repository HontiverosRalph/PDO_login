<?php 

session_start();
require_once 'dbConfig.php';
require_once 'models.php';


// Insert Barista
if (isset($_POST['insertBaristaBtn'])) {
    $query = insertBarista($pdo, $_POST['username'], $_POST['firstName'], 
        $_POST['lastName'], $_POST['dateOfBirth'], $_POST['specialty']);

    if ($query) {
        header("Location: ../index.php");
    } else {
        echo "Insertion failed";
    }
}

// Edit Barista
if (isset($_POST['editBaristaBtn'])) {
    $query = updateBarista($pdo, $_POST['firstName'], $_POST['lastName'], 
        $_POST['dateOfBirth'], $_POST['specialty'], $_GET['barista_id']);

    if ($query) {
        header("Location: ../index.php");
    } else {
        echo "Edit failed";
    }
}

// Delete Barista
if (isset($_POST['deleteBaristaBtn'])) {
    $query = deleteBarista($pdo, $_GET['barista_id']);

    if ($query) {
        header("Location: ../index.php");
    } else {
        echo "Deletion failed";
    }
}

// Insert Coffee Shop Project
if (isset($_POST['insertNewProjectBtn'])) {
    $query = insertCoffeeShopProject($pdo, $_POST['projectName'], $_POST['description'], $_GET['barista_id']);

    if ($query) {
        header("Location: ../viewprojects.php?barista_id=" . $_GET['barista_id']);
    } else {
        echo "Insertion failed";
    }
}

// Edit Coffee Shop Project
if (isset($_POST['editProjectBtn'])) {
    $query = updateCoffeeShopProject($pdo, $_POST['projectName'], $_POST['description'], $_GET['project_id']);

    if ($query) {
        header("Location: ../viewprojects.php?barista_id=" . $_GET['barista_id']);
    } else {
        echo "Update failed";
    }
}

// Delete Coffee Shop Project
if (isset($_POST['deleteProjectBtn'])) {
    $query = deleteCoffeeShopProject($pdo, $_GET['project_id']);

    if ($query) {
        header("Location: ../viewprojects.php?barista_id=" . $_GET['barista_id']);
    } else {
        echo "Deletion failed";
    }
}

?>
