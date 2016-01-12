$(document).ready(function(){
	$('.delete_subject').click(function(e){
		var val = $(this).data('param');
		var subname = $(this).data('subjectname');
		if(confirm('Are you sure you want to delete '+subname))
		{
			$.post('/dean/delete_subject',{value:val},function(){

			});
			$(this).parent().parent().hide(800);
		}

		e.preventDefault();
	});

	var subject_list = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit:6,
        remote: '/dean/search_subject/%QUERY'
    });
    subject_list.initialize();
    //student_list.clearRemoteCache();
    $('#subject_search').typeahead(
        {
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'subject_list',
            displayKey: 'value',
            templates:{
                suggestion: Handlebars.compile('<a href="/edit_subject/{{id}}" class="search_link"><p style="padding: 0;">{{value}}</p>' +
                '<span>{{name}}</span></a>'),
                empty:['<div class="alert alert-danger">Unable to find subject</div>']
            },
            source: subject_list.ttAdapter()
        }
    );

    var studlist = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit:6,
        remote: '/dean/search_student_det/%QUERY'
    });
    studlist.initialize();
    //student_list.clearRemoteCache();
    $('#studentlist').typeahead(
        {
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'subject_list',
            displayKey: 'value',
            templates:{
                suggestion: Handlebars.compile('<p style="padding: 0;">{{value}}</p>' +
                '<span>{{name}}</span>'),
                empty:['<div class="alert alert-danger">Unable to find student</div>']
            },
            source: studlist.ttAdapter()
        }
    );

    $('#filter_sub').change(function(){
    	val = $(this).val();
    	$.post('/dean/load_sub',{value:val},function (data){
    		$('#subject_wrapper').html(data);
    	});
    });
});
