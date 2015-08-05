
        <div class="row footer hidden-print">
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
    <script src="/assets/js/webcam.js"></script>
    <!-- =============================================================================== -->
    <?php
        $r = explode('/', uri_string());
        if(in_array('take_photo', $r)){ ?>
    <script>
        Webcam.set({
            width: 400,
            height: 300,
            dest_width: 400,
            dest_height: 300,
            image_format: 'jpg',
            jpeg_quality: 90,
            force_flash: false
        });
        Webcam.attach('#pic_wrapper');
        $(document).ready(function(){
            $('#pre_take').click(function(e){
                Webcam.freeze();
                $('#cancel_pic').removeClass('hide');
                $(this).addClass('hide');
                $('#save').removeClass('hide');
                // Webcamp.snap(function(data_uri){
                //     var data =
                //     $('input[name=pics]').val(data);
                //     e.preventDefault();
                // });

                e.preventDefault();
            });
            $('#save').click(function(){
                Webcam.snap( function(data_uri) {
                    $('#image').val(data_uri.replace(/^data\:image\/\w+\;base64\,/, ''));
                    $('#form_image').submit();
			    });
            });
            $('#cancel_pic').click(function(e){
                Webcam.unfreeze();
                $(this).addClass('hide');
                e.preventDefault();
            });
        });
    </script>
    <?php } ?>
  </body>
</html>
