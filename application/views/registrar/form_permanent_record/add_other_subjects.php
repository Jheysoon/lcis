<div class="modal fade" id="modal_add_subjects" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="/registrar/insert_subject" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel">Add Other School Subject</h3>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="legacyid" value="<?php echo $id ?>">
                    <label>Subject Code</label>
                    <input type="text" class="form-control" name="code" required>
                    <label>Descriptivetitle</label>
                    <input type="text" class="form-control" name="descriptivetitle" required>
                    <label>Units</label>
                    <input type="number" class="form-control" name="units" required>
                    <label>School</label>
                    <select name="school_id" class="form-control">
                    <?php
                        $sch = $this->party->college_school();

                        foreach ($sch as $s) {
                    ?>
                        <option value="<?php echo $s['id']; ?>"><?php echo $s['firstname']; ?></option>
                    <?php } ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
