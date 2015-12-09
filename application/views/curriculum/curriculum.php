
<div class="col-md-3"></div>
<div class="col-md-9 body-container">
    <div class="panel p-body">
        <div class="panel-heading search">
            <h4>Curriculum</h4>
        </div>
        <div class="panel-body">
            <table class="table table-bordered no-space">
                <?php
                    $getCurinfo = $this->registration->getLatestCM($partyid);
                    
                    $this->db->where('id', $getCurinfo['curriculum']);
                    $curriculum = $this->db->get('tbl_curriculum')->row();
                    
                    $academicterm = $this->academicterm->findById($curriculum->academicterm);
                    
                ?>
                    <tr>
                        <th>Course</th>
                        <th><strong><?php echo $this->course->getCourse($getCurinfo['coursemajor']); ?></strong></td>
                        <th>Effectivity</th>
                        <th><strong><?php echo $academicterm['systart'].'-'.$academicterm['syend'] ?></strong></td>
                    </tr>
                    
                <?php 
                    $cur = $this->db->query("SELECT * FROM `tbl_curriculumdetail` WHERE curriculum = $curriculum->id GROUP BY yearlevel, term ORDER BY yearlevel, term")->result();
                    
                    foreach ($cur as $cur_detail) {
                        ?>
                        <tr>  
                            <td class="tbl-header-main" colspan="4">Year Level : <?php echo $cur_detail->yearlevel; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Term : <?php echo $cur_detail->term; ?></td>
                        </tr>
                        <tr>
                            <td class="tbl-header">Code</td>
                            <td class="tbl-header">Descriptive Title</td>
                            <td class="tbl-header" colspan="2">Units</th>
                        </tr>
                        <?php 
                            $this->db->where('yearlevel', $cur_detail->yearlevel)->where('term', $cur_detail->term)->where('curriculum', $curriculum->id);
                            $details = $this->db->get('tbl_curriculumdetail')->result();
                            
                            foreach ($details as $detail) {
                                $subject = $this->subject->findById($detail->subject);
                        ?>
                        <tr>
                            <td><?php echo $subject['code'] ?></td>
                            <td><?php echo $subject['descriptivetitle']; ?></td>
                            <td colspan="2"><?php echo $subject['units'] ?></td> 
                        </tr>
                        <?php
                            }
                    }
                 ?>
            </table>
        </div>
    </div>
</div>