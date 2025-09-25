<?php
// Database connection settings
$host = 'localhost';
$db   = 'bravin';     
$user = 'root';          
$pass = '182064';          

$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("❌Database connection failed: " . htmlspecialchars($e->getMessage()));
}

// Fetch users ordered by ID (ascending = oldest to newest signups)
$stmt = $pdo->query("SELECT id, name, email FROM users ORDER BY id ASC");
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>📋 Registered Users — Numbered List</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            margin: 40px; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
        }
        .container { 
            max-width: 800px; 
            margin: 0 auto; 
            background: white; 
            padding: 40px; 
            border-radius: 15px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        h1 { 
            color: #2c3e50; 
            text-align: center; 
            margin-bottom: 30px;
            font-weight: 600;
        }
        ol { 
            list-style-type: decimal; 
            padding-left: 25px;
            margin: 0;
        }
        li { 
            margin: 20px 0; 
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 5px solid #007bff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: transform 0.2s ease;
        }
        li:hover {
            transform: translateX(5px);
            background: #e9ecef;
        }
        .user-name {
            font-size: 1.2em;
            font-weight: 600;
            color: #2c3e50;
        }
        .user-email {
            font-size: 0.95em;
            color: #6c757d;
            margin-top: 5px;
        }
        .no-users {
            text-align: center;
            color: #888;
            font-style: italic;
            padding: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📋 Registered Users — Numbered by Sign-Up Order</h1>

        <?php if (empty($users)): ?>
            <div class="no-users">
                <p>No users have signed up yet.</p>
            </div>
        <?php else: ?>
            <ol>
                <?php foreach ($users as $user): ?>
                    <li>
                        <div class="user-name">
                            <?= htmlspecialchars($user['name'] ?? 'Anonymous User') ?>
                        </div>
                        <div class="user-email">
                            <?= htmlspecialchars($user['email']) ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ol>
        <?php endif; ?>
    </div>
</body>
</html>
