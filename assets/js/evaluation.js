$(document).ready(function(){
	removeSubject();

	$('#searchSubject').submit(function(){
		$('#prog').show();
	    $.post( "/dean/ajaxEvaluation", $( "#searchSubject" ).serialize(), function(data){
	    	data = $.trim(data);
	    	if (data == "error") {
	    		$('#div_eval').html('');
				$('#prog').hide();
	    		$('#alert1').hide();
	    		$('#alert2').show();
	    		setTimeout("$('#alert2').hide();", 5000);
	    		setTimeout("$('#alert1').show();", 5000);
	    	}
	    	else{
	    		$('#alert1').show();
	    		$('#alert2').hide();
				$('#prog').hide();
	    		$('#div_eval').html(data);
				view_sched();
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
		$('#prog').hide();
	});

	function view_sched(){
		$('.view_sched').on('click', function()
		{
			$('#prog').hide();
			var subject = $(this).data('subject');
			var term = $(this).data('term');
		    $.post( "/dean/ajaxSched", {subject, term}, function(data){
		    	data = $.trim(data);
		    	if (data == "error") {
		    		$('#div_eval').html('');
					$('#prog').hide();
		    	}
		    	else{
					$('#prog').hide();
		    		$('#div_eval').html(data);
		    	}

		    } );
		});
	}

	function removeSubject(){
		$('.remove').on('click', function()
		{
			if (confirm('Are you sure you want to remove ' + $(this).data('param') + '?')) {
				$(this).parent().parent().remove();
			};
		});
	}

});
