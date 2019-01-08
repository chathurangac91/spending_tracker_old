<?php 
    $user_type = array(
        '1' => 'Admin',
        '2' => 'User'
    );
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Westilian">

        <title><?php echo $title; ?> | <?php echo $this->config->item('company_name'); ?></title>

        <!-- Load css files -->
        <?php for ($i=0; $i < count($css); $i++) { ?>
            <link href="<?php echo $css[$i]; ?>" rel="stylesheet">
        <?php } ?>
        <script>var current_url = "<?php  echo current_url(); ?>";</script>
    </head>
    <body>
    <div class="page-container list-menu-view">

        <!--Leftbar Start Here -->
        <div class="left-aside desktop-view">
            <div class="aside-branding">
                <a href="<?php echo base_url(); ?>" class="iconic-logo"><img src="<?php echo base_url('assets/uploads/images/logo/').$this->config->item('logo_small'); ?>" alt=""></a>
                <a href="<?php echo base_url(); ?>" class="large-logo"><img src="<?php echo base_url('assets/uploads/images/logo/').$this->config->item('logo'); ?>" alt=""></a>
                <span class="aside-pin waves-effect"><i class="fa fa-thumb-tack"></i></span>
                <span class="aside-close waves-effect"><i class="fa fa-times"></i></span>
            </div>
            <div class="left-navigation">
                <ul class="list-accordion">
                    <li><a href="<?php echo base_url('dashboard') ?>"><span class="nav-icon"><i class="fa fa-tachometer"></i></span><span class="nav-label">Dashboard</span></a></li>
                    <li><a href="<?php echo base_url('transactions') ?>"><span class="nav-icon"><i class="fa fa-tasks"></i></span><span class="nav-label">Transactions</span></a></li>
                    <li><a href="<?php echo base_url('items') ?>"><span class="nav-icon"><i class="fa fa-tasks"></i></span><span class="nav-label">Items</span></a></li>
                    <?php if($this->common->userinfo()->user_type == 1): ?>
                        <li><a href="<?php echo base_url('users') ?>"><span class="nav-icon"><i class="ico-lifebuoy"></i></span><span class="nav-label">Users</span></a></li>
                        <li><a href="<?php echo base_url('settings/index/edit/1') ?>"><span class="nav-icon"><i class="ico-hammer-wrench"></i></span><span class="nav-label">System Settings</span></a></li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
        <div class="page-content">
            <!--Topbar Start Here -->
            <header class="top-bar">
                <div class="container-fluid top-nav">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="clearfix top-bar-action">
                            <span class="leftbar-action-mobile waves-effect"><i class="fa fa-bars "></i></span>
                                <span class="leftbar-action desktop waves-effect"><i class="fa fa-bars "></i></span>
                            </div>
                        </div>
                        <div class="col-md-8 responsive-fix">
                            <div class="top-aside-right">
                                <div class="user-nav">
                                    <ul>
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" href="#" class="clearfix dropdown-toggle waves-effect waves-block waves-classic">
                                                <span class="user-info"><?php echo $this->common->userinfo()->first_name." ".$this->common->userinfo()->last_name; ?> <cite><?php echo $user_type[$this->common->userinfo()->user_type]; ?></cite></span>
                                                <span class="user-thumb"><img src="<?php echo base_url('assets/images/avatar/jaman-01.jpg'); ?>" alt="image"></span>
                                            </a>
                                            <ul role="menu" class="dropdown-menu fadeInUp">
                                                <li><a href="<?php echo base_url('profile/index/edit/'.$this->common->userinfo()->user_id) ?>"><span class="user-nav-icon"><i class="fa fa-cogs"></i></span><span class="user-nav-label">Update Profile</span></a>
                                                <li><a href="<?php echo base_url('profile/change_password') ?>"><span class="user-nav-icon"><i class="fa fa-cogs"></i></span><span class="user-nav-label">Change Password</span></a>
                                                <li><a href="<?php echo base_url('logout') ?>"><span class="user-nav-icon"><i class="fa fa-lock"></i></span><span class="user-nav-label">Logout</span></a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>