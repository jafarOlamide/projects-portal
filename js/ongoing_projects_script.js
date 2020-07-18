//  $(document).ready(function(){
//     // scroll to updates bottom on page display
//     $('#update_inputs_div').scrollTop(1000000);


//       //SEARCH ALL PROJECTS
//       $('#search_panel').keyup(function(){
//         var searchInput = $('#search_panel').val();
//         //AJAX PROCESS TO SUBMIT
//         $.ajax({
//           method: "POST",
//           url: "assets/ajax_search.php?<?=$project_id?>",
//           data: {'searchText': searchInput},
//           success: function(searchRes){
//                       $('#projectlist_div').html(searchRes);
//                     }
//         });
//       });
    
//     //OPEN SELECT DIV FOR LINKS
//     $('#option-icon').click(function(event){
//         event.stopPropagation();
//         document.getElementById("option-select").style.width = "200px";
//     });

//     //OPEN SELECT DIV FOR PROJECT INFO
//     // $('#info-icon').click(function(event){
//     //     event.stopPropagation();
//     //     $('#info-select').slideToggle();
//     // });

//     $("#closesideBar").click(function(){
//       document.getElementById("option-select").style.width = "0";
//     })
//     //CLOSE TOGLED DIVS 
//     // $(document).click( function(){
//     //       $('#info-select').hide();
//     // });

//     $(document).click( function(){
//       $("#option-select").css('width', '0');
//     });
    

//   //CLOSE/FINISH PROJECT
//   $("#closeprojectbtn").click(function(){
//     var projectID = $("#closeprojectbtn").attr("name");
//     if (confirm("Are you sure you want to close this project, this cannot be undone!")) {
//                 $.ajax({
//                           type: "POST",
//                           url: "assets/ajax_close_project.php",
//                           data: {
//                                   'proj_id': projectID
//                                 },
//                           success: function(res){
//                             if (res.status == 1) {
//                                 //location = "ongoing_projects.php";
//                             }
//                           }
//                         });
//     } else {
//       return false;
//     }
//   });


// //DELETE UPDATE
// $('#updates-ul').on('click', '.delUpdBtn', function(e){
//   var projectMemberId = $(this).attr("name");
//   $.ajax({
//           type: "POST",
//           url: "assets/ajax_delete_update.php?update=<?=$project_id?>",
//           data: {
//                    'member_id': projectMemberId    
//                 },
//           success: function(removedRes){
//                     if (removedRes.status == 1) {
//                       var memberName = removedRes.memName;
//                       var spinMessage = "Removing "+memberName;
//                       $('#spinnerLabel').html(spinMessage);
//                        $("#warnMessage").css('color','red');
//                        var warningMessage = " "+memberName+" ";
//                        $("#warnMessage").html(warningMessage);
//                     }
//                   }
//       });
//   });

//   //PEND PROJECT
//   $("#pendprojectbtn").click(function(){
//     var projectID = $("#pendprojectbtn").attr("name");
//    if (confirm("ARE YOU SURE YOU WANT TO PEND THIS PROJECT")) {
//                $.ajax({
//                          type: "POST",
//                          url: "assets/ajax_pend_project.php",
//                          data: {
//                                  'proj_id': projectID
//                                },
//                          success: function(res){
//                            if (res.status == 1) {
//                                alert("Project Pended");
//                                location= "ongoing_projects.php";
//                            }
//                          }
//                        });
//    } else {
//      return false;
//    }
//  });

//  //Delete Project
//  $("#deleteprojectbtn").click(function(){
//   var projectID = $("#deleteprojectbtn").attr("name");
//   if (confirm("Are you sure you want to delete this project, this cannot be undone" +projectID)) {
//               $.ajax({
//                         type: "POST",
//                         url: "assets/ajax_delete_project.php",
//                         data: {
//                                 'proj_id': projectID
//                               },
//                         success: function(res){
//                           if (res.status == 1) {
//                               //location = "ongoing_projects.php";
//                           }
//                         }
//                       });
//   } else {
//     return false;
//   }
// });


// //Sending Updates to the database with enter key
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

//             var update = "<li class='updates_elem'><div class='user-icon-div'><small class='updated_by'><p class='user-icon'>You</p></small><small class='ml-auto' id='del-div'><button class='delUpdBtn' name='"+res.updateId+"'><img class='arrow-down-icon' src='img/recycling-bin-black.svg'></button></small></div>"+updateInput+"<div class='date_div'><small class='updates_date margin-auto'>"+res.dateAdded+"</small><small class='updates_time ml-auto'>"+res.timeAdded+"</small></div></li>";

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

// //Sending Updates to the DATABASE
// $("#update_btn").click(function(e){
//   var updateInput = $('#update_input').val();
//   var prAddedBy = document.getElementById('pr_added_by').value;

//   e.preventDefault();
//   if (updateInput !== "") {
//       $.ajax({
//       type: "POST",
//       url: "../assets/ajax_submit.php?update=<?=$project_id?>",
//       data: {
//               'updInput': updateInput,
//               'prAddBy': prAddedBy
//             },
//       success: function(res){
//           if(res.status === 1){
//             //remove text
//             console.log("success");
//             $('#update_input').val("");

//             var update = "<li class='updates_elem'><div class='user-icon-div'><small class='updated_by'><p class='user-icon'>You</p></small><small class='ml-auto' id='del-div'><button class='delUpdBtn' name='"+res.updateId+"'><img class='arrow-down-icon' src='img/recycling-bin-black.svg'></button></small></div>"+updateInput+"<div class='date_div'><small class='updates_date margin-auto'>"+res.dateAdded+"</small><small class='updates_time ml-auto'>"+res.timeAdded+"</small></div></li>";

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

//     //NEXT BUTTON ON ASSIGNED TASKS FOR SUBMISSION
//     $('#next-button').click(function() {
//     	$('.ass-first-page').hide();
//       $('.ass-next-page').show();
//     });

//     //BACK BUTTON ASSIGNED TASKS FOR SUBMISSION
//     $('#back-button').click(function() {
//     	$('.ass-next-page').hide();
//       $('.ass-first-page').show();
//     });

//   //OPEN MODAL TO ADD MEMBER
//     $('#add_member').click(function(e){
//       $('#addMemberModal').fadeToggle("slow");
//       var modal = document.getElementById('addMemberModal');
//       var span = document.getElementsByClassName("ass-close");
//       $(span).click(function(){
//                 $('#addMemberModal').css('display','none');
//             });
//             window.onclick = function(event) {
//               if (event.target == modal) {
//                   modal.style.display = "none";
//               }
//             }
//     });

//     //OPEN MODAL TO ADD MEMBER
//     $('#add-plus-btn').click(function(e){
//       $('#addMemberModal').fadeToggle("slow");
//       var modal = document.getElementById('addMemberModal');
//       var span = document.getElementsByClassName("ass-close");
//       $(span).click(function(){
//                 $('#addMemberModal').css('display','none');
//             });
//             window.onclick = function(event) {
//               if (event.target == modal) {
//                   modal.style.display = "none";
//               }
//             }
//     });

//     //ASSIGNING TASK TO PROJECT MEMBERS
//     $("#assign_project_btn").click(function(e){
//       var assigneeName = $("#assignee_Name option:selected").text(); 
//       var userID = $("#assignee_Name").val();
//       var assigneeTask = $("#Assignee_Task").val();
//       var startDate = $("#start_date").val();
//       var feedbackDate = $("#pFeedBackDate").val();

//       e.preventDefault();
//       if (assigneeName !== "" && assigneeTask !== "" && startDate !== "" && feedbackDate !== "") {
//           $.ajax({
//           type: "POST",
//           url: "assets/ajax_assign_task.php?update=<?=$project_id?>",
//           data: {
//                   'user_id': userID,
//                   'assignee_task': assigneeTask,
//                   'date_start': startDate,
//                   'feedback_date': feedbackDate
//                 },
//           success: function(res2){  
//                     $('.assignSpinner').show();
//                       setTimeout(function(){  
//                         $('#assSpinnerLabel').html("Sending Mail.....");
//                         _this.parent().remove();
//                       }, 1500);
//                     if(res2.queryStatus === 1){                    
//                     //Remove text
//                     $("#assignee_Name").val("Select");
//                     $("#Assignee_Task").val("");
//                     $("#start_date").val("");
//                     $("#pFeedBackDate").val("");

//                     var new_proj_id = res2.new_id; 
                    
//                       setTimeout(function(){  
//                         $('#assSpinnerLabel').html("Task Assigned and mail sent!");
//                         $('#spinnerAss').hide();
//                         _this.parent().remove();
//                       }, 2500);
//                       setTimeout(function(){
//                         $('.assignSpinner').hide();
//                         $('#assSpinnerLabel').html("Assigning....");
//                         $('#spinnerAss').show();
//                       }, 7000);
//                     //append text to UL
//                     var assignee = "<li class='assign_li' name='"+new_proj_id+"'><a href='#' style='color: black;'>"+assigneeTask+"</a></li>";
//                     $("#assigned-ul").prepend(assignee);
//                     $("#no-task").html("");
//                   }
//                   else{
//                       //do this
//                       console.log(res2.queryMsg);
//                   }               
//                  }
//         });
//       }
//           else{
//             //DISPLAY ERROR MESSAGE
//             $('.ass-errorMesss').css('display', 'block'); 
//             $('.ass-errorMesss').html("<h5>Please fill the blanks</h5>");
//           }
        
//     });

//     // //OPEN MODAL FOR INFORMATION ON ASSIGNED TASK
//     $('#assigned-ul').on('click', '.assign_li', function(e){
//       var modal = document.getElementById('asignTaskModal');
//       var span = document.getElementsByClassName("ass-close");
//       $('#asignTaskModal').fadeToggle("slow", function(){
//         $('.ass-modal-content').slideDown(5000);
//       });


//       $(span).click(function(){
//           modal.style.display = "none"; 
//       });

//       window.onclick = function(event) {
//         if (event.target == modal) {
//             modal.style.display = "none";
//         }
//       }
//         //GET INFORMATION ON ASSIGNED TASK
//         var assignLink = $(this).attr("name");
//         $.ajax({
//           type: "POST",
//           url: "assets/ajax_get_member_task.php?update=<?=$project_id?>",
//           data: {
//                      'task_id': assignLink     
//                 },
//           success: function(taskRes){                        
//                     if (taskRes.status === 1) {
//                       $("#assignee-name").html(taskRes.assigneeName);
//                       $("#task-details").html(taskRes.Task);
//                       $("#assigned-date").html(taskRes.task_assigned_date);
//                       $("#start-date").html(taskRes.task_start_date);
//                       $("#end-date").html(taskRes.task_completion_date);
//                       $("#task-status").html(taskRes.task_status);

//                       if (taskRes.task_status === "Completed") {
//                         $("#finish-div").hide();
//                         $("#task-status").html("Completed").css('color', 'green');
//                       }
//                       else if (taskRes.task_status === "Incomplete") {
//                         $("#finish-div").show();
//                         $("#task-status").html(taskRes.task_status).css('color', '#8B0000');
//                       }
//                     }
                    
//                  }
//         });
      

//     });

// //COMPLETE TASK BUTTON
// $('#assigned-ul').on('click', '.assign_li', function(e){
//     var nassignLink = $(this).attr("name");
//     // console.log(nassignLink);
//       $("#task_completed_btn").click(function(){
        
//         var taskStatus = $("#task-status").html();
//         console.log(taskStatus);

//         if (taskStatus === "Incomplete") {
//             $.ajax({
//             type: "POST",
//             url: "assets/ajax_complete_task.php?update=<?=$project_id?>",
//             data: {
//                        'task_id': nassignLink     
//                   },
//             success: function(completeRes){  
//                       // console.log("Action Successful");
//                       $("#task-status").html("Completed").css('color', 'green');
//                       $("#finish-div").hide();
//                     }
//           });
//         } else {
//           alert("error");
//         }
//       });
// });

//     //ADD MEMBER TO PROJECT
//      $("#add-member").click(function(e){
        
//         var memberName = $('#member-name option:selected').text();
//         var userId = $('#member-name').val();
//         var memberRole = $('#member-role').val();
//       e.preventDefault();
//       if (memberName !== "") {
//           $.ajax({
//           type: "POST",
//           url: "assets/ajax_add_member.php?update=<?=$project_id?>",
//           data: {
//                      'user_ID': userId,
//                      'member_role': memberRole  
//                 },
//           success: function(res2){  
//                     if (res2.status === 1) {
                      
//                       $('.mem-errorMesss').css('display', 'none');
//                       //SPINNING BAR
//                       $('.assignProgress').show();
//                       setTimeout(function(){
//                         $("#member-name").val("Select");
//                         $("#member-role").val("Select");
//                         $('#spinnerAddMemLabel').html("Member Added!");
//                         $('#spinnerAddMem').hide();  
//                         //APPEND TO MEMBERS LIST
//                         memberRole = memberRole.toLowerCase();
//                         if (memberRole == 'admin') {
//                           memberRole = "Project Admin";
//                         }else{
//                           memberRole = " ";
//                         }
//                         memberId = res2.new_member; 
//                         var addedMember = "<li class='member_li' id='tryLi'><div class='row'>"+memberName+"<button type='button' class='btn ml-auto rem_mem_btn' data-toggle='modal' data-target='#memberDeleteModal' name='"+memberId+"'><img src='img/icons8-delete-thick.svg' class='icon-remove-mem' id='remove-member'></button></div><div class ='row' id='adminSpan'>"+memberRole+"</div></li>";
//                         $("#member-ul").prepend(addedMember);
//                       }, 2000);
//                       setTimeout(function(){
//                         $('.assignProgress').hide();
//                         $('#spinnerAddMemLabel').html("Adding...");
//                         $('#spinnerAddMem').show();
//                       }, 7000);
                      

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


//     //REMOVE MEMBER FROM PROJECT
//     $('#member-ul').on('click', '.rem_mem_btn', function(e){
//       var projectMemberId = $(this).attr("name");
//       var _this = $(this);

//       $("#confirmRemoveMember").click(function(e){
//           $.ajax({
//               type: "POST",
//               url: "assets/ajax_remove_member.php?update=<?=$project_id?>",
//               data: {
//                        'member_id': projectMemberId    
//                     },
//               success: function(removeRes){
//                         if (removeRes.status == 1) {
//                           $('.removeSpinner').show();
//                           setTimeout(function(){  
//                             $('#spinnerLabel').html("Successfully Removed");
//                             $('#spinnerRem').hide();
//                             _this.parent().parent().remove();
//                           }, 2000);
//                         } 
//                         else{
//                           alert("error");
//                         }
//                       }
//           });
//       });
//       $('.removeSpinner').hide();
//       $('#spinnerRem').show();
//     });

//     //GET REMOVED MEMBER INFORMATION
//     $('#member-ul').on('click', '.rem_mem_btn', function(e){
//       var projectMemberId = $(this).attr("name");
//       $.ajax({
//               type: "POST",
//               url: "assets/ajax_get_remove_member.php?update=<?=$project_id?>",
//               data: {
//                        'member_id': projectMemberId    
//                     },
//               success: function(removedRes){
//                         if (removedRes.status == 1) {
//                           var memberName = removedRes.memName;
//                           var spinMessage = "Removing "+memberName;
//                           $('#spinnerLabel').html(spinMessage);
//                            $("#warnMessage").css('color','red');
//                            var warningMessage = " "+memberName+" ";
//                            $("#warnMessage").html(warningMessage);
//                         }
//                       }
//           });
//     });  
//   });