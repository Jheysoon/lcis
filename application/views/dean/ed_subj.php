<?php $office = $this->api->getUserOffice(); ?>
<div class="col-md-3"></div>
    <div class="col-md-9 body-container">

        <div class="panel p-body">
            <div class="panel-heading search">
                <h4>Subject</h4>
            </div>
            <div class="panel-body">

                <form class="form" method="post" action="/dean/save_subject" role="form">
                    <input type="hidden" name="sid" value="<?php echo set_value('sid'); ?>">
                    <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
                    <?php 
                        if(!empty($error)){
                            echo $error;
                        }
                    ?>
                    <div class="col-md-12">
                        <h3>Subject Form</h3>
                        <hr/>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group col-md-12">
                            <label for="subname">Code</label>
                            <input type="text" class="form-control" required autofocus value="<?php echo set_value('code'); ?>" name="code" placeholder="Code">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="title">Descriptive Title</label>
                            <input type="text" class="form-control" required name="title" value="<?php echo set_value('title'); ?>" placeholder="Descriptive Title">
                        </div>

                        <div class="form-group col-md-7">
                            <label for="shortname">Short Name</label>
                            <input type="text" class="form-control" value="<?php echo set_value('shortname'); ?>" name="shortname" placeholder="Shortname">
                        </div>

                        <div class="form-group col-md-5">
                            <label for="units">Units</label>
                            <input type="number" min="1" required value="<?php echo set_value('units'); ?>" class="form-control" name="units" placeholder="Units">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="hours">Hours</label>
                            <input type="number" min="1" required class="form-control" value="<?php echo set_value('hours'); ?>" name="hours" placeholder="Hours">
                        </div>
                        
                    </div>
                    
                    
                    <div class="col-md-6">
                        <?php if ($office != 3) { ?>

                        <div class="form-group col-md-6">
                            <label for="title">Major</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="major" value="1" <?php echo set_radio('major','1',TRUE); ?>>
                                    Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="major" value="0" <?php echo set_radio('major','0'); ?>>
                                    No
                                </label>
                            </div>
                        </div>
              
                        <div class="form-group col-md-6">
                            <label for="booklet">Booklet Charge</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="booklet" value="1" <?php echo set_radio('booklet','1',TRUE); ?>>
                                    Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="booklet" value="0" <?php echo set_radio('booklet','0'); ?>>
                                    No
                                </label>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="major">College</label>
                            <select class="form-control" name="owner">
                                <?php 
                                    $col = $this->college->all();
                                    
                                    foreach ($col as $college) {
                                ?>
                                    <option value="<?php echo $college['id']; ?>" <?php echo set_select('owner',$college['id']); ?>><?php echo $college['description']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="group">Group</label>
                            <select class="form-control" name="group">
                                <?php 
                                    $gr = $this->group->all();
                                    
                                    foreach ($gr as $g) {
                                ?>
                                    <option value="<?php echo $g['id']; ?>" <?php echo set_select('group',$g['id']); ?>><?php echo $g['description']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="title">Non Academic</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="academic" value="1" <?php echo set_radio('academic','1',TRUE); ?>>
                                    Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="academic" value="0" <?php echo set_radio('academic','0'); ?>>
                                    No
                                </label>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="title">GE Subject</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="ge" value="1" <?php echo set_radio('ge','1',TRUE); ?>>
                                    Yes
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="ge" value="0" <?php echo set_radio('ge','0'); ?>>
                                        No
                                    </label>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="title">Computer Subject</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="comp" value="1" <?php echo set_radio('comp','1',TRUE); ?>>
                                        Yes
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="comp" value="0" <?php echo set_radio('comp','0'); ?>>
                                        No
                                    </label>
                                </div>
                            </div>
                            
                            <?php } else { ?>
                                <div class="col-sm-12">
                                    <label>School</label>
                                    <select class="form-control" name="school">
                                        <?php 
                                            $s = $this->db->query("SELECT a.id AS id, firstname 
                                                    FROM tbl_party a, tbl_school b 
                                                    WHERE a.id = b.id 
                                                    AND b.tertiary = 1 
                                                    AND a.id != 1")->result();
                                            
                                            foreach ($s as $school) {
                                        ?>
                                            <option value="<?php echo $school->id ?>" <?php echo set_select('school', $school->id) ?>><?php echo $school->firstname ?></option>
                                        <?php } ?>
                                     </select>
                                </div>
                            <?php } ?>
                        </div>
                        
                        <div class="col-md-12">
                            <hr/>
                            <div class="col-md-12">
                                <button class="btn btn-primary pull-right" type="submit">Save</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>