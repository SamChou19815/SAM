<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sam
 * Date: 3/21/15
 * Time: 21:43
 */

require $_SERVER['DOCUMENT_ROOT']."/modules/user/checkValid.php";

$result = checkForceQuit();

$teacher = $result->uid;

$type = $_POST['type'];
$dueday = "null";
$duration = 0.0;
$attachment = "null";
if ($type == "1"){
    $duration = $_POST['duration'];
}
$dueday = $_POST['dueday'];
if ($dueday == ""){
    $dueday = "2038-1-1";
}
if ($_POST['hasAttachment'] == "true"){
    function genRandomString(){
        $length = 5;
        $characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWZYZ";

        $real_string_length = strlen($characters) ;
        $string="id";

        for ($p = 0; $p < $length; $p++)
        {
            $string .= $characters[mt_rand(0, $real_string_length-1)];
        }

        return strtolower($string);
    }
    $rand = genRandomString();

    $target_dir = "/files/attachments/";
    $fileType = pathinfo($_FILES["attachment"]["name"], PATHINFO_EXTENSION);
    $final_filename = $rand."_".session_id()."_".time().".".$fileType;
    $target_file = $_SERVER['DOCUMENT_ROOT'].$target_dir .$final_filename;

    $attachment = $target_dir .$final_filename;

    move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file);

}
$content = $_POST['content'];
$class = $_POST['class'];

$sql = "SELECT * from student WHERE class LIKE '%$class%'";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $sql2 = "INSERT INTO assignment (type, content, attachment, publish, dueday, duration, class, receiver, teacher, viewed) VALUES ($type, '$content', '$attachment', now(), '$dueday', $duration, '$class', '$id',
'$teacher', false)";
    $conn->query($sql2);
}

echo "Success";

?>