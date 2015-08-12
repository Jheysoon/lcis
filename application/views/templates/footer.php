
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
    <script src="<?php echo base_url('assets/js/jasny-bootstrap.min.js'); ?>"></script>
     <!--<script src="<?php /*echo base_url('assets/js/validation.js'); */?>"></script>-->
    <!-- =============================================================================== -->

    <script src="/assets/js/home.js"></script>
    <script src="<?php echo base_url('assets/js/evaluation.js'); ?>"></script>

        <?php
            $str = current_url();
            $str1 = explode('/',$str);
            if(in_array('rgstr_build',$str1))
            {
                ?>
                <script src="/assets/js/typeahead.bundle.js"></script>
                 <script src="/assets/js/handlebars-v3.0.1.js"></script>
                <script src="/assets/js/rgstr_build.js"></script>
        <?php
            }
            if(in_array('registrar-student_list',$str1) OR in_array('registrar-update_student', $str1)
                OR in_array('registrar-shift_student', $str1))
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
                        $('input[name=btnYes]').click(function (e){
                            $('#confirmBox').hide();
                            $('#stat_wrapper').removeClass('hide');
                            $.post('/edp/load_stat',{},function (data){
                                if(data == 'Not final')
                                {
                                    alert('Phase term is not final');
                                    $('#confirmBox').show();
                                    $('#stat_wrapper').addClass('hide');
                                }
                                else
                                {
                                    $('#stat_wrapper').html(data);
                                }
                            });
                        });
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
                            $.post('/dean/addClassAlloc1',$(this).serialize(),function(data){
                                alert('Successfully Updated');
                            });
                            e.preventDefault();
                        });
                    });
                </script>
        <?php
            }
        ?>

        <?php
            if(in_array('dean-studentlist', $str1))
            {
                ?>
                <script src="/assets/js/typeahead.bundle.js"></script>
                <script src="/assets/js/handlebars-v3.0.1.js"></script>
                <script type="text/javascript" src="/assets/js/dean_subject.js"></script>
        <?php
            }
            if(in_array('registrar-tor_studlist', $str1))
            {
                ?>
                <script src="/assets/js/typeahead.bundle.js"></script>
                <script src="/assets/js/handlebars-v3.0.1.js"></script>
                <script type="text/javascript" src="/assets/js/tor.js"></script>
        <?php
            }
            if(in_array('add_day_period', $str1) OR in_array('assign_room', $str1))
            {
                ?>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('select[name=days_count]').change(function(){
                            cid = $(this).val();
                            $.post('/dean/ajax_day_period',{cid:cid},function (data){
                                $('#table_day').html(data);
                            });
                        });
                    });
                </script>
        <?php
            }
            elseif(uri_string() == 'menu/edp-room_subj')
            {
        ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#sort_cl').change(function(){
                    cid = $(this).val();
                    $.post('/edp/sorting',{cid:cid},function(data){
                        $('#tbl_cl').html(data);
                    });
                });
            });
        </script>
        <?php
            }

                if (uri_string() == 'menu/scholarship-scholarshiplist' OR in_array('billing-list_billing', $str1)) { ?>
                       <script src="/assets/js/typeahead.bundle.js"></script>
                        <script src="/assets/js/handlebars-v3.0.1.js"></script>
                        <script type="text/javascript">
                            $(document).ready(function(){

                                var student_list = new Bloodhound({
                                    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
                                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                                    limit:8,
                                    remote: '/registrar/search_forpayment/%QUERY'
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
             if (uri_string() == 'menu/audit-accountlist' OR in_array('billing-list_billing', $str1)) { ?>
                      <script src="/assets/js/typeahead.bundle.js"></script>
                       <script src="/assets/js/handlebars-v3.0.1.js"></script>
                       <script type="text/javascript">
                           $(document).ready(function(){

                               var student_list = new Bloodhound({
                                   datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
                                   queryTokenizer: Bloodhound.tokenizers.whitespace,
                                   limit:8,
                                   remote: '/cashier/searchstud/%QUERY'
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
              <?php } ?>
              <script>
                      $(document).ready(function(){
                            $('')

                      });

              </script>

  </body>
</html>
