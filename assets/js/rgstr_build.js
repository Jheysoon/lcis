/**
 * Created by josh-annie on 4/26/2015.
 */

$(document).ready(function(){
    var targerTr = '';

    $('.frm-add-subj').submit(function(e){
        $.post('/registrar/save_grade',$(this).serialize(),function(data){
            if(data == 'error')
            {
                alert('Something went wrong');
            }
            else
            {
                $('#tbl'+targerTr).append(data);
            }
            $('#myModal'+targerTr).modal('hide');
        });
        e.preventDefault();
    });

    $('.modal-add-subj-grade').click(function(e){
        targerTr = $(this).attr('href');
        $('#myModal'+targerTr).modal('show');
        e.preventDefault();
    });

    $('select[name="edit_sub_grade"]').change(function(){
        value = $(this).val();
        $.post('/registrar/save_edit_grade',{val:value},function(data){

        });
    });

    $('.del_sub').click(function(e){

        if(confirm('Are you sure ?'))
        {
            val = $(this).attr('href');
            $.post('/registrar/delete_record',{value:val},function(){

            });
            $(this).parent().parent().hide('500');
        }
        e.preventDefault();
    });
});