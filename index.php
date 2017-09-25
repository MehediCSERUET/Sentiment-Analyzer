<?php require_once('db.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seniment Analysis</title>
</head>
<body>
   
   <?php
        $countPos = 0;
        $countNeg = 0;
        $countNeu = 0;
        $temp = 0;
        $i=0;
        $totalword=0;
    
        if(isset($_POST['submit'])){
            $sentence = $_POST['sentence'];
            $words = str_word_count($sentence, 1);
            
            //var_dump($words);
            $totalword = count($words);
            
            foreach($words as $w){
                $i++;
                $word = strtolower($w);
                
                $sqlPos = "SELECT * FROM positive WHERE word LIKE '".$word."%'";
                $sqlNeg = "SELECT * FROM negative WHERE word LIKE '".$word."%'";
                $sqlNeu = "SELECT * FROM neutral WHERE word LIKE '".$word."%'";
                
                $resPos=mysqli_query($con, $sqlPos);
                $resNeg=mysqli_query($con, $sqlNeg);
                $resNeu=mysqli_query($con, $sqlNeu);
                
                $temp=$countPos+$countNeg+$countNeu;
                
                if ($result=mysqli_query($con,$sqlPos)) {
                  $rowcount=mysqli_num_rows($result);
                  
                  mysqli_free_result($result);
                  if($rowcount>0){
                    echo "".$word." is Positive<br>";
                    $countPos++;
                  }
                    
                } else {
                    echo "error Pos";
                }
                if ($result2=mysqli_query($con,$sqlNeg)) {
                  $rowcount2=mysqli_num_rows($result2);
                    
                  mysqli_free_result($result2);
                  if($rowcount2>0){
                    echo "".$word." is Negative<br>";
                    $countNeg++;
                  }
                    
                } else {
                    echo "error Neg";
                }
                
                if ($result3=mysqli_query($con,$sqlNeu)) {
                  $rowcount3=mysqli_num_rows($result3);
                    
                  mysqli_free_result($result3);
                  if($rowcount3 > 0){
                    echo "".$word." is Neutral<br>";
                    $countNeu++;
                  }
                    
                } else {
                    echo "error Neu";
                }
                
                
                if($temp==$countPos+$countNeg+$countNeu){
                    echo "<form action='process.php' method='post'>
                            <fieldset>
                                <legend>Your Opinion for: $word</legend>
                                    <input type='radio' name='pos'>Positive <br>
                                    <input type='radio' name='neg'>Negative <br>
                                    <input type='radio' name='neutral'>Neutral <br>
                                    <input type='hidden' name='first' value="; echo "".$word.">";
                                    echo "<input type='submit' name='choice' value='Submit Your Opinion'>
                            </fieldset>
                        </form>";
                }
                
                if($i == $totalword){
                    echo "<br>Positive: ";
                    echo ($countPos/$totalword) * 100;
                    echo "%<br>";
                    echo "Negative: ";
                    echo ($countNeg/$totalword) * 100;
                    echo "%<br>";
                    echo "Neutral: ";
                    echo ($countNeu/$totalword) * 100;
                    echo "%<br>";
                }
            }
            
        } else {
            //process page
            //include('process.php');
        }
    ?>
    
    
    <form action="" method="post" style="margin: 10% 38%;">
        <input type="text" name="sentence" placeholder="Enter a sentence" autofocus>
        <input type="submit" value="Analysis" name="submit">
    </form>
    
</body>
</html>