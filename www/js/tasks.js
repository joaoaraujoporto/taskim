
$(document).ready(function() {
    $("[name='new_task']").click(function() {
	window.location.replace('/new_task.php');
    });

    $("[name='edit_task']").click(function() {
	window.location.replace('/edit_task.php');
    });
    
});
