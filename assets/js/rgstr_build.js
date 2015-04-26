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
});