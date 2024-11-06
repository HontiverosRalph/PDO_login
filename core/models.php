<?php  

function getProjects($pdo) {
    // SQL query to fetch all project data
    $sql = "SELECT id, project_name, description, barista_id FROM projects";
    
    // Prepare and execute the query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    // Fetch all results as an associative array
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $projects;
}

function insertBarista($pdo, $username, $first_name, $last_name, 
    $date_of_birth, $specialty) {

    $sql = "INSERT INTO baristas (username, first_name, last_name, 
        date_of_birth, specialty) VALUES (?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$username, $first_name, $last_name, 
        $date_of_birth, $specialty]);

    return $executeQuery;
}

function updateBarista($pdo, $first_name, $last_name, 
    $date_of_birth, $specialty, $barista_id) {

    $sql = "UPDATE baristas
                SET first_name = ?,
                    last_name = ?,
                    date_of_birth = ?, 
                    specialty = ?
                WHERE barista_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$first_name, $last_name, 
        $date_of_birth, $specialty, $barista_id]);
    
    return $executeQuery;
}

function deleteBarista($pdo, $barista_id) {
    // First, delete all projects associated with the barista
    $deleteBaristaProj = "DELETE FROM coffee_shop_projects WHERE barista_id = ?";
    $deleteStmt = $pdo->prepare($deleteBaristaProj);
    $executeDeleteQuery = $deleteStmt->execute([$barista_id]);

    // If the projects were deleted successfully, proceed to delete the barista
    if ($executeDeleteQuery) {
        $sql = "DELETE FROM baristas WHERE barista_id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$barista_id]);
    }

    // Return false if deletion of projects failed
    return false;
}

function getAllBaristas($pdo) {
    $sql = "SELECT * FROM baristas";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();

    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

function getBaristaByID($pdo, $barista_id) {
    $sql = "SELECT * FROM baristas WHERE barista_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$barista_id]);

    if ($executeQuery) {
        return $stmt->fetch();
    }
}

function getProjectsByBarista($pdo, $barista_id) {
    $sql = "SELECT 
                coffee_shop_projects.project_id AS project_id,
                coffee_shop_projects.project_name AS project_name,
                coffee_shop_projects.description AS description,
                coffee_shop_projects.date_added AS date_added,
                CONCAT(baristas.first_name, ' ', baristas.last_name) AS project_owner
            FROM coffee_shop_projects
            JOIN baristas ON coffee_shop_projects.barista_id = baristas.barista_id
            WHERE coffee_shop_projects.barista_id = ? 
            GROUP BY coffee_shop_projects.project_name;";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$barista_id]);
    
    return $executeQuery ? $stmt->fetchAll() : [];
}


function insertCoffeeShopProject($pdo, $project_name, $description, $barista_id) {
    $sql = "INSERT INTO coffee_shop_projects (project_name, description, barista_id) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$project_name, $description, $barista_id]);
}


function getProjectByID($pdo, $project_id) {
    $sql = "SELECT 
                coffee_shop_projects.project_id AS project_id,
                coffee_shop_projects.project_name AS project_name,
                coffee_shop_projects.description AS description,
                coffee_shop_projects.date_added AS date_added,
                coffee_shop_projects.barista_id AS barista_id, -- Ensure this is selected
                CONCAT(baristas.first_name, ' ', baristas.last_name) AS project_owner
            FROM coffee_shop_projects
            JOIN baristas ON coffee_shop_projects.barista_id = baristas.barista_id
            WHERE coffee_shop_projects.project_id = ? 
            GROUP BY coffee_shop_projects.project_name";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$project_id]);

    return $executeQuery ? $stmt->fetch() : null;
}


function updateCoffeeShopProject($pdo, $project_name, $description, $project_id) {
    $sql = "UPDATE coffee_shop_projects
            SET project_name = ?,
                description = ?
            WHERE project_id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$project_name, $description, $project_id]);
}


function deleteCoffeeShopProject($pdo, $project_id) {
    $sql = "DELETE FROM coffee_shop_projects WHERE project_id = ?"; // Use the correct table name
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$project_id]);
}


function getAllInfoByBaristaID($pdo, $barista_id) {
    // Prepare the SQL statement
    $sql = "SELECT * FROM baristas WHERE barista_id = :barista_id";
    $stmt = $pdo->prepare($sql);
    
    // Bind the parameter
    $stmt->bindParam(':barista_id', $barista_id, PDO::PARAM_INT);
    
    // Execute the statement
    $stmt->execute();
    
    // Fetch the result
    $baristaInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Return the barista information
    return $baristaInfo;
}


?>
