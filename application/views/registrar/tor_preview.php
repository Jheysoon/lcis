<?php
    $details = $this->tor->getStudDetails($sid);
if ($details) {
    extract($details);
    $course = $description;
    $cm = '';
    if($pic == ''){
        $pic = '/assets/images/sample.jpg';
    }
    else{
        $pic = '/assets/images/profile/'.$pic;
    }
    $name = strtoupper($lastname).", ".ucwords(strtolower($firstname))." ".strtoupper($middlename);
    if ($major != 0) {
        $major2 = $this->tor->getMajor($major);
        $course = $description." (".$major2['description'].")";
        $cm = $major2['description'];
    }

    if ($this->session->has_userdata('for')) {
        $for = $this->session->userdata('for');
    }
    else{
        $for = 'Student';
    }

    $res = $this->tor->getAssignatories();
    $ctr = 1;
    foreach ($res as $key => $value) {
        extract($value);
        ${'f'.$ctr.'1'} = $assignatory;
        ${'f'.$ctr.'2'} = $designation;
        $ctr+=1;
    }

    $order_title = 'Granted under Authority of Special Order No.';
    $order_no    = '';
    $series      = '';
    $remarks     = '';

    if ($this->session->has_userdata('fields')) {
        extract($this->session->userdata('fields'));
    }
    $total_cr = 0;
    $cr1 = 0; $cr2 = 0; $cr3 = 0; $cr4 = 0; $cr5 = 0;
    $cr6 = 0; $cr7 = 0; $cr8 = 0; $cr9 = 0; $cr10 = 0;

    $source = $this->tor->getSource($pid);
    if ($source) {
        extract($source);
        if ($tor == 1) {
            $source = 'Honorable Dismissal';
        }
        elseif($hscard == 1){
            $source = 'Form 137';
        }
        else{
            $source = '';
        }
    }
    else{
        $source = '';
    }

    if ($sex == 'M') {
        $sex = 'Male';
    }
    else if ($sex == 'F') {
        $sex = 'Female';
    }
    else{
        $sex = '';
    }
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Leyte Colleges-Transcript of Record</title>
        <link rel="icon" type="image/jpg" href="<?php echo base_url('assets/images/LC Logo.jpg'); ?>">
        <link rel="shortcut icon" type="image/jpg" href="<?php echo  base_url('assets/images/LC logo.jpg'); ?>">

        <link rel="stylesheet" href="<?php echo base_url('/assets/css/print2.css'); ?>">
    </head>
    <body>
    <div class="print-header">
        <h2>Leyte Colleges - Transcript of Record <small style="font-weight: normal;">( Copy for <?php echo $for; ?> )</small></h2>
        <a href="/menu/registrar-tor_studlist" class="a print">Go Back</a>
        <a class="a print" onclick="window.print();">Print</a>
        <a href="/registrar/print_fields/<?php echo $sid; ?>" class="a print">Edit Fields</a>
        <?php if ($for == 'Student'): ?>
            <a href="/registrar/set_print_for/<?php echo $sid; ?>/<?php echo 'CHED' ?>" class="a print">CHED Copy</a>
        <?php else: ?>  
            <a href="/registrar/set_print_for/<?php echo $sid; ?>/<?php echo 'Student' ?>" class="a print">Student Copy</a>
        <?php endif ?>    </div>
    <?php
        $page = $this->api->countPage($sid);
        $sch = '';
        $aca = '';
        $ctr2 = 1;
        $limit = 0;
        while ($ctr2 <= $page) { ?>

        <!-- =================== wrapper per page ==================== -->

        <div class="wrapper">
            <?php $ctr3 = 0; $ctr4 = 0;  $arr = array(); $credit = array();?>

            <!-- ================= Left header ================ -->
            <div class="table1">

                <table>
                    <tr>
                        <td width="100px">
                            <img class="lc-logo" src="<?php echo base_url('/assets/images/LC Logo.jpg'); ?>" alt="" />
                        </td>
                        <td class="center">
                            <strong><label class="main" >LEYTE COLLEGES</label></strong><br/>
                            <strong><label class="fontTimes">Tacloban City</label></strong><br/>
                            <strong><label class="fontTimes" style="font-size: 11px;">OFFICE OF THE REGISTRAR</label></strong><br/>
                            <label class="fontBrush" style="font-size: 11px;">Official Transcript of Record</label>
                        </td>
                        <?php if ($ctr2 == 1): ?> 
                            <td width="100px">   
                                <img class="lc-img" src="<?php echo $pic; ?>" alt="" />
                            </td>    
                        <?php endif ?>
                        
                    </tr>
                </table>
                <?php if ($ctr2 != 1): ?>
                    <br/>
                <?php endif ?>
                <br/>
                <table>
                    <tr>
                        <td width="100px">Name :</td>
                        <td class="underline" style="font-size: 14px;"> &nbsp;<strong><?php echo $name; ?></strong></td>
                        <td width="50px">Gender :</td>
                        <td width="50px" class="center underline"> &nbsp;<strong><?php echo $sex; ?></strong></td>
                    </tr>
                    <tr>
                        <td>Student No. :</td>
                        <td class="underline"> &nbsp;<strong><?php echo $legacyid ?>   </strong></td>
                        <td width="80px">Date of Birth :</td>
                        <td width="80px" class="center underline"> &nbsp;<strong><?php echo $dateofbirth; ?></strong></td>
                    </tr>
                    <tr>
                        <td>Permanent Address :</td>
                        <td colspan="3" class="underline"> &nbsp;<strong><?php echo $address1 ?>   </strong></td>
                    </tr>
                    <tr>
                        <td>Date of Entrance :</td>
                        <td colspan="3" class="underline"> &nbsp;<strong><?php echo $dte; ?></strong></td>
                    </tr>
                    <tr>
                        <td>Source of Entrance :</td>
                        <td colspan="3" class="underline"> &nbsp;<strong><?php echo $source; ?></strong></td>
                    </tr>
                    <tr>
                        <td>Course :</td>
                        <td colspan="3" class="underline"> &nbsp;<strong><?php echo $course; ?></strong></td>
                    </tr>
                </table>
            </div>

            <!-- ================= Right header ================ -->
            <div class="table2">
                <table>
                    <tr>
                        <td colspan="3" class="center">
                            <strong><label class="fontTimes">LEYTE COLLEGES</label></strong><br/>
                            <strong><label class="fontTimes" >Tacloban City</label></strong><br/>
                            <strong><label >RECORD OF CANDIDATE FOR GRADUATION</label></strong>
                        </td>
                    </tr>
                    <tr colspan="3">
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="50">College of :</td>
                        <td colspan="2" class="center underline"><strong><?php echo $college; ?></strong></td>
                    </tr>
                    </table><table>
                        <tr>
                            <td>Candidate for Title/Degree :</td>
                        </tr>
                        <tr>
                            <td class="center underline"><strong><?php echo $description; ?></strong></td>
                        </tr>
                    </table><table>
                        <tr>
                            <td width="50">Major in :</td>
                            <td class="center underline"><strong><?php echo $cm; ?></strong></td>
                        </tr>
                    </table><table>
                        <tr>
                            <td width="85">Date of Graduation :</td>
                            <td class="center underline"><strong><?php echo "" ?></strong></td>
                        </tr>
                </table>
                <br/>
                <table>
                    <tr>
                        <td colspan="3" class="center">
                            <strong><label >PRELIMINARY EDUCATION</label></strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="center" width="50px">
                            <label><strong>COMPLETED</label></strong>
                        </td>
                        <td class="center">
                            <label><strong>NAME OF SCHOOL</label></strong>
                        </td>
                        <td class="center">
                            <label><strong>YEAR</label></strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Primary</label>
                        </td>
                        <td class="center underline">
                            <label><?php echo $this->tor->getSchool($primary);?></label>
                        </td>
                        <td class="center underline">
                            <label><?php echo $completionprimary; ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Intermediate</label>
                        </td>
                        <td class="center underline">
                            <label><?php echo $this->tor->getSchool($elementary); ?></label>
                        </td>
                        <td class="center underline">
                            <label><?php echo $completionelementary; ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Secondary</label>
                        </td>
                        <td class="center underline">
                            <label><?php echo $this->tor->getSchool($secondary); ?></label>
                        </td>
                        <td class="center underline">
                            <label><?php echo $completionsecondary; ?></label>
                        </td>
                    </tr>
                </table>
            </div>
            <!-- start of second row of tables for TOR -->

            <!-- ======================= Left TOR Body ========================= -->
            <div class="table1">
                <table class="tbl-bordered">
                    <tr>
                        <th class="center" rowspan="2" colspan="2">SUBJECTS<br/>(With Descriptive Title)</th>
                        <th class="center" colspan="2">GRADES</th>
                        <th width="10" class="center no-right td-center" rowspan="2">CREDITS</th>
                    </tr>
                    <tr>
                        <th width="40" class="center">Final</th>
                        <th width="40" class="center">Re-Ex</th>
                    </tr>
                    <?php
                    $page_limiter = 0;
                    if ($ctr2 != 1) {
                        $plimit = 29;   
                    }
                    else{
                        $plimit = 20;
                    }
                    $enrol = $this->tor->getEnrolment($pid, $limit, $plimit);
                    foreach ($enrol as $key => $val) {
                        extract($val);
                        $acad = $systart."-".$syend." ".$shortname;
                        if ($school != $sch) {

                            // do not show school if its on the last row then break the loop
                            if ($page_limiter == $plimit) {
                                break;
                            }
                            // echo "<tr><td class='center no-line no-right' colspan='5'>".$school."</td></tr>";
                            ?>
                            <tr>
                                <td class="no-line"></td>
                                <td class="center no-line"><u><?php echo $school; ?></u></td>
                                <td class="center no-line"></td>
                                <td class="center no-line"></td>
                                <td class="center no-line no-right"></td>
                            </tr>
                            <?php

                            $sch = $school; $page_limiter++;$ctr3+=1; $ctr4+=1; $arr[] = $ctr3;
                        }
                        if ($aca != $acad) {

                            // do not show academicterm if its on the last row then break the loop
                            if ($page_limiter == $plimit) {
                                break;
                            }
                            // echo "<tr><td class='center no-line no-right' colspan='5'>".$acad."</td></tr>";
                            ?>
                            <tr>
                                <td class="no-line"></td>
                                <td class="center no-line"><u><?php echo $acad; ?></u></td>
                                <td class="center no-line"></td>
                                <td class="center no-line"></td>
                                <td class="center no-line no-right"></td>
                            </tr>
                            <?php
                            $aca = $acad; $page_limiter++;$ctr3+=1; $ctr4+=1; $arr[] = $ctr3;
                        }

                        // get sem grade
                        $g1 = $this->tor->getGrade($semgrade);
                        $gr1 = $g1['value'];
                        if ( $gr1 == 0.00) {
                                $gr1 = $g1['description'];
                                if ($gr1 == 'INCOMPLETE') {
                                    $gr1 = 'INC';
                                }
                                elseif ($gr1 == 'DROPPED') {
                                    $gr1 = 'DRP';
                                }
                                else{
                                    $gr1 = '';
                                }
                        }

                        // get re-exam grade
                        $g2 = $this->tor->getGrade($reexamgrade);
                        $gr2 = $g2['value'];
                        if ($gr2 == 0.00) {
                                $gr2 = $g2['description'];
                                if ($gr2 == 'INCOMPLETE') {
                                    $gr2 = 'INC';
                                }
                                elseif ($gr2 == 'DROPPED') {
                                    $gr2 = 'DRP';
                                }
                                else{
                                    $gr2 = '';
                                }
                        }

                        // check for long descriptive titles for splitting and add new row
                        if (strlen($descriptivetitle) > 35) {
                            $title = explode(' ', $descriptivetitle);
                            $count = count($title);
                            $f = intval($count/2);
                            $fword = '';
                            $sword = '';
                            for ($i=0; $i < $f; $i++) {
                                $fword = $fword." ".$title[$i];
                            }
                            for ($i=$i; $i < $count; $i++) {
                                $sword = $sword." ".$title[$i];
                            }
                            $descriptivetitle = $fword."<br>".$sword;

                            $page_limiter++;
                            $ctr3+=1;
                            $ctr4+=1;
                            if (is_numeric($gr1) || is_numeric($gr2)) {
                                if ($gr1 <= 3.0 || $gr2 <= 3.0) {
                                    $credit[$ctr4] = $group."|".$units."|<br/>&nbsp;";
                                }
                                else{
                                    $credit[$ctr4] = "0|0|<br/>&nbsp;";
                                }
                            }
                            else{
                                $credit[$ctr4] = "0|0|<br/>&nbsp;";
                            }
                        }
                        else{
                            $ctr3+=1;
                            $ctr4+=1;
                            if (is_numeric($gr1) || is_numeric($gr2)) {
                                if ($gr1 <= 3.0 || $gr2 <= 3.0) {
                                    $credit[$ctr4] = $group."|".$units;
                                }
                                else{
                                    $credit[$ctr4] = "0|0";
                                }
                            }
                            else{
                                $credit[$ctr4] = "0|0";
                            }
                        }
                        ?>
                        <tr>
                            <td class="no-line" width="80px"><?php echo $code; ?></td>
                            <td class="no-line"><?php echo ucwords(strtolower($descriptivetitle)); ?></td>
                            <td class="center no-line"><?php echo $gr1; ?></td>
                            <td class="center no-line"><?php echo $gr2; ?></td>
                            <td class="center no-line no-right"><?php echo $units; ?></td>
                        </tr>
                    <?php
                        $limit++;
                        $page_limiter++;
                        if ($page_limiter == $plimit) {
                            break;
                        }
                    }
                    if ($ctr2 < $page) { ?>
                        <tr>
                            <td class="no-line"></td>
                            <td class="center no-line">-- over --</td>
                            <td class="center no-line"></td>
                            <td class="center no-line"></td>
                            <td class="center no-line no-right"></td>
                        </tr>
                    <?php $ctr3+=1; $ctr4+=1; $credit[$ctr4] = "&nbsp;"; } ?>
                </table>
                <!-- end of tor table -->

                <!-- ======================= left footer & Assignatories ===================== -->
                <?php if ($ctr2 == 1): ?>
                <table>
                    <tr>
                        <td>
                            <p class="p-small">
                                <label ><strong>GRADING SYSTEM :</strong></label><br/>
                                98-100%-1.0; 96-97%-1.1; 94-95%-1.2; 93%-1.3; 92%-1.4; 91%-1.5; 89-90%-1.6;
                                88%-1.7; 87%-1.8; 86%-1.9; 85%-2.0; 84%-2.1; 83%-2.2; 82%-2.3; 81%-2.4;
                                80%-2.5; 79%-2.6; 78%-2.7; 77%-2.8; 76%-2.9; 75%-3.0; INC-Incomplete;
                                5.0-Failure; DR-Drop
                            </p>
                            <p class="p-small">
                                <label ><strong>CREDIT :</strong></label><br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; One collegiate unit of credit is one lecture or recitation each week for the period
                                of a complete semester. In all courses, two and a half to three hours of laboratory work,
                                and in technical courses, three hours of drafting or shop work, are regarded as eqiuvalent
                                of one recitation or lecture.
                            </p>
                        </td>
                    </tr>
                </table>
                <?php else: ?>

                    <br/>
                <?php endif ?>
                <table>
                    <tr>
                        <td width="160px"><strong>TITLE OR DEGREE CONFERRED :</td>
                        <td class="center underline"><?php echo $course ?>&nbsp;&nbsp;</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td width="200px"><?php echo $order_title; ?>:</label></td>
                        <td class="underline"><?php echo $order_no; ?></td>
                        <td width="5px"><label >Series: </td>
                        <td width="30px" class="underline"><?php echo $series; ?></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td width="50px">Dated :</label></td>
                        <td class="underline"></td>
                        <td width="100px"><label >Date of Graduation: </td>
                        <td class="underline"></td>
                    </tr>
                    <tr>
                        <td>Remarks :</td>
                        <td colspan="3" class="underline center"><strong><?php echo $remarks; ?></strong></td>
                    </tr>
                    <tr>
                        <td colspan="4"><strong>NOT VALID WITHOUT SCHOOL SEAL</strong></td>
                    </tr>
                    <tr>
                        <td><label><strong>OR No. :</strong></label></td>
                        <td class="underline"></td>
                    </tr>
                </table><br/><br/>
                <!-- =========================== assignatories ====================== -->
                <table>
                    <tr>
                        <td class="center" width="50%">
                            <label ><strong><u>&nbsp;&nbsp;<?php echo $f11; ?>&nbsp;&nbsp;</u></strong></label><br/>
                            <label ><?php echo $f12; ?></label>
                        </td>
                        <td class="center" width="50%">
                            <label><strong><u>&nbsp;&nbsp;<?php echo $f21; ?>&nbsp;&nbsp;</u></strong></label><br/>
                            <label ><?php echo $f22; ?></label>
                        </td>
                    </tr>
                </table><br/><br/>
                <table>
                    <tr>
                        <td class="center" width="50%">
                            <label ><strong><u>&nbsp;&nbsp;<?php echo $f31; ?>&nbsp;&nbsp;</u></strong></label><br/>
                            <label ><?php echo $f32; ?></label>
                        </td>
                        <td class="center" width="50%">
                            <label ><strong><u>&nbsp;&nbsp;<?php echo $f41; ?>&nbsp;&nbsp;</u></strong></label><br/>
                            <label ><?php echo $f42; ?></label>
                        </td>
                    </tr>
                </table><br/><br/>
            </div>
            <!-- end of left footer and assignatories -->


            <!-- ======================= Right TOR Body ========================= -->
            <div class="table2">
                <table class="tbl-bordered">
                    <tr>
                        <th class="center no-left" colspan="10">Credits by Groups</th>
                    </tr>
                    <tr>
                        <th width="10%" class="center no-left">1</th>
                        <th width="10%" class="center">2</th>
                        <th width="10%" class="center">3</th>
                        <th width="10%" class="center">4</th>
                        <th width="10%" class="center">5</th>
                        <th width="10%" class="center">6</th>
                        <th width="10%" class="center">7</th>
                        <th width="10%" class="center">8</th>
                        <th width="10%" class="center">9</th>
                        <th width="10%" class="center">10</th>
                    </tr>
                    <?php
                    $a = 1;
                    while ($a <= $ctr3) {
                        if (in_array($a, $arr)) {
                            echo '<tr>
                                <td class="center no-line no-left">&nbsp;</td>
                                <td class="center no-line"></td>
                                <td class="center no-line"></td>
                                <td class="center no-line"></td>
                                <td class="center no-line"></td>
                                <td class="center no-line"></td>
                                <td class="center no-line"></td>
                                <td class="center no-line"></td>
                                <td class="center no-line"></td>
                                <td class="center no-line"></td>
                            </tr>';
                        }
                        else{ $cr = explode('|', $credit[$a]) ?>
                            <tr>
                                <td class="center no-line no-left">
                                <?php 
                                    if ($for == 'Student') {
                                        echo "&nbsp;";
                                    }
                                    else{
                                        if ($cr[0] == 1) {
                                            echo $cr[1];
                                            $cr1 = $cr1 + $cr[1];
                                            $total_cr = $total_cr + $cr1;
                                        }
                                        else{
                                            echo "&nbsp;";
                                        }
                                    }
                                    if (count($cr) == 3) {
                                        echo $cr[2];
                                    } 
                                ?></td>
                                <td class="center no-line"><?php if($for == 'Student'){ echo "&nbsp;"; } else{ if ($cr[0] == 2)  {echo $cr[1]; $cr2 = $cr2 + $cr[1];   $total_cr = $total_cr + $cr2;}  else{echo "&nbsp;";}} ?></td>
                                <td class="center no-line"><?php if($for == 'Student'){ echo "&nbsp;"; } else{ if ($cr[0] == 3)  {echo $cr[1]; $cr3 = $cr3 + $cr[1];   $total_cr = $total_cr + $cr3;}  else{echo "&nbsp;";}} ?></td>
                                <td class="center no-line"><?php if($for == 'Student'){ echo "&nbsp;"; } else{ if ($cr[0] == 4)  {echo $cr[1]; $cr4 = $cr4 + $cr[1];   $total_cr = $total_cr + $cr4;}  else{echo "&nbsp;";}} ?></td>
                                <td class="center no-line"><?php if($for == 'Student'){ echo "&nbsp;"; } else{ if ($cr[0] == 5)  {echo $cr[1]; $cr5 = $cr5 + $cr[1];   $total_cr = $total_cr + $cr5;}  else{echo "&nbsp;";}} ?></td>
                                <td class="center no-line"><?php if($for == 'Student'){ echo "&nbsp;"; } else{ if ($cr[0] == 6)  {echo $cr[1]; $cr6 = $cr6 + $cr[1];   $total_cr = $total_cr + $cr6;}  else{echo "&nbsp;";}} ?></td>
                                <td class="center no-line"><?php if($for == 'Student'){ echo "&nbsp;"; } else{ if ($cr[0] == 7)  {echo $cr[1]; $cr7 = $cr7 + $cr[1];   $total_cr = $total_cr + $cr7;}  else{echo "&nbsp;";}} ?></td>
                                <td class="center no-line"><?php if($for == 'Student'){ echo "&nbsp;"; } else{ if ($cr[0] == 8)  {echo $cr[1]; $cr8 = $cr8 + $cr[1];   $total_cr = $total_cr + $cr8;}  else{echo "&nbsp;";}} ?></td>
                                <td class="center no-line"><?php if($for == 'Student'){ echo "&nbsp;"; } else{ if ($cr[0] == 9)  {echo $cr[1]; $cr9 = $cr9 + $cr[1];   $total_cr = $total_cr + $cr9;}  else{echo "&nbsp;";}} ?></td>
                                <td class="center no-line"><?php if($for == 'Student'){ echo "&nbsp;"; } else{ if ($cr[0] == 10) {echo $cr[1]; $cr10 = $cr10 + $cr[1]; $total_cr = $total_cr + $cr10;} else{echo "&nbsp;";}} ?></td>
                            </tr>
                            <?php
                        } $a+=1 ;
                    } ?>
                    <tr>
                        <th class="center no-left" colspan="10">Total credits presented for graduation</th>
                        <tr>
                            <td class="center no-line no-left"><?php if($for == 'Student'){ echo "&nbsp;"; } else{if ($cr1 != 0 && $ctr2 == $page) {echo $cr1;}else{echo "&nbsp;";} } ?></td>
                            <td class="center no-line"><?php if($for == 'Student'){ echo "&nbsp;"; } else{if ($cr2 != 0 && $ctr2 == $page) {echo $cr2;}else{echo "&nbsp;";} } ?></td>
                            <td class="center no-line"><?php if($for == 'Student'){ echo "&nbsp;"; } else{if ($cr3 != 0 && $ctr2 == $page) {echo $cr3;}else{echo "&nbsp;";} } ?></td>
                            <td class="center no-line"><?php if($for == 'Student'){ echo "&nbsp;"; } else{if ($cr4 != 0 && $ctr2 == $page) {echo $cr4;}else{echo "&nbsp;";} } ?></td>
                            <td class="center no-line"><?php if($for == 'Student'){ echo "&nbsp;"; } else{if ($cr5 != 0 && $ctr2 == $page) {echo $cr5;}else{echo "&nbsp;";} } ?></td>
                            <td class="center no-line"><?php if($for == 'Student'){ echo "&nbsp;"; } else{if ($cr6 != 0 && $ctr2 == $page) {echo $cr6;}else{echo "&nbsp;";} } ?></td>
                            <td class="center no-line"><?php if($for == 'Student'){ echo "&nbsp;"; } else{if ($cr7 != 0 && $ctr2 == $page) {echo $cr7;}else{echo "&nbsp;";} } ?></td>
                            <td class="center no-line"><?php if($for == 'Student'){ echo "&nbsp;"; } else{if ($cr8 != 0 && $ctr2 == $page) {echo $cr8;}else{echo "&nbsp;";} } ?></td>
                            <td class="center no-line"><?php if($for == 'Student'){ echo "&nbsp;"; } else{if ($cr9 != 0 && $ctr2 == $page) {echo $cr9;}else{echo "&nbsp;";} } ?></td>
                            <td class="center no-line"><?php if($for == 'Student'){ echo "&nbsp;"; } else{if ($cr10 != 0 && $ctr2 == $page) {echo $cr10;}else{echo "&nbsp;";} } ?></td>
                        </tr>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td></td>
                        <td width="30px">Total :</td>
                        <td width="50px" class="center underline"><?php if($for == 'Student'){ echo "&nbsp;"; } else{ if ($total_cr != 0 && $ctr2 == $page) {echo $total_cr;}else{echo "&nbsp;";}} ?></td>
                    </tr>
                </table><br/>
                <!-- end of group credits -->

                <!-- ================== right footer for ched ===================== -->
                <table>
                    <tr>
                        <td class="center"><strong><label>CERTIFICATION</label></strong></td>
                    </tr>
                    <tr>
                        <td>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;THIS IS TO CERTIFY that the foregoing records of
                            <u>&nbsp;&nbsp;<strong><?php echo $name; ?></strong>&nbsp;&nbsp;</u> a candidate for graduation in this
                            institution had been verified by me and that true copied of the official record
                            substantiating same are kept in the file of our school.
                        </td>
                    </tr>
                </table><br/><br/>
                <table>
                    <tr>
                        <td class="center">
                            <label><strong><u>&nbsp;&nbsp;<?php echo $f21; ?>&nbsp;&nbsp;</u></strong></label><br/>
                            <label ><?php echo $f22; ?></label>
                        </td>
                    </tr>
                </table><br/><br/>
                <table>
                    <tr>
                        <td width="70px">Evaluated By :</td>
                        <td class="underline"></td>
                    </tr>
                </table>
            </div>
            <div class="table1">
                <table>
                    <tr>
                        <td width="50px">Date :</td>
                        <td width="150px" class="center underline"><?php echo date('m/d/Y'); ?></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="table2">
                <table>
                    <tr>
                        <td></td>
                        <td width="35px">Sheet :</td>
                        <td width="50px" class="center underline"><?php echo $ctr2; ?></td>
                    </tr>
                </table>
            </div>
            <!-- end of right footer -->
        </div>
        <!-- end of wrapper -->
        <?php $ctr2+=1;} // end of wrapper/page loop ?>

    </body>
</html>
<?php }
    else{
        echo "No Data Found!";
    }
?>
