
<?php
// Database connection (adjust as needed)
$host = 'mysql67.unoeuro.com';
$db = 'mitdomaene_dk_db';
$user = 'mitdomaene_dk';
$pass = 'dDcRwfBeAxtnE42aFghy';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";



try {
  // Connect to the database
  $pdo = new PDO($dsn, $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Fetch updated data from `items` table
  $stmt = $pdo->query("SELECT Wraps, Pandekage, `Pandekage Bål`, `Suppe Med Brød`, Sodavand, Vand FROM items LIMIT 1");
  $items = $stmt->fetch(PDO::FETCH_ASSOC);

  // Fetch updated data from `money` table
  $stmt = $pdo->query("SELECT totalEarned, totalChangeGiven, totalChangeBack FROM money LIMIT 1");
  $money = $stmt->fetch(PDO::FETCH_ASSOC);

  // Combine the data into a single JSON structure
  $response = [
    'items' => $items,
    'money' => $money
  ];

  // Output the JSON response
  echo json_encode($response);
} catch (PDOException $e) {
  // Handle any database errors
  echo json_encode(['error' => $e->getMessage()]);
}
?>
