<?php
include('db.php');

$sql = "INSERT INTO";
if(isset($_POST['choice'])) {
    $var = $_POST['first'];
    if(isset($_POST['pos'])){
        $sql .= " positive VALUES ('$var')";
    }
    else if(isset($_POST['neg'])){
        $sql .= " negative VALUES('$var')";
    }
    else if(isset($_POST['neutral'])){
        $sql .= " neutral VALUES('$var')";
    }
}

$result=mysqli_query($con, $sql);
if($result){
    echo "Submitted!!!<br>";
    echo "Thanks For Your Help.";
   // header('Location: index.php');
}
?>