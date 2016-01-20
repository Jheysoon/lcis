<div class="col-md-3"></div>
<div class="col-md-9 body-container">
    <div class="panel p-body">
        <div class="panel-heading search">
            <h4><?php echo $user->firstname.' '.$user->lastname ?></h4>
        </div>
        <div class="panel-body">
            <form action="/useroption/add_menu_user" method="post">
                <input type="hidden" value="<?php echo $user->id ?>" name="user">
                <table class="table table-hover">
                    <tr>
                        <th></th>
                        <th>Option</th>
                    </tr>
                    <?php foreach ($options as $option) { ?>
                        <tr>
                            <td>
                                <input type="checkbox" value="<?php echo $option['id'] ?>" name="options[]"
                                    <?php
                                    foreach ($user_options as $user_option) {
                                        if ($user_option['optionid'] == $option['id']) {
                                            echo 'checked';
                                            break;
                                        }
                                    }
                                    ?>
                                >
                            </td>
                            <td>
                                <?php echo $option['desc'] ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <input type="submit" class="btn btn-primary pull-right" value="Add/Update Options">
            </form>
        </div>
    </div>
</div>
</div>