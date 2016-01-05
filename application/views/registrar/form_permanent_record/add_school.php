<div class="modal fade" id="modal_add_schools" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="/registrar/add_school" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel">Add Schools</h3>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="legacyid" value="<?php echo $id ?>">
                    <label>School Name</label>
                    <input type="text" class="form-control" name="name" required>
                    <label>Shortname</label>
                    <input type="text" class="form-control" name="short_name" required>
                    <label>Address</label>
                    <input type="text" class="form-control" name="address" required>
                    <label>Registrars Name</label>
                    <input type="text" class="form-control" name="registrar_name" required>

                    <fieldset>
                        <label style="border-bottom:1px solid #e5e5e5;width:100%;">School Level/s</label>


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="checkbox">
                                    <label>
                                      <input type="checkbox" id="blankCheckbox" name='lvl1' value="1">
                                      Primary &nbsp;&nbsp;&nbsp;&nbsp;
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="checkbox">
                                    <label>
                                      <input type="checkbox" id="blankCheckbox" name='lvl2' value="1">
                                      Elementary &nbsp;&nbsp;&nbsp;&nbsp;
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="checkbox">
                                    <label>
                                      <input type="checkbox" id="blankCheckbox" name='lvl3' value="1">
                                      Secondary &nbsp;&nbsp;&nbsp;&nbsp;
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="checkbox">
                                    <label>
                                      <input type="checkbox" id="blankCheckbox" name='lvl4' value="1">
                                      Tertiary &nbsp;&nbsp;&nbsp;&nbsp;
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
