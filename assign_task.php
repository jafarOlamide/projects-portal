<?php include "includes/navBar.php"; ?>    
<div class="col-6">
  <div class="container">
    <form id="submit_assign">
      <div class="form-group">
        <label>Name</label>
        <div>
            <input type="text" class="form-control" name="assignee_name" id="assignee_Name">
        </div>
      </div>
      <div class="form-group">
        <label>Task</label>
        <div>
            <textarea class="form-control" name="assignee_task" id="Assignee_Task"></textarea>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-auto">
        <label>Date Assigned</label>
        <div class="col-sm-12 row">
            <input type="date" name="pdate_assigned" style="width: auto;" class="form-control" id="Date_Assigned">
        </div>
        </div>
        <div class="form-group col-auto">
          <label>Feedback Date</label>
          <div class="col-sm-12 row">
              <input type="date" name="p_feedback_date" style="width: auto;" class="form-control" id="pFeedBackDate">
          </div>
        </div>
      </div>
      <hr>
      <div class="footer">
        <button class="btn btn-secondary">Close</button>
        <button class="btn btn-primary" name="assign_project" id="assign_project_btn">Save</button>
      </div>
    </form> 
  </div>
</div>
<?php include("includes/footerLinks.php")?>

