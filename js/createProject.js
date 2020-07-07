$(document).ready(function(){
	$('#createProject').click(function () {
		var projectTitle = $("#projectTitle").val();
		var projectOwner = $("#projectOwner").val();

		var projectStartDate = $("#pStartDate").val();
		var projectDueDate = $("#pDueDate").val();

		var projectStakeholder = $("#projectStakeholder").val();
		var projectDescription = $("#projectDescription").val();

		$.ajax({
			method: "POST",
			url: 	"assets/ajax_create_project.php",
			data: 	{
						'project_title': projectTitle,
						'project_owner': projectOwner,
						'project_start_date': projectStartDate,
						'project_due_date': projectDueDate,
						'project_stakeholder': projectStakeholder,
						'project_description': projectDescription
					},
			success: function(res){
						console.log(res);
					 } 			
		});
	});
});
