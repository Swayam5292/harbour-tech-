<?php
header('Content-Type: application/json');

// Database setup
$dbPath = '/tmp/harbour_projects.sqlite';
$db = new PDO('sqlite:' . $dbPath);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Ensure table exists
$db->exec("CREATE TABLE IF NOT EXISTS projects (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    description TEXT,
    client_name TEXT,
    status TEXT DEFAULT 'Pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];

try {
    if (strpos($path, '/api/projects/delete') !== false && $method === 'POST') {
        $id = $_POST['id'] ?? null;
        if ($id) {
            $stmt = $db->prepare("DELETE FROM projects WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(['success' => true]);
        }
    } elseif ($method === 'POST') {
        // Create Project
        $title = $_POST['title'] ?? 'Untitled Project';
        $client = $_POST['client_name'] ?? 'Generic Client';
        $desc = $_POST['description'] ?? '';
        
        $stmt = $db->prepare("INSERT INTO projects (title, client_name, description) VALUES (?, ?, ?)");
        $stmt->execute([$title, $client, $desc]);
        
        echo json_encode(['success' => true, 'id' => $db->lastInsertId()]);
    } else {
        // List Projects
        $stmt = $db->query("SELECT * FROM projects ORDER BY created_at DESC");
        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($projects);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
