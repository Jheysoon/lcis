<div class="modal fade" id="modal_sy_sem">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <form action="sy_sem" id="form_sy_sem">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">School Year &amp; Sem Settings</h3>
                </div>
                <div class="modal-body">
                    <p>
                        <div class="col-sm-6">
                            <input type="number" name="from_sy" max="2015" min="1999" class="form-control" placeholder="To" value="2014">
                        </div>

                        <div class="col-sm-6">
                            <input type="text" name="to_sy" readonly value="2015" class="form-control" placeholder="From">
                        </div>

                        <div class="form-group center-block" style="width: 150px;">
                            <label style="margin: 5px -10px;">Semester</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="semester" value="1" checked>
                                    First Semester
                                </label>
                            </div>

                            <div class="radio">
                                <label>
                                    <input type="radio" name="semester" value="2">
                                    Second Semester
                                </label>
                            </div>

                            <div class="radio">
                                <label>
                                    <input type="radio" name="semester" value="3">
                                    Summer
                                </label>
                            </div>
                        </div>
                    </p>
                    <span class="clearfix"></span>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
