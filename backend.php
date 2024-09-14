
<?php
// JSON data with CartItems, totalPrice, changePaid, and changeBack
$jsonData = file_get_contents('php://input');

// Decode the JSON into a PHP associative array
$data = json_decode($jsonData, true);

// Check if decoding was successful
if (json_last_error() !== JSON_ERROR_NONE) {
  die("Error decoding JSON data.");
}

// Define the names to count
$namesToCount = [
  'Wraps',
  'Pandekage',
  'Pandekage Bål',
  'Suppe Med Brød',
  'Sodavand',
  'Vand',
  'Wraps - Frivillig',
  'Pandekage - Frivillig',
  'Suppe - Frivillig',
  'Sodavand  - Frivillig',
  'Vand  - Frivillig'
];
// Initialize the count and sum arrays
$countResults = array_fill_keys($namesToCount, 0);
$totalPriceSum = 0;
$changePaidSum = 0;
$changeBackSum = 0;

// Loop through the JSON data to count matching names within CartItems and sum totalPrice, changePaid, changeBack
foreach ($data as $record) {
  // Sum totalPrice, changePaid, and changeBack
  if (isset($record['totalPrice'])) {
    $totalPriceSum += $record['totalPrice'];
  }
  if (isset($record['changePaid'])) {
    $changePaidSum += $record['changePaid'];
  }
  if (isset($record['changeBack'])) {
    $changeBackSum += $record['changeBack'];
  }

  // Count occurrences of items in CartItems
  if (isset($record['CartItems']) && is_array($record['CartItems'])) {
    foreach ($record['CartItems'] as $item) {
      if (in_array($item['name'], $namesToCount)) {
        $countResults[$item['name']]++;
      }
    }
  }
}

// // Display the count results
// echo "Item Count:\n";
// foreach ($countResults as $name => $count) {
//   echo $name . ": " . $count . " occurrences\n";
// }
//
// // Display the sums
// echo "\nTotal Sums:\n";
// echo "Total Price: " . $totalPriceSum . "\n";
// echo "Change Paid: " . $changePaidSum . "\n";
// echo "Change Back: " . $changeBackSum . "\n";

// Database connection (adjust as needed)
$host = 'mysql67.unoeuro.com';
$db = 'mitdomaene_dk_db';
$user = 'mitdomaene_dk';
$pass = 'dDcRwfBeAxtnE42aFghy';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";


try {
  $pdo = new PDO($dsn, $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Loop through the count results to update the database
  foreach ($countResults as $name => $count) {
    if ($count > 0) {
      // Escape the column name using backticks
      $escapedName = "`" . str_replace(" ", " ", $name) . "`";

      // Generate the SQL query dynamically
      $sql = "UPDATE items SET $escapedName = $escapedName + :count ORDER BY $escapedName LIMIT 1";

      // Prepare and execute the query
      $stmt = $pdo->prepare($sql);
      $stmt->execute(['count' => $count]);
    }
  }

  // SQL query to update the `money` table by incrementing the values
  $sql = "
            UPDATE money 
            SET 
                totalEarned = totalEarned + :totalPriceSum,
                totalChangeGiven = totalChangeGiven + :changePaidSum,
                totalChangeBack = totalChangeBack + :changeBackSum
            LIMIT 1
        ";

  // Prepare and execute the SQL query
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    'totalPriceSum' => $totalPriceSum,
    'changePaidSum' => $changePaidSum,
    'changeBackSum' => $changeBackSum
  ]);
} catch (PDOException $e) {
  echo "Database error: " . $e->getMessage();
}
?>

