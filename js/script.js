$(document).ready(function(){
///////////////////////PAGE: ADMINISTRATORS////////////////////////////////////////////
//SEARCH USERS
$("#search_users").keyup(function(){
  var searchText = $("#search_users").val();
  $.ajax({
          method: "POST",
          url: "assets/ajax_user_search.php",
          data: {'searchText': searchText},
          success: function(searchRes){
                          // var userID = searchRes.uid;
                          // var userEmail = searchRes.uEmail;
                          // var userFullName = searchRes.uFullName;

                          // var searchReturn = "<tr id='tr_"+userID+"'><td><input type='checkbox' name='"+userID+"'></td><td>"+userFullName+"</td><td>"+userEmail+"</td><td class='editTd'><button class='btn editBtn' name='"+userID+"'data-toggle='modal' data-target='#editUserModal'><img src='img/edit.svg' class='editImg'></button></td></tr>";

                          //$('#tUserBody').html(searchReturn);
                        $('#tUserBody').html(searchRes);                      
                    }
        });
});


///ADD NEW USER
$("#btnAddUser").click(function(){
 var userLastName =   $("#userLastName").val();
 var userFirstName =  $("#userFirstName").val();
 var userEmail =    $("#userEmail").val();
  console.log(userLastName);


 if (userLastName == "" && userFirstName == "" && userEmail == "") {
  $(".addUser-errorMesss").html("Please Fill Input Fields");
  $(".addUser-errorMesss").show();
 } else if (userFirstName == "") {
  $(".addUser-errorMesss").html("Please Input  user Last Name");
  $(".addUser-errorMesss").show();
 }
 else if (userEmail == "") {
  $(".addUser-errorMesss").html("Please Input  user Email");
  $(".addUser-errorMesss").show();
 }
 else if (userLastName == ""){
  $(".addUser-errorMesss").html("Please Input user First Name");
  $(".addUser-errorMesss").show();
 }
 else if (userLastName !== "" && userFirstName !== "" && userEmail !== "") {
  console.log(userLastName);

      $.ajax({
          type: "POST",
          url: "assets/ajax_add_user.php",
          data: {
                   'first_name': userFirstName,
                   'last_name': userLastName,
                   'email': userEmail 
                },
          success: function(addUserRes){
                    if (addUserRes.status == 1) {
                        $(".delUser-errorMesss").hide();
                        $('.addUser-errorMesss').css('display', 'none');
                         $('.addUserProgress').show();
                          
                          setTimeout(function(){  
                            $('#addUserSpinnerLabel').html("User Added");
                            $('#addUserSpinner').hide();
                            $("#userLastName").val("");
                            $("#userFirstName").val("");
                            $("#userEmail").val("");
                            var user = addUserRes.full_name;
                            var usermail = addUserRes.email;
                            var newUserId = addUserRes.uid;
                            var newRow = "<tr id='tr_"+newUserId+"'><td><input type='checkbox' name='"+newUserId+"'></td><td>"+user+"</td><td>"+usermail+"</td><td class='editTd'><button class='btn editBtn' name='<?php echo $user_id; ?>' data-toggle='modal' data-target='#editUserModal'><img src='img/edit.svg' class='editImg'></button></td></tr>";
                            $("#users-table").append(newRow);
                          }, 2000);

                          setTimeout(function(){ 
                            $('.addUserProgress').hide();
                            $('#addUserSpinnerLabel').html("Adding User....");
                            $('#addUserSpinner').show();
                          }, 7000);
                    } 


                    else{
                      $(".addUser-errorMesss").html("Error Adding User");
                      $(".addUser-errorMesss").show();
                    }
                  }
      });
 }
});
//GET USER INFO
$(".editBtn").click(function(){
  var btnId = $(this).attr("name");
  $.ajax({
        type: "POST",
        url: "assets/ajax_get_user_info.php",
        data: {
                 'user_id': btnId    
              },
        success: function(editRes){
                  if (editRes.status == 1) {

                      var getId = editRes.userid;
                      var editLastName = editRes.lastName;  
                      var editFirstName = editRes.firstName; 
                      var editEmail = editRes.userEmail; 
                      $("#editLastName").val(editLastName);
                      $("#editFirstName").val(editFirstName);
                      $("#editEmail").val(editEmail);
                      $("#getUserId").val(getId);
                  }
                }
    });
});
//EDIT USER INFO
$("#updateBtn").click(function(){
  var edituserid = $("#getUserId").val();
  var editedLastName = $("#editLastName").val();
  var editedFirstName =    $("#editFirstName").val();
  var editedEmail =    $("#editEmail").val();
  
  console.log(edituserid);
    $.ajax({
        type: "POST",
        url: "assets/ajax_update_user_info.php",
        data: {   
                  'first_name':editedFirstName,
                  'last_name':editedLastName,
                  'email':editedEmail,
                  'user_id': edituserid    
              },
        success: function(editRes){
                  if (editRes.status == 1) {
                    $("#getUserId").val("");
                    $("#editLastName").val("");
                    $("#editFirstName").val("");
                    $("#editEmail").val("");
                      
                  }
                }
    });
});

//DELETE USER
$("#deleteUserButton").click(function(event){
  var idArray = [];
  $("#users-table input[type=checkbox]").each(function(){
    if ($(this).is(":checked")) {
        var userId = $(this).attr("name");
         idArray.push(userId);
      }
  });
    //ERROR MESSAGE IF NONE SELECTED
    if (idArray.length === 0) {
      event.stopPropagation();
      $(".delUser-errorMesss").html("No user Selected");
      $(".delUser-errorMesss").toggle();
      $(document).click( function(){
          $('.delUser-errorMesss').hide();
      });
    }
    else  {
      if (confirm("Are you sure you want to delete")) {
          $.ajax({
            type: "POST",
            url: "assets/ajax_del_user.php",
            data: {
                     'user_ids': idArray 
                  },
            success: function(removeUserRes){
                      $.each(idArray, function(index,userid){
                          $("#tr_"+userid).remove();
                      }); 
                    }
          });
      } else {
        return false;
      }       
    }
});
 
///////////////////////PAGE: ADMINISTRATORS////////////////////////////////////////////

//SEARCH ADMIN
$("#search_admin").keyup(function(){
  var searchText = $("#search_admin").val();
  $.ajax({
          method: "POST",
          url: "assets/ajax_admin_search.php",
          data: {'searchText': searchText},
          success: function(searchRes){
                      $('#tAdminBody').html(searchRes);
                    }
        });
});
//ADD ADMIN
$("#btnAddAdmin").click(function(){
   var adminLastName = $("#adminLastName").val();
   var adminFirstName = $("#adminFirstName").val();
   var adminEmail = $("#adminEmail").val();


 if (adminLastName == "" && adminFirstName == "" && adminEmail == "") {
  $(".addAdmin-errorMesss").html("Please Fill Input Fields");
  $(".addAdmin-errorMesss").show();
 } else if (adminFirstName == "") {
  $(".addAdmin-errorMesss").html("Please Input  user First Name");
  $(".addAdmin-errorMesss").show();
 }
 else if (adminEmail == "") {
  $(".addAdmin-errorMesss").html("Please Input  user Email");
  $(".addAdmin-errorMesss").show();
 }
 else if (adminLastName == ""){
  $(".addAdmin-errorMesss").html("Please Input user Last Name");
  $(".addAdmin-errorMesss").show();
 }
 else if (adminLastName !== "" && adminFirstName !== "" && adminEmail !== "") {

      $.ajax({
          type: "POST",
          url: "assets/ajax_add_admin.php",
          data: {
                   'first_name': adminFirstName,
                   'last_name': adminLastName,
                   'email': adminEmail 
                },
          success: function(addAdminRes){
                    if (addAdminRes.status == 1) {
                        $(".addAdmin-errorMesss").hide();
                        $('.addUser-errorMesss').css('display', 'none');
                         $('.addAdminProgress').show();
                          
                          setTimeout(function(){  
                            $('#addAdminSpinnerLabel').html("Admin Added");
                            $('#addAdminSpinner').hide();
                            //REMOVE VALUES
                            $("#adminLastName").val("");
                            $("#adminFirstName").val("");
                            $("#adminEmail").val("");
                            var admin = addAdminRes.full_name;
                            var adminmail = addAdminRes.email;
                            var newAdminId = addAdminRes.uid;
                            var newRow = "<tr id='tr_"+newAdminId+"'><td><input type='checkbox' name='"+newAdminId+"'></td><td>"+admin+"</td><td>"+adminmail+"</td><td class='editTd'><button class='btn editAdminBtn' name='<?php echo $user_id; ?>' data-toggle='modal' data-target='#editAdminModal'><img src='img/edit.svg' class='editImg'></button></td></tr>";
                            $("#admin-table").append(newRow);
                          }, 2000);

                          setTimeout(function(){ 
                            $('.addAdminProgress').hide();
                            $('#addAdminSpinnerLabel').html("Adding User....");
                            $('#addAdminSpinner').show();
                          }, 7000);
                    } 


                    else{
                      $(".addAdmin-errorMesss").html("Error Adding Admin");
                      $(".addAdmin-errorMesss").show();
                    }
                  }
      });
 }
});

//GET ADMIN INFO
$(".editAdminBtn").click(function(){
  var btnId = $(this).attr("name");
  $.ajax({
        type: "POST",
        url: "assets/ajax_get_admin_info.php",
        data: {
                 'user_id': btnId    
              },
        success: function(editRes){
                  if (editRes.status == 1) {

                      var getId = editRes.userid;
                      var editLastName = editRes.lastName;  
                      var editFirstName = editRes.firstName; 
                      var editEmail = editRes.userEmail; 
                      $("#editAdminLastName").val(editLastName);
                      $("#editAdminFirstName").val(editFirstName);
                      $("#editAdminEmail").val(editEmail);
                      $("#getAdminId").val(getId);
                  }
                }
    });
});

//EDIT ADMIN INFO
$("#updateAdminBtn").click(function(){
  var edituserid = $("#getAdminId").val();
  var editedLastName = $("#editAdminLastName").val();
  var editedFirstName =    $("#editAdminFirstName").val();
  var editedEmail =    $("#editAdminEmail").val();
  
  console.log(edituserid);
    $.ajax({
        type: "POST",
        url: "assets/ajax_update_admin_info.php",
        data: {   
                  'first_name':editedFirstName,
                  'last_name':editedLastName,
                  'email':editedEmail,
                  'user_id': edituserid    
              },
        success: function(editRes){
                  if (editRes.status == 1) {
                    $("#getAdminId").val("");
                    $("#editAdminFirstName").val("");
                    $("#editAdminLastName").val("");
                    $("#editAdminEmail").val("");                      
                  }
                }
    });
});


//DELETE ADMIN
$("#deleteAdminButton").click(function(){
  var idArray = [];
  $("#admin-table input[type=checkbox]").each(function(){ 
    if ($(this).is(":checked")) {
        var adminId = $(this).attr("name"); 
         idArray.push(adminId);
    }    
  });

    if (idArray.length == 0) {
      event.stopPropagation();
      $(".delAdmin-errorMesss").toggle();
      $(".delAdmin-errorMesss").html("No user Selected");
      $(document).click( function(){
        $('.delAdmin-errorMesss').hide();
      });
    }
    else if (idArray.length > 0) {
      if (confirm("Are you sure you want to delete")) {
        $.ajax({
            type: "POST",
            url: "assets/ajax_del_admin.php",
            data: {
                     'admin_ids': idArray 
                  },
            success: function(removeUserRes){
                      $.each(idArray, function(index,adminid){
                          $("#tr_"+adminid).remove();
                      }); 
                    }
          });
      } else{
        return false;
      }
    }
});

});