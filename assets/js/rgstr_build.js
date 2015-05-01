/**
 * Created by josh-annie on 4/26/2015.
 */

$(document).ready(function(){
    var targerTr = '';

    add_subj();


    function add_subj()
    {
        $('.frm-add-subj').submit(function (e){
            $.post('/registrar/save_grade',$(this).serialize(),function (data){
                if(data == 'error')
                {
                    alert('Something went wrong');
                }
                else if(data == 'Subject Already exists')
                {
                    alert(data);
                }
                else
                {
                    $('#tbl'+targerTr).append(data);

                    $('.del_sub').on('click', function (e) {

                        if(confirm('Are you sure ?'))
                        {
                            val = $(this).attr('href');
                            $.post('/registrar/delete_record',{value:val},function (){

                            });
                            $(this).parent().parent().hide('500');
                        }
                        e.preventDefault();

                    });

                    $('select[name="edit_sub_grade"]').on('change', function () {
                        value = $(this).val();
                        $.post('/registrar/save_edit_grade',{val:value},function(data){

                        });
                    });

                }
                $('#myModal'+targerTr).modal('hide');
            });
            e.preventDefault();
        });
    }


    $('.modal-add-subj-grade').click(function(e){
        targerTr = $(this).attr('href');
        $('#myModal'+targerTr).modal('show');
        e.preventDefault();
    });

    $('select[name="edit_sub_grade"]').change(function(){
        value = $(this).val();
        $.post('/registrar/save_edit_grade',{val:value},function (data){
            if(data != '')
            {
                alert(data);
            }
        });
    });

    del_acam();

    function del_acam () {
        $('.delete_acam').click(function (e) {
            $sy = $(this).attr('params');
            if(confirm('Are you sure your want to delete \n'+$sy+' Academic Term ?'))
            {
                $eid = $(this).attr('href');
                $.post('/registrar/delete_acam',{eid:$eid},function (data) {

                });
                $param = $(this).attr('param');
                $('#' + $param).hide('500');
            }
            e.preventDefault();
        });
    }

    $('input[name=re-exam]').change(function (){
        $val = $(this).val();
        if($val == '1')
        {
            alert("not a valid grade");
        }
    });

    $('.del_sub').click(function(e){
        $subj = $(this).attr('param');

        if(confirm('Are you sure you want to delete '+$subj))
        {
            val = $(this).attr('href');
            $.post('/registrar/delete_record',{value:val},function(){

            });
            $(this).parent().parent().hide('500');
        }
        e.preventDefault();
    });

    $('#add_academicterm').click(function(){
       $('#modal_academicterm').modal('show');
    });

    $('#frm_add_academicterm').submit(function(e){
        $.post('/registrar/add_acam',$(this).serialize(),function (data){
            if(data == 'Academic Term Already Exists' || data == 'This record is already submitted')
            {
                alert(data);
            }
            else
            {
                $('#academic_wrapper').prepend(data);
                $('.modal-add-subj-grade').on('click',function (e){
                    targerTr = $(this).attr('href');
                    $('#myModal'+targerTr).modal('show');
                    e.preventDefault();
                });
            }
            
            add_subj();

            $('#modal_academicterm').modal('hide')
        });
        e.preventDefault();
    });
});