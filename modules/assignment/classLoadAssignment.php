<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sam
 * Date: 3/22/15
 * Time: 01:12
 */

require $_SERVER['DOCUMENT_ROOT']."/modules/user/checkValid.php";
require $_SERVER['DOCUMENT_ROOT']."/modules/assignment/UnitAssignment.php";

$result = checkForceQuit();

$userID = $result->uid;
$class = $_GET['class'];

$sql = "SELECT * from assignment WHERE class = '$class' AND dueday > (NOW() - 10) ORDER BY dueday DESC";
$result = $conn->query($sql);

$arr = array();
$counter = 0;

while($row = $result->fetch_assoc()) {

    $id = $row['id'];
    $type = $row['type'];
    $content = $row['content'];
    $attachment = $row['attachment'];
    $publish = $row['publish'];
    $dueday = $row['dueday'];
    $duration = $row['duration'];
    $receiver = $row['receiver'];
    $teacher = $row['teacher'];
    $unitAssignment = new UnitAssignment($id, $type, $content, $attachment, $publish, $dueday, $duration, $class, $receiver, $teacher);
    $arr[$counter] = $unitAssignment;
    $counter++;
}

echo json_encode($arr);

?>