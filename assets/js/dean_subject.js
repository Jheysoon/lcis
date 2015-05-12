$(document).ready(function(){
	$('.delete_subject').click(function(e){
		val = $(this).data('param');
		subname = $(this).data('subjectname');
		if(confirm('Are you sure you want to delete '+subname))
		{
			$.post('/dean/delete_subject',{value:val},function(){

			});
			$(this).parent().parent().hide(800);
		}
		
		e.preventDefault();
	});
});