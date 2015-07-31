$(document).ready(function(){

    var studlist = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit:6,
        remote: '/registrar/search_student_det/%QUERY'
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
                empty:['<div class="alert alert-danger">Unable to find subject</div>']
            },
            source: studlist.ttAdapter()
        }
    );
});
