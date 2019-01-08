<div class="main-container">
  <div class="container-fluid">
    <div class="page-breadcrumb">
      <div class="row">
        <div class="col-md-7">
          <div class="page-breadcrumb-wrap">
            <div class="page-breadcrumb-info">
              <h2 class="breadcrumb-titles"><?php echo $title; ?></h2>
              <ul class="list-page-breadcrumb">
                <li><a href="<?php echo base_url(''); ?>">Home</a>
                </li>
                <li class="active-page"> <?php echo $title; ?></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-5">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 no-padding-xs">
        <div class="box-widget widget-module">
          <div class="widget-head clearfix">
            <span class="h-icon"><i class="fa fa-th"></i></span>
            <h4></h4>
          </div>
          <div class="widget-container">
            <div class=" widget-block">
            <div class="loader">
              <img src="<?php echo base_url('assets/images/select2-spinner.gif'); ?>" alt="">
            </div>
              <?php echo $output; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>