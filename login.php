<?php
header("Access-Control-Allow-Origin: *"); // Allow all origins
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Allow specific methods
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Allow specific headers

$_POST = json_decode(file_get_contents("php://input"), true);
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the posted data
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Simple validation (e.g., check if fields are not empty)
    if (!empty($username) && !empty($password)) {
        // Process the data (e.g., authenticate the user)
        $username = htmlspecialchars($username);
        // TODO apply hashing to passwords
        $password = $password;
        
        // query sql for username and password
        $user = queryUser($username, $password);
        if (empty($user)) {
            // TODO return 403 status code
            // echo 'No matching user';
            exit;
        }

        // if we get a user, redirect them
        session_start();
        $_SESSION['authenticated'] = true;
        $_SESSION['authenticated_user'] = $user;
        header("Location: welcome.php");
        exit();

    } else {
        echo "Please provide both username and password.";
    }
} else {
    echo "Invalid request method.";
}

function queryUser($uname, $pass) {
    $conn = "mysql:host=localhost;dbname=forcolin";
    $username = "Colin";
    $password = "abcABC123!@#";

    try {
        $pdo = new PDO($conn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :un and password = :pw"); // Replace 'example_table' and 'name' with your table and column names
    
        // Bind the parameter to the query
        $stmt->bindParam(':un', $uname, PDO::PARAM_STR);
        $stmt->bindParam(':pw', $pass, PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        return $results;
    } catch (PDOException $e) {
        echo "Conn fail: " . $e->getMessage();
    }
}