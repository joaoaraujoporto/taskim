
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
		alert(data.code);
	    },
	    error: function() {
		alert("3");
	    }
	});

	window.location.replace('delete_task.php');
    });

    $("[name='edit_task']").click(function() {
	window.location.replace('/edit_task.php');
    });

    $("#sel_task_list").change(function() {
	$("[name='scheduled_time_cell']").html("nre");
	$("[name='spent_time_cell']").html("nre");
	$("[name='done_cell']").html("nre");
	$("[name='deadline_cell']").html("nre");
    });
			      
    
});
