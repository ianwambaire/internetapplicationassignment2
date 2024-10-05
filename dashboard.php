<?php
include_once 'db_connection.php';
include_once 'users.php';
$stmt = $user->readAll();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    echo "<p>{$firstname} {$lastname} - {$email}</p>";
}
?>
