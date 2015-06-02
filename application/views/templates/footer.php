
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
    <script src="<?php echo base_url('assets/js/jasny-bootstrap.min.js'); ?>"></script>
     <!--<script src="<?php /*echo base_url('assets/js/validation.js'); */?>"></script>-->
    <!-- =============================================================================== -->

    <script src="/assets/js/home.js"></script>

        <?php
            $str = current_url();
            $str1 = explode('/',$str);
            if(in_array('rgstr_build',$str1))
            {
                ?>
                <script src="/assets/js/rgstr_build.js"></script>
        <?php
            }
            if(in_array('registrar-student_list',$str1))
            {
                ?>
            <script src="/assets/js/typeahead.bundle.js"></script>
            <script src="/assets/js/handlebars-v3.0.1.js"></script>
            <script src="/assets/js/buildup_permanent_record.js"></script>

        <?php
            }
            if(uri_string() == 'menu/dean-subject_list')
            {
                ?>
                <script src="/assets/js/typeahead.bundle.js"></script>
                <script src="/assets/js/handlebars-v3.0.1.js"></script>
                <script type="text/javascript" src="/assets/js/dean_subject.js"></script>
        <?php
            }
            if(uri_string() == 'menu/edp-studentStat')
            {
                ?>
                <script type="text/javascript">
                    $(document).ready(function(){
                        /*val = $('input[name=chkAcam]').val();
                        if(val < 1)
                        {*/
                            $.post('/edp/load_stat',{},function (data){
                                $('#stat_wrapper').html(data);
                            });
                        /*}
                        else
                        {
                            $('#stat_wrapper').html('<div class="alert alert-info">Already have a student statistics</div>');
                        }*/
                    });
                </script>
        <?php
            }
            if(uri_string() == 'menu/dean-manage_section')
            {
                ?>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('.addClassAllocation').submit(function (e){
                            $.post('/dean/addClassAlloc',$(this).serialize(),function(data){
                                
                            });
                            //$(this).parent().hide('1000');
                            e.preventDefault();
                        });
                    });
                </script>
        <?php
            }
        ?>

        <?php
            if(uri_string() == 'menu/dean-studentlist')
            {
                ?>
                <script src="/assets/js/typeahead.bundle.js"></script>
                <script src="/assets/js/handlebars-v3.0.1.js"></script>
                <script type="text/javascript" src="/assets/js/dean_subject.js"></script>
        <?php
            }
        ?>
        <?php 
                if (uri_string() == 'menu/scholarship-scholarshiplist') { ?>
                       <script src="/assets/js/typeahead.bundle.js"></script>
                        <script src="/assets/js/handlebars-v3.0.1.js"></script>
                        <script type="text/javascript">
                           /**
 * Created by Jayson Martinez on 4/24/2015.
 */
$(document).ready(function(){

    var student_list = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit:8,
        remote: '/registrar/search_by_id/%QUERY'
    });
    student_list.initialize();
    //student_list.clearRemoteCache();
    $('#student_search').typeahead(
        {
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'student_list',
            displayKey: 'value',
            templates:{
                suggestion: Handlebars.compile('<p style="padding: 0;">{{value}}</p>' +
                '<span>{{name}}</span>'),
                empty:['<div class="alert alert-danger">Unable to find student</div>']
            },
            source: student_list.ttAdapter()
        }
    );
  
});
                        </script>
               <?php }
         ?>
  </body>
</html>