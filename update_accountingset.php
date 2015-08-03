<?php


$seconds = 2000000;
set_time_limit ($seconds);
ini_set('memory_limit', '-1');
try{

      $user = 'root';
      $pass = 'lcis+dev2015';
      $cn   = new PDO("mysql:host=localhost;dbname=legacy_billings", $user, $pass);
      $acc = 133171;
      $x = $cn->prepare("SELECT * FROM tbl_movement WHERE accountingset = 133171 GROUP by referencetype, referenceid");
      $x->execute();
      $ups = $x->fetch();

      foreach ($ups as $key => $value) {
        extract($value);
        $accountingset += 1;
        $totalacc = $acc + $accountingset;
        $up = $cn->prepare("UPDATE tbl_movement SET accountingset = $totalacc WHERE referencetype = '$referencetype' AND referenceid = '$referenceid'");
        $up->execute();
      }

      }

    }
catch( PDOException $e){
    echo $e;
}

?>
