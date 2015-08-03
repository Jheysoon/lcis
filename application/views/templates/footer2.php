
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

    <script>
        Webcam.set({
            width: 400,
            height: 300,
            dest_width: 640,
            dest_height: 480,
            image_format: 'jpeg',
            jpeg_quality: 90,
            force_flash: false
        });
        var v = 0;
        Webcam.attach('#pic_wrapper');
        $(document).ready(function(){
            $('#pre_take').click(function(e){
                val = $(this).val();
                Webcam.freeze();
                $('#cancel_pic').removeClass('hide');

                Webcamp.snap(function(data_uri){
                    var data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
                    $('input[name=pics]').val(data);
                });

                e.preventDefault();
            });
            $('#cancel_pic').click(function(e){
                Webcam.unfreeze();
                $(this).addClass('hide');
                e.preventDefault();
            });
        });
    </script>
  </body>
</html>
