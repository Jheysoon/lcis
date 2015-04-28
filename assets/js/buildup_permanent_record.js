/**
 * Created by Jayson Martinez on 4/24/2015.
 */
$(document).ready(function(){

    var student_list = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: '/registrar/search_by_id/%QUERY'
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
                '<span>{{name}}</span>'),
                empty:['<div class="alert alert-danger">Unable to find student id</div>']
            },
            source: student_list.ttAdapter()
        }
    );
    $('#status').change(function(){
        val = $(this).val();
        param1 = $('input[name="param"]').val();
        $.post('/registrar/add_session',{value:val,param:param1},function(data){
            $('#studlist_wrapper').html(data);
        });
    });
});