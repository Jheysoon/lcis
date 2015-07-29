<?php
    $details = $this->tor->getStudDetails($sid);
    if ($details) {
    extract($details);
    $course = $description;
    $name = strtoupper($lastname).", ".ucwords(strtolower($firstname))." ".strtoupper($middlename);
    if ($major != 0) {
        $major2 = $this->api->getMajor($major)->row_array();
        $course = $description." (".$major2['description'].")";
    }
    $rows = $this->tor->getEnrolment2($pid);
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Leyte Colleges-Transcript of Record</title>
        <link rel="stylesheet" href="<?php echo base_url('/assets/css/print2.css'); ?>">
    </head>
    <body>
    <div class="print-header">
        <h2>Leyte Colleges - Transcript of Record</h2>
        <button type="button" class="print" onclick="window.print();">Print</button>
    </div>
    <?php
        $ctr = $rows['ctr']/2;
        if ($rows['ctr']%2 == 1) {
            $ctr = $ctr + 0.5;
        }
        $ctr2 = 1;
        $limit = 0;
        while ($ctr2 <= $ctr) { ?>
            <div class="wrapper">
            <?php $ctr3 = 0;  $arr = array();?>
            <div class="table1">
                <table>
                    <tr>
                        <td width="100px">
                            <img class="lc-logo" src="<?php echo base_url('/assets/images/LC Logo.jpg'); ?>" alt="" />
                        </td>
                        <td class="center">
                            <strong><label >LEYTE COLLEGES</label></strong><br/>
                            <strong><label >Tacloban City</label></strong><br/>
                            <strong><label >OFFICE OF THE REGISTRAR</label></strong><br/>
                            <label >Official Transcript of Record</label>
                        </td>
                        <td width="132px">
                            <img class="lc-img" src="<?php echo base_url('/assets/images/sample.jpg'); ?>" alt="" />
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td width="100px">Name :</td>
                        <td class="underline"><strong><?php echo $name; ?></strong></td>
                        <td width="25px">Sex :</td>
                        <td width="50px" class="center underline"><?php echo $sex; ?></td>
                    </tr>
                    <tr>
                        <td>Permanent Address :</td>
                        <td colspan="3" class="underline"><?php echo $address1 ?>   </td>
                    </tr>
                    <tr>
                        <td>Date of Entrance :</td>
                        <td colspan="3" class="underline"></td>
                    </tr>
                    <tr>
                        <td>Source of Entrance :</td>
                        <td colspan="3" class="underline"></td>
                    </tr>
                    <tr>
                        <td>Course :</td>
                        <td colspan="3" class="underline"><?php echo $course; ?></td>
                    </tr>
                </table>
            </div>
            <div class="table2">
                <table>
                    <tr>
                        <td colspan="3" class="center">
                            <strong><label >LEYTE COLLEGES</label></strong><br/>
                            <strong><label >Tacloban City</label></strong><br/>
                            <strong><label >RECORD OF CANDIDATE FOR GRADUATION</label></strong>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <label >College of</label> <u>&nbsp;&nbsp;<?php echo $college; ?>&nbsp;&nbsp;</u><br/>
                            <label >Candidate for Title/Degree: <u>&nbsp;&nbsp;<?php echo $description; ?>&nbsp;&nbsp;</u></label><br/>
                            <label >College of</label><br/>
                            <label >Candidate for Title/Degree</label><br/>
                            <label >Major in</label><br/>
                            <label >Date of Graduation</label>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td colspan="3" class="center">
                            <strong><label >PRELIMINARY EDUCATION</label></strong><br/>
                        </td>
                    </tr>
                    <tr>
                        <td class="center" width="50px">
                            <label>COMPLETED</label>
                        </td>
                        <td class="center">
                            <label>NAME OF SCHOOL</label>
                        </td>
                        <td class="center">
                            <label>YEAR</label>
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
            <div class="table1">
                <table class="tbl-bordered">
                    <tr>
                        <td class="center" rowspan="2" colspan="2">SUBJECTS<br/>(With Descriptive Title)</td>
                        <td class="center" colspan="2">GRADES</td>
                        <td class="center no-right" rowspan="2">CREDITS</td>
                    </tr>
                    <tr>
                        <td class="center">Final</td>
                        <td class="center">Re-Ex</td>
                    </tr>
                    <?php
                    $enrol = $this->tor->getEnrolment($pid, $limit);
                    $sch = '';
                    foreach ($enrol as $key => $val) { extract($val);
                        if ($sch != $val['school']) {
                            ?>
                                <tr>
                                    <td class="no-right" colspan="5"><strong><?php echo $val['firstname']; ?></strong></td>
                                </tr>
                            <?php $ctr3+=1; $arr[] = $ctr3;
                        }
                            ?>
                                <tr>
                                    <td class="center no-right" colspan="5"><?php echo $val['shortname']." SY : ". $val['systart']."-".$val['syend']; ?></td>
                                </tr>
                            <?php
                            $ctr3+=1; $arr[] = $ctr3;
                            $sch = $val['school'];
                            $grade = $this->tor->getGrade($id);
                            foreach ($grade as $key2 => $val2) {
                                $gr = $val2['grade'];
                                $rex = '';
                                if ($val2['reexamgrade'] != 0) {
                                    $rgrade = $this->tor->getRegrade($val2['reexamgrade']);
                                    if ($rgrade) {
                                        if ($rgrade['value'] == 0.00) {
                                            $rex = $rgrade['description'];
                                            if ($rex == 'INCOMPLETE') {
                                                $rex = 'INC';
                                            }
                                            elseif ($rex == 'DROPPED') {
                                                $rex = 'DRP';
                                            }
                                            else{
                                                $rex = '';
                                            }
                                        }
                                        else{
                                            $rex = $rgrade['value'];
                                        }
                                    }
                                }
                                $grr = '';
                                if ($val2['grade'] == 0.00) {
                                        $gr = $val2['gdesc'];
                                        if ($gr == 'INCOMPLETE') {
                                            $gr = 'INC';
                                        }
                                        elseif ($gr == 'DROPPED') {
                                            $gr = 'DRP';
                                        }
                                        else{
                                            $gr = '';
                                        }
                                }
                                ?>
                                <tr>
                                    <td class="no-line"><?php echo $val2['code']; ?></td>
                                    <td class="no-line"><?php echo $val2['title']; ?></td>
                                    <td class="center no-line"><?php echo $gr; ?></td>
                                    <td class="center no-line"><?php echo $rex." ".$val2['reexamgrade']; ?></td>
                                    <td class="center no-line no-right"><?php echo $val2['units']; ?></td>
                                </tr>
                    <?php $ctr3+=1;}
                    }
                        if ($ctr2 < $ctr) { ?>
                            <tr>
                                <td class="no-line"></td>
                                <td class="center no-line">-- over --</td>
                                <td class="center no-line"></td>
                                <td class="center no-line"></td>
                                <td class="center no-line no-right"></td>
                            </tr>
                    <?php   $ctr3+=1; } ?>
                </table>
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
                <table>
                    <tr>
                        <td><strong>TITLE OR DEGREE CONFERRED :</strong>&nbsp;&nbsp;<u><?php echo $course ?>&nbsp;&nbsp;</u></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td width="200px">Granted under Authority of Special Order No.:</label></td>
                        <td class="underline"></td>
                        <td width="5px"><label >Series: </td>
                        <td width="30px" class="underline"></td>
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
                        <td colspan="3" class="underline"></td>
                    </tr>
                    <tr>
                        <td colspan="4"><strong>NOT VALID WITHOUT SCHOOL SEAL</strong></td>
                    </tr>
                    <tr>
                        <td><label><strong>OR No. :</strong></label></td>
                        <td class="underline"></td>
                    </tr>
                </table><br/><br/>
                <!--------------------------------------- assignatories  ------------------------------------------>
                <table>
                    <tr>
                        <td class="center" width="50%">
                            <label ><strong><u>&nbsp;&nbsp;AMADOR C. ASTILLA&nbsp;&nbsp;</u></strong></label><br/>
                            <label >Checked By</label>
                        </td>
                        <td class="center" width="50%">
                            <label><strong><u>&nbsp;&nbsp;JOSEFA YASMIN A. MORIEL, D.M.&nbsp;&nbsp;</u></strong></label><br/>
                            <label >Head, OSG concurrent, OIC-Registrar</label>
                        </td>
                    </tr>
                </table><br/><br/>
                <table>
                    <tr>
                        <td class="center" width="50%">
                            <label ><strong><u>&nbsp;&nbsp;SUSAN A. CASAS&nbsp;&nbsp;</u></strong></label><br/>
                            <label >Prepared By</label>
                        </td>
                        <td class="center" width="50%">
                            <label ><strong><u>&nbsp;&nbsp;AMADOR C. ASTILLA&nbsp;&nbsp;</u></strong></label><br/>
                            <label >Treasurer</label>
                        </td>
                    </tr>
                </table><br/>
            </div>
            <div class="table2">
                <table class="tbl-bordered">
                    <tr>
                        <td class="center no-left" colspan="10">Credits by Groups</td>
                    </tr>
                    <tr>
                        <td width="10%" class="center no-left">1</td>
                        <td width="10%" class="center">2</td>
                        <td width="10%" class="center">3</td>
                        <td width="10%" class="center">4</td>
                        <td width="10%" class="center">5</td>
                        <td width="10%" class="center">6</td>
                        <td width="10%" class="center">7</td>
                        <td width="10%" class="center">8</td>
                        <td width="10%" class="center">9</td>
                        <td width="10%" class="center">10</td>
                    </tr>
                    <?php
                    $a = 1;
                    while ($a <= $ctr3) {
                        if (in_array($a, $arr)) {
                            echo '<tr><td colspan = "10" class="no-left">&nbsp;</td></tr>';
                        }
                        else{
                            ?>
                            <tr>
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
                            </tr>
                            <?php
                        } $a+=1 ;
                    } ?>
                    <tr>
                        <td class="center no-left" colspan="10">Total credits presented for graduation</td>
                        <tr>
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
                        </tr>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td></td>
                        <td width="30px">Total :</td>
                        <td width="50px" class="underline"></td>
                    </tr>
                </table><br/>
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
                            <label><strong><u>&nbsp;&nbsp;JOSEFA YASMIN A. MORIEL, D.M.&nbsp;&nbsp;</u></strong></label><br/>
                            <label >Head, OSG concurrent, OIC-Registrar</label>
                        </td>
                    </tr>
                </table><br/>
                <table>
                    <tr>
                        <td width="70px">Evaluated By :</td>
                        <td class="underline"></td>
                        <td></td>
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
            </div>
    <?php $ctr2+=1;} ?>
    </body>
</html>
<?php }
    else{
        echo "No Data Found!";
    }
?>
