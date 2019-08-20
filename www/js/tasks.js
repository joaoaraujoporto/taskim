
$(document).ready(function() {
    $("[name='new_task']").click(function() {
	window.location.replace('/new_task.php');
    });

    $("[name='delete_task']").click(function() {
	var id_task = $("#sel_task_list").val();

	var data = {};
	data['id_task'] = $("#sel_task_list").val();
	
	$.ajax({
	    type: 'post',
	    url: 'delete_task.php',
	    data: 'id_task='+id_task,
	    success: function(data) {
		alert(data);
	    },
	    error: function() {
		alert("3");
	    }
	});
    });

    $("[name='edit_task']").click(function() {
	window.location.replace('/edit_task.php');
    });

    $("#sel_task_list").change(function() {
	// alert($("#sel_task_list").val());

	var id_task = $("#sel_task_list").val();
	
	$.ajax({
	    type: 'post',
	    url: 'tasks.php',
	    contentType: 'application/json', 
	    data: 'id_task='+id_task,
	    success: function(data) {
		$("[name='scheduled_time_cell']").html(data.scheduled_time);
		$("[name='spent_time_cell']").html(data.spent_time);
		$("[name='done_cell']").html(data.done);
		$("[name='deadline_cell']").html(data.deadline);
		alert(data);
	    },
	    error: function(data) {
		alert(data);
	    }
	});	
    });
			      
    
});
