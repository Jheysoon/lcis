
<div class="col-md-3"></div>
<div class="col-md-9 body-container">
    <div class="panel p-body">
        <div class="panel-heading search">
            <h4>Curriculum</h4>
        </div>
        <div class="panel-body">
            <table class="table table-bordered no-space">
                <?php
                     $getCurinfo = $this->common->getCurin($partyid, $date, $coursemajor);
                     $getCuYear = $this->common->getYearTerm($partyid, $date, $coursemajor);
                ?>
                    <tr>
                        <th>Course</th>
                        <th><strong><?php echo $getCurinfo['coursedescription']; ?></strong></td>
                        <th>Effectivity</th>
                        <th><strong><?php echo $getCurinfo['effectivity']; ?></strong></td>
                    </tr>

                    <?php foreach ($getCuYear as $m => $va): 
                            extract($va)
                    ?>

                        <tr>  
                            <td class="tbl-header-main" colspan="4">Year Level : <?php echo $yearlevel; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Term : <?php echo $term; ?></td>
                           
                        <!-- <td>Year Level</td> -->
                        </tr>
                        <tr>
                            <!-- <th>Curriculum ID</th>
                            <th>Academicterm</th>
                            <th>Curriculum</th>
                            <th>Academicterm</th> -->
                            <td class="tbl-header">Code</td>
                            <td class="tbl-header">Descriptive Title</td>
                            <td class="tbl-header" colspan="2">Units</th>
                            <!-- <td>Year Level</td> -->
                        </tr>
                                
                        <?php 
                            $curr = $this->common->selectCurr($partyid, $date, $coursemajor, $term, $yearlevel);
                            foreach ($curr as $key => $val): 
                            extract($val)
                        ?>
                                    <tr>
                                        <td><?php echo $code ?></td>
                                        <td><?php echo $descriptivetitle; ?></td>
                                        <td colspan="2"><?php echo $units ?></td> 
                                    </tr>
                             <?php endforeach ?>
            
                    <?php endforeach ?>
            </table>
        </div>
    </div>
</div>