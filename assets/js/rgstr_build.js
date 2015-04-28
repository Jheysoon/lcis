/**
 * Created by josh-annie on 4/26/2015.
 */

$(document).ready(function(){
    var targerTr = '';

    add_subj();


    function add_subj()
    {
        $('.frm-add-subj').submit(function(e){
            $.post('/registrar/save_grade',$(this).serialize(),function(data){
                if(data == 'error')
                {
                    alert('Something went wrong');
                }
                else
                {
                    $('#tbl'+targerTr).append(data);

                    $('.del_sub').on('click', function (e) {

                        if(confirm('Are you sure ?'))
                        {
                            val = $(this).attr('href');
                            $.post('/registrar/delete_record',{value:val},function(){

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

    $('#add_academicterm').click(function(){
       $('#modal_academicterm').modal('show');
    });

    $('#frm_add_academicterm').submit(function(e){
        $.post('/registrar/add_acam',$(this).serialize(),function(data){
            $('#academic_wrapper').prepend(data);
            $('.modal-add-subj-grade').on('click',function(e){
                targerTr = $(this).attr('href');
                $('#myModal'+targerTr).modal('show');
                e.preventDefault();
            });
            
            add_subj();

            $('#modal_academicterm').modal('hide')
        });
        e.preventDefault();
    });
});