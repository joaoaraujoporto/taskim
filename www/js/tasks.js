function update_task_info(task_data) {
    $("[name='scheduled_time_cell']").html(data.scheduled_time);
    $("[name='spent_time_cell']").html(data.spent_time);
    $("[name='done_cell']").html(data.done.toString());
    $("[name='deadline_cell']").html(data.deadline);
    
    if (data.working)
	$("[name=''change_task_work]").html("stop");
}


$(document).ready(function() {
    $("[name='new_task']").click(function() {
	window.location.replace('/new_task.php');
    });

    $("[name='delete_task']").click(function() {
	var id_task = $("#sel_task_list").val();
		
	$.ajax({
	    type: 'post',
	    url: 'delete_task.php',
	    data: 'id_task='+id_task,
	    success: function(response) {
		var data = JSON.parse(response);

		if (data.code == 200)
		    alert("Task deleted successfully"); // TODO put message in HTML
		else
		    alert("Error: try again later"); // logically unreachable

		window.location.replace('tasks.php');
	    },
	    error: function() {
		alert("Error: Probleme in server. Try again later.");
	    }
	});
    });

    $("[name='edit_task']").click(function() {
	window.location.replace('edit_task.php');
    });

    $("#sel_task_list").change(function() {
	var id_task = $("#sel_task_list").val();
	
	$.ajax({
	    type: 'post',
	    url: 'change_task_selected.php',
	    data: 'id_task='+id_task,
	    success: function(response) {
		var data = $.parseJSON(response);
		
		$("[name='scheduled_time_cell']").html(data.scheduled_time);
		$("[name='spent_time_cell']").html(data.spent_time);
		$("[name='done_cell']").html(data.done.toString());
		$("[name='deadline_cell']").html(data.deadline);

		if (data.working)
		    $("[name='change_task_work']").html("stop");
	    },
	    error: function(response) {
		alert("Error: Problem in server. Try again later.");
	    }
	});
    });

    $("[name='change_task_work']").click(function() {
	var data = {};
	
	data['id_task'] = $("#sel_task_list").val();
	data['timestamp'] = new Date($.now());
	
	$.ajax({
	    type: 'post',
	    url: 'change_task_work.php',
	    data: data,
	    success: function(response) {
		console.log(response);
		var data = JSON.parse(response);
		update_task_info(data);

		console.log(response);
		/*
		if (data.code == 200)
		    alert("Task deleted successfully"); // TODO put message in HTML
		else
		    alert("Error: try again later"); // logically unreachable
		    */
		
	    },
	    error: function() {
		alert("Error: Problem in server. Try again later.");
	    }
	})
    });
});
