<?php

$seconds = 25000;
set_time_limit ($seconds);
ini_set('memory_limit', '-1');


    try
    {
      $user = 'root';
      $pass = 'lcis+dev2015';
      $cn   = new PDO("mysql:host=localhost;dbname=lcis", $user, $pass);

      $x = $cn->prepare("SELECT tbl_fee.coursemajor, tbl_feetype.accounttype, tbl_accounttype.description
                         FROM tbl_fee, tbl_feetype, tbl_accounttype 
                         WHERE tbl_fee.coursemajor = 26
                         AND tbl_fee.feetype = tbl_feetype.id
                         AND tbl_feetype.accounttype = tbl_accounttype.id");
      $x->execute();
      $y = $x->fetchAll();
      foreach ($y as $key => $value) {


          $accounttype = $value['accounttype'];
          $coursemajor = $value['coursemajor'];
          $description = $value['description'];
           $q = $cn->prepare("INSERT INTO tbl_account SET party = '1', accounttype ='$accounttype',  description = '$description', seq = '$coursemajor', ccy = '1'");
           $q->execute() or die("cannot insert");
        }
      }
    catch( PDOException $e)
    {
        echo $e;
    }

    ?>
