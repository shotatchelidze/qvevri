<?php require APPROOT . '/admin/admin_views/adminInc/adminHeader.php'; ?>
<?php flash('update_pass_success');?>
<div class="container">
    <form action="<?php echo URLROOT;?>/Menu_admins/changePassword" method="POST">
	<div class="row">
		<div class="col-sm-4">
		    <label>Current Password</label>
		    <div class="form-group pass_show"> 
                <input type="password" name="current_pass" value="<?php echo $data['current_pass'];?>" class="form-control <?php echo (!empty($data['current_pass_err'])) ? 'is-invalid' : '';?>" placeholder="Current Password"> 
                <span class="invalid-feedback"><?php echo $data['current_pass_err']; ?></span>
            </div>
		       <label>New Password</label>
            <div class="form-group pass_show"> 
                <input type="password" name="new_pass" value="<?php echo $data['new_pass'];?>" class="form-control <?php echo (!empty($data['new_pass_err'])) ? 'is-invalid' : '';?>" placeholder="New Password"> 
                <span class="invalid-feedback"><?php echo $data['new_pass_err']; ?></span>
            </div> 
		       <label>Confirm Password</label>
            <div class="form-group pass_show"> 
                <input type="password" name="confirm_pass" value="<?php echo $data['confirm_pass'];?>" class="form-control <?php echo (!empty($data['confirm_pass_err'])) ? 'is-invalid' : '';?>" placeholder="Confirm Password"> 
                <span class="invalid-feedback"><?php echo $data['confirm_pass_err']; ?></span>
            </div>
		</div>  
    </div>
    <input type="submit" class="btn btn-success" value="Submit">
    </form>
</div>
<?php require APPROOT . '/admin/admin_views/adminInc/adminFooter.php'; ?>
