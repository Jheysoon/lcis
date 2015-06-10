/**
 * Created by Jayson Martinez on 4/24/2015.
 */
$(document).ready(function(){
    $('#change_sy_sem').click(function(){
        $('#modal_sy_sem').modal();
    });

    $('input[name="from_sy"]').change(function() {
        $val = $(this).val();
        $('input[name="to_sy"]').val(Number($val)+1);
    });
    $('#form_sy_sem').submit(function(e){
        $sy = $('input[name="from_sy"]').val();
        $sem = $('input[name="semester"]:checked').val();
        $.post('/main/setSy_session',{sy:$sy,sem:$sem},function(data){
            if(data != 'ok')
            {
                alert('Invalid School Year / Sem');
            }
            else
            {
                location.href='/';
            }
        });
        e.preventDefault();
    });
});



    function clickRow(cl, id, un){

        var ch;

        var counter = $('input[name=counter]').val()

        // counter = Number(counter) + Number(un);
        if ($('#radinput[name=rad-' + cl + ']').is(':checked')) {
            $('#rad-' + id)[0].checked = false;
            // counter = Number($('input[name=counter]').val()) + Number(un);
        }

        if ($('input[name=rad-' + cl + ']').is(':checked')) {
            $('#rad-' + id)[0].checked = false;
            // counter = Number($('input[name=counter]').val()) + Number(un);
        }
        else{
            $('#rad-' + id)[0].checked = true;
        }

        // if(counter > 24){
        //     alert('sobra na');
        // }
        // else{
        //     $('input[name=counter]').val(counter);
        // }

       
    }