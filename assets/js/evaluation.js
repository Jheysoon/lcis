$(document).ready(function(){
	removeSubject();
	
	$('#searchSubject').submit(function(){
	    $.post( "/dean/ajaxEvaluation", $( "#searchSubject" ).serialize(), function(data){
	    	data = $.trim(data);
	    	if (data == "error") {
	    		$('#div_eval').html('');
	    		$('#alert1').hide();
	    		$('#alert2').show();
	    		setTimeout("$('#alert2').hide();", 5000);
	    		setTimeout("$('#alert1').show();", 5000);
	    	}
	    	else{
	    		$('#alert1').show();
	    		$('#alert2').hide();
	    		$('#div_eval').html(data);
	    	}

	    } );
	});

	$('#modal-table').submit(function(){
	    $.post( "/dean/appendSubject", $( "#modal-table" ).serialize(), function(data){
	    	data = $.trim(data);
	    	if (data != '') {
		    	$('#tblAddSubject').append(data);
		    	$('#div_eval').html('');
		    	$('#addEvalSub').modal('hide');
				removeSubject();
	    	}
	    } );
	});


	$('#addEvalSub').on('hidden.bs.modal', function (e) {
		$('#div_eval').html('');
		$('#inputdata').val('');
	});

	function removeSubject(){
		$('.remove').on('click', function()
		{
			if (confirm('Are you sure you want to remove ' + $(this).data('param') + '?')) {
				$(this).parent().parent().remove();
			};
		});
	}

});
