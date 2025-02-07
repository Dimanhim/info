<h1>Test page</h1>
<?php
$host = 'mysql.j649859.myjino.ru';
$username = '046632014_info';
$password = '3QrhrhdDqU{5';
$dbName = 'j649859_info';

$catId = 2;

$mysqli = new mysqli($host, $username, $password, $dbName);
$questionsQ = $mysqli->query('SELECT * FROM questions WHERE catalog_id='. $catId);
$result = array();
while ($question = $questionsQ->fetch_assoc()) {
    $userQ = $mysqli->query('SELECT name, gender FROM users WHERE id='. (int) $question['user_id']);
    $user = $userQ->fetch_assoc();
    $result[] = array('question'=>$question, 'user'=>$user);
    $userQ->free();
}
$questionsQ->free();



?>
