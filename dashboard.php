<?php

include_once 'db_connection.php';
include_once 'users.php';
$database = new Database();
$db = $database->getConnection();


$users = new User($db);


$stmt = $users->readAll();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    echo "<p>{$firstname} {$lastname} - {$email}</p>";
}
?>
