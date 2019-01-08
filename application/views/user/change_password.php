<div class="main-container">
  <div class="container-fluid">
    <div class="page-breadcrumb">
      <div class="row">
        <div class="col-md-7">
          <div class="page-breadcrumb-wrap">
          </div>
        </div>
        <div class="col-md-5">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="box-widget widget-module">
          <div class="widget-head clearfix">
            <span class="h-icon"><i class="fa fa-th"></i></span>
            <h4></h4>
          </div>
          <div class="widget-container">
            <div class=" widget-block">
              
              <form method="post" action="<?php echo base_url('profile/update_password') ?>">
                <div class="ibox-content">
                     <div class="form-group">
                       <label for="">Password</label>
                       <input type="password" name="password" class="form-control">
                     </div>
                     <div class="form-group">
                       <label for="">Confirm password</label>
                       <input type="password" name="confirm_password" class="form-control">
                     </div>
                </div>
                <div class="ibox-footer text-right">
                    <button type="submit" class="btn btn-primary">Update password</button>
                </div>  
                <div class="help-block">
                  <?php echo validation_errors(); ?>
                </div>
            </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>