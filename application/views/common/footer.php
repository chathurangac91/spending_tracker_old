                <!--Footer Start Here -->
                <footer class="footer-container">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="footer-left">
                                    <span>&copy; <?php echo date('Y'); ?> <a><?php echo $this->config->item('company_name'); ?></a></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <!-- Change password modal -->
        <div class="modal inmodal" id="change_pw" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated flipInY">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Change Password for <span id="user_name"></span></h4>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('', 'id="change_pw_form" role="form"') ?>
                            <input type="hidden" name="user_id">
                            <div class="form-group">
                                <label>Password</label> 
                                <input placeholder="Enter New Password" class="form-control" type="password" name="password" required="">
                                <span id="password_error" class="form-text m-b-none" style="color:#e67373"></span>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label> 
                                <input placeholder="Re Enter The New Password" class="form-control" type="password" name="confirm_password" required="">
                                <span id="confirm_password_error" class="form-text m-b-none" style="color:#e67373"></span>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button id="save_pw" type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Load js files -->
        <?php for ($i=0; $i < count($js); $i++) { ?>
            <script src="<?php echo $js[$i]; ?>"></script>
        <?php } ?>
    </body>
</html>