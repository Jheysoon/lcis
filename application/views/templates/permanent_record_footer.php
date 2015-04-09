
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
<script src="/assets/js/typeahead.bundle.js"></script>
<script src="/assets/js/handlebars-v3.0.1.js"></script>
<script>
    $(document).ready(function(){

        var student_list = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: '/registrar/search_by_id'
        });
        student_list.initialize();
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
                    '<span>(Name)</span>')
                },
                source: student_list.ttAdapter()
            }
        );
    });

</script>
<!-- =============================================================================== -->
</body>
</html>