 $(document).ready(function(){
    // scroll to updates bottom on page display
    $('#update_inputs_div').scrollTop(1000000);


      // //SEARCH ALL PROJECTS
      // $('#search_panel').keyup(function(){
      //   var searchInput = $('#search_panel').val();
      //   //AJAX PROCESS TO SUBMIT
      //   $.ajax({
      //     method: "POST",
      //     url: "assets/ajax_search.php?<?=$project_id?>",
      //     data: {'searchText': searchInput},
      //     success: function(searchRes){
      //                 $('#projectlist_div').html(searchRes);
      //               }
      //   });
      // });
    
    //OPEN SELECT DIV FOR LINKS
    $('#option-icon').click(function(event){
        event.stopPropagation();
        document.getElementById("option-select").style.width = "200px";
    });

    //OPEN SELECT DIV FOR PROJECT INFO
    // $('#info-icon').click(function(event){
    //     event.stopPropagation();
    //     $('#info-select').slideToggle();
    // });

    $("#closesideBar").click(function(){
      document.getElementById("option-select").style.width = "0";
    })
    //CLOSE TOGLED DIVS 
    // $(document).click( function(){
    //       $('#info-select').hide();
    // });

    $(document).click( function(){
      $("#option-select").css('width', '0');
    });
    
    //Sending Updates to the Server with enter key
    // $('#update_input').keypress(function(e){
    //   if (e.keyCode === 13 && e.shiftKey === false) {
    //     var updateInput = $('#update_input').val();
    //     var prAddedBy = document.getElementById('pr_added_by').value;

    //     e.preventDefault();

    //     if (updateInput !== "") {
    //       $.ajax({
    //       type: "POST",
    //       url: "assets/ajax_submit.php?update=<?=$project_id?>",
    //       data: {
    //               'updInput': updateInput,
    //               'prAddBy': prAddedBy
    //             },
    //       success: function(res){
    //           if(res.status === 1){
    //             //remove text
    //             $('#update_input').val("");

    //             var update = "<li class='updates_elem'><div class='user-icon-div'><small class='updated_by'><p class='user-icon'>You</p></small><small class='ml-auto'><img class='arrow-down-icon' src='img/arrow-down-sign-to-navigate.svg'></small></div>"+updateInput+"<div class='date_div'><small class='updates_date margin-auto'>"+res.dateAdded+"</small><small class='updates_time ml-auto'>"+res.timeAdded+"</small></div></li>";

    //             //append text to UL
    //             $("#updates-ul").append(update);

    //             //scroll to bottom
    //             $('#update_inputs_div').scrollTop(1000000);
    //           }

    //           else{
    //             //do this
    //             console.log(res.msg);
    //           }              
    //       }
    //     });
    //   }
    //     e.preventDefault();
    //   }
    // });

    //Sending Updates to the Server
    // $("#update_btn").click(function(e){
    //   var updateInput = $('#update_input').val();
    //   var prAddedBy = document.getElementById('pr_added_by').value;

    //   e.preventDefault();
    //   if (updateInput !== "") {
    //       $.ajax({
    //       type: "POST",
    //       url: "assets/ajax_submit.php?update=<?=$project_id?>",
    //       data: {
    //               'updInput': updateInput,
    //               'prAddBy': prAddedBy
    //             },
    //       success: function(res){
    //           if(res.status === 1){
    //             //remove text
    //             $('#update_input').val("");

    //             var update = "<li class='updates_elem'><div class='user-icon-div'><small class='updated_by'><p class='user-icon'>You</p></small><small class='ml-auto'><img class='arrow-down-icon' src='img/arrow-down-sign-to-navigate.svg'></small></div>"+updateInput+"<div class='date_div'><small class='updates_date margin-auto'>"+res.dateAdded+"</small><small class='updates_time ml-auto'>"+res.timeAdded+"</small></div></li>";

    //             //append text to UL
    //             $("#updates-ul").append(update);

    //             //scroll to bottom
    //             $('#update_inputs_div').scrollTop(1000000);
    //           }

    //           else{
    //             //do this
    //             console.log(res.msg);
    //           }              
    //       }
    //     });
    //   }      
    // });

    // //ASSIGNING TASK TO PROJECT MEMBERS
    // $("#assign_project_btn").click(function(e){
    //   var assigneeName = $("#assignee_Name option:selected").text(); 
    //   var userID = $("#assignee_Name").val();
    //   var assigneeTask = $("#Assignee_Task").val();
    //   var startDate = $("#start_date").val();
    //   var feedbackDate = $("#pFeedBackDate").val();

    //   e.preventDefault();
    //   if (assigneeName !== "" && assigneeTask !== "" && startDate !== "" && feedbackDate !== "") {
    //       $.ajax({
    //       type: "POST",
    //       url: "assets/ajax_assign_task.php?update=<?=$project_id?>",
    //       data: {
    //               'user_id': userID,
    //               'assignee_task': assigneeTask,
    //               'date_start': startDate,
    //               'feedback_date': feedbackDate
    //             },
    //       success: function(res2){  
    //                 if(res2.queryStatus === 1){                    
    //                 //Remove text
    //                 $("#assignee_Name").val("Select");
    //                 $("#Assignee_Task").val("");
    //                 $("#start_date").val("");
    //                 $("#pFeedBackDate").val("");  
                    
    //                 //append text to UL
    //                 var assignee = "<li class='assign_li'><a href='#' style='color: black;'>"+assigneeName+"</a></li>";
    //                 $("#assigned-ul").prepend(assignee);
    //                 $("#no-task").html("");
    //               }
    //               else{
    //                   //do this
    //                   console.log(queryStatus.msg);
    //               }               
    //              }
    //     });
    //   }
    //       else{
    //         //DISPLAY ERROR MESSAGE
    //         $('.ass-errorMesss').css('display', 'block'); 
    //         $('.ass-errorMesss').html("<h5>Please fill the blanks</h5>");
    //       }
        
    // });

    ////OPEN MODAL FOR INFORMATION ON ASSIGNED TASK
    // $('#assigned-ul').on('click', '.assign_li', function(){
    //   var modal = document.getElementById('asignTaskModal');
    //   var span = document.getElementsByClassName("ass-close");
    //   $('#asignTaskModal').fadeToggle("slow", function(){
    //     $('.ass-modal-content').slideDown(5000);
    //   });


    //   $(span).click(function(){
    //       modal.style.display = "none"; 
    //   });

    //   window.onclick = function(event) {
    //     if (event.target == modal) {
    //         modal.style.display = "none";
    //     }
    //   }

    //   	var assignLink = document.getElementById("<?=$assign_task_id?>");
  		// var userID = $("#assignee_Name").val();
  		// alert(assignLink);
      	// $.ajax({
       //    type: "POST",
       //    url: "assets/ajax_get_member_task.php?update=<?=$project_id?>",
       //    data: {
       //               'task_id': assignLink     
       //          },
       //    success: function(taskRes){  
       //              //alert("You did well");
       //              if (taskRes.status === 1) {
       //              	alert("well done");
       //              }
       //            }
       //  });
      
   // });

    //GET PROJECT MEMBER TASK INFORMATION
    //   var assignLink = document.getElementById("<?=$assign_task_id?>");
    //   $(assignLink).click(function(){
  		// var userID = $("#assignee_Name").val();
  		// alert("success");
  		// var taskID = $("#<?=assign_task_id?>");
    //   	$.ajax({
    //       type: "POST",
    //       url: "assets/ajax_get_member_task.php?update=<?=$project_id?>",
    //       data: {
    //                  'user_ID': userId,
    //                  'task_id': assignLink     
    //             },
    //       success: function(res2){  
    //                 alert("You did well");
    //               }
    //     });
    //   });


    //NEXT BUTTON ON ASSIGNED TASKS FOR SUBMISSION
    $('#next-button').click(function() {
    	$('.ass-first-page').hide();
      $('.ass-next-page').show();
    });

    //BACK BUTTON ASSIGNED TASKS FOR SUBMISSION
    $('#back-button').click(function() {
    	$('.ass-next-page').hide();
      $('.ass-first-page').show();
    });

  //OPEN MODAL TO ADD MEMBER
    $('#add_member').click(function(e){
      $('#addMemberModal').fadeToggle("slow");
      var modal = document.getElementById('addMemberModal');
      var span = document.getElementsByClassName("ass-close");
      $(span).click(function(){
                $('#addMemberModal').css('display','none');
            });
            window.onclick = function(event) {
              if (event.target == modal) {
                  modal.style.display = "none";
              }
            }
    });

    //OPEN MODAL TO ADD MEMBER
    $('#add-plus-btn').click(function(e){
      $('#addMemberModal').fadeToggle("slow");
      var modal = document.getElementById('addMemberModal');
      var span = document.getElementsByClassName("ass-close");
      $(span).click(function(){
                $('#addMemberModal').css('display','none');
            });
            window.onclick = function(event) {
              if (event.target == modal) {
                  modal.style.display = "none";
              }
            }
    });


//     //ADD MEMBER TO PROJECT
//      $("#add-member").click(function(e){
        
//         var memberName = $('#member-name option:selected').text();
//         var userId = $('#member-name').val();

//       e.preventDefault();
//       if (memberName !== "") {
//           $.ajax({
//           type: "POST",
//           url: "assets/ajax_add_member.php?update=<?=$project_id?>",
//           data: {
//                      'user_ID': userId     
//                 },
//           success: function(res2){  
//                     if (res2.status === 1) {
//                       $("#member-name").val("Select");
//                       $('.mem-errorMesss').css('display', 'none');
//                       //APPEND TO MEMBERS LIST
//                       var addedMember = "<li class='member_li'>"+memberName+"</li>";
//                       $("#member-ul").prepend(addedMember);

//                       //APPEND TO SELECT OPTION
//                       var newMember = "<option value='"+userId+"'>"+memberName+"</option>";
//                       $('#assignee_Name').append(newMember);
//                       //REMOVE ERROR MESSAGE
//                       var error = $('.ass-errorMesss');
//                       if (error = true) {
//                         $('.ass-errorMesss').css('display', 'none'); 
//                         $('.ass-errorMesss').html("");  
//                       }
//                       //REMOVE THE NO MEMBER HEADLINE
//                       var noMember = $("#no-member");
//                       console.log($("#no-member"))
//                       if ($("#no-member")) {
//                          $("#no-member").empty();
//                       }
//                     } 

//                    else if (res2.err_status === 1) {
//                       $('.ass-errorMesss').css('display', 'block'); 
//                       $('.ass-errorMesss').html(res2.err_msg);
//                       $("#member-name").val("Select");
//                     }                
//                   }
//         });
//       }
//       else {
//             $('.mem-errorMesss').css('display', 'block'); 
//             $('.mem-errorMesss').html("<h5>Please Input Member Name</h5>");
//         }
        
//     });





    });