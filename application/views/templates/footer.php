
        <div class="row footer">
          <div class="col-md-12">
            <label class="text-center">
            <a class="foot-link" href="http://www.leytecolleges.edu.ph" target="blank">www.leytecolleges.edu.ph</a> |
            &copy <?php echo date('Y'); ?> |
            All Rights Reserved <?php echo date('Y'); ?>
            </label>
          </div>
        </div>    
    </div>

    <!-- ============================ javascript library =============================== -->
    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/docs.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/validation.js'); ?>"></script>
    <!-- =============================================================================== -->

    <script src="/assets/js/home.js"></script>

        <?php
            $str = current_url();
            $str = explode('/',$str);
            if(in_array('registrar-student_list',$str))
            {
                ?>
    <script src="/assets/js/typeahead.bundle.js"></script>
    <script src="/assets/js/handlebars-v3.0.1.js"></script>
    <script src="/assets/js/buildup_permanent_record.js"></script>
        <?php
            }
        ?>
  </body>
</html>