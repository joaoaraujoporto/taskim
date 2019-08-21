function update_task_info(task_data) {
    $("[name='scheduled_time_cell']").html(task_data.scheduled_time);
    $("[name='spent_time_cell']").html(task_data.spent_time);
    $("[name='done_cell']").html(task_data.done.toString());
    $("[name='deadline_cell']").html(task_data.deadline);
    
    if (task_data.working)
	$("[name='change_task_work']").html("stop");
    else
	$("[name='change_task_work']").html("start");
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
		update_task_info(data);
	    },
	    error: function(response) {
		alert("Error: Problem in server. Try again later.");
	    }
	});
    });

    $("[name='change_task_work']").click(function() {
	var data = {};
	
	data['id_task'] = $("#sel_task_list").val().toString();
	data['timestamp'] = new Date().getTime();
	
	$.ajax({
	    type: 'post',
	    url: 'change_task_work.php',
	    data: data,
	    success: function(response) {
		var data = JSON.parse(response);
		update_task_info(data);		
	    },
	    error: function() {
		alert("Error: Problem in server. Try again later.");
	    }
	})
    });
});
