<?php

header("Content-Type: application/json");

// Database configuration
$host = 'localhost';
$username = 'your_username';
$password = 'your_password';
$dbname = 'todo_app';

// Create a new PDO instance
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Check the request method
$method = $_SERVER['REQUEST_METHOD'];

// Handle GET requests
if ($method === 'GET') {
    // Get all todos
    $stmt = $db->query("SELECT * FROM todos");
    $todos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => 'success',
        'data' => $todos
    ]);
    exit;
}

// Handle POST requests
if ($method === 'POST') {
    // Create a new todo
    $todoText = $_POST['text'];
    $stmt = $db->prepare("INSERT INTO todos (text) VALUES (:text)");
    $stmt->bindParam(':text', $todoText);

    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Todo created successfully'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to create todo'
        ]);
    }
    exit;
}

// Handle DELETE requests
if ($method === 'DELETE') {
    // Delete a todo by its ID
    parse_str(file_get_contents("php://input"), $data);
    $todoId = $data['id'];
    $stmt = $db->prepare("DELETE FROM todos WHERE id = :id");
    $stmt->bindParam(':id', $todoId);

    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Todo deleted successfully'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to delete todo'
        ]);
    }
    exit;
}

// Invalid request method
echo json_encode([
    'status' => 'error',
    'message' => 'Invalid request method'
]);
exit;
