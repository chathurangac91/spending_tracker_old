<style>
  .w-currency .w-meta-value:before {
    content: "<?php echo $this->common->userinfo()->currencry_code; ?>" !important;
  }
</style>

<?php  

  $goal_percentage = $this->common->set_border_color($income);

  if($goal_percentage >= 75){
    $border_color = "#66bb6a";

  }elseif($goal_percentage >= 50){
    $border_color = "#fdd835";

  }elseif($goal_percentage >= 25){
    $border_color = "#fb8c00";
  
  }else{
    $border_color = "#ff8a80";

  }
?>

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

    <div class="top-stat-box">
      <div class="row">
        <div class="col-md-3 right-light-border col-sm-6">
          <div class="stat-w-wrap ca-center number-rotate">
            <span class="stat-w-title">This Month</span>
            <span class="epie-chart" data-percent="<?php echo $goal_percentage; ?>" data-barcolor="<?php echo $border_color; ?>" data-tcolor="#e0e0e0" data-scalecolor="#e0e0e0" data-linecap="butt" data-linewidth="5" data-size="100" data-animate="2000"><span class="percent"></span>
            <div class="w-meta-info w-currency">
              <span class="w-meta-value number-animate" data-value="<?php echo $income; ?>" data-animation-duration="1500">0</span>
              <span class="w-meta-title">Income</span>
              <span class="w-previos-stat">Goal : <?php echo $this->common->userinfo()->currencry_code; ?><span class="number-animate" data-value="<?php echo $this->common->userinfo()->goal; ?>" data-animation-duration="1500">0</span></span>
            </div>
          </div>
        </div>
        <div class="col-md-5 right-light-border col-sm-6">
          <div class="stat-w-wrap ca-center combine-stats">
            <div class="row">
              <div class="col-md-12">
                <span class="stat-w-title">This month</span>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6">
                <a href="#" class="ico-cirlce-widget w_bg_green">
                  <span><i class="fa fa-money"></i></span>
                </a>
                <div class="w-meta-info w-currency">
                  <span class="w-meta-value number-animate" data-value="<?php echo $balance; ?>" data-animation-duration="1500">0</span>
                  <span class="w-meta-title">Balance</span>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <a href="#" class="ico-cirlce-widget w_bg_red">
                <span><i class="ico-price-tag"></i></span>
                </a>
                <div class="w-meta-info">
                  <span class="w-meta-value w-currency">
                  <span class="w-meta-value number-animate" data-value="<?php echo $expense; ?>" data-animation-duration="1500">0</span></span>
                  <span class="w-meta-title">Expense</span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="w-meta-info">
                  <span class="w-previos-stat">Today Income : <?php echo $this->common->userinfo()->currencry_code.' '.number_format($today_income, 2); ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- <div class="col-md-4 col-sm-12">
          <div class="ca-center stat-w-wrap">
            <span class="stat-w-title">This Week Earnings</span>
            <div id="weekly-earning">
            </div>
          </div>
        </div> -->
      </div>
    </div>
    <!-- <div class="row">
      <div class="col-md-12">
        <div class="w-info-graph">
          <div class="row">
            <div class="col-md-8">
              <div class="w-info-chart">
                <div class="w-info-chart-header">
                  <h2>23,320 Items Sold</h2>
                  <p>
                     This is a income chart for the Matmix products
                  </p>
                </div>
                <div class="mini-chart-list">
                  <ul>
                    <li>
                    <span class="epie-chart" data-percent="40" data-barcolor="#00acc1" data-tcolor="#e0e0e0" data-scalecolor="#e0e0e0" data-linecap="butt" data-linewidth="3" data-size="80" data-animate="2000"><span class="percent"></span>
                    </span>
                    <span class="chart-sub-title">Direct</span>
                    </li>
                    <li>
                    <span class="epie-chart" data-percent="35" data-barcolor="#ffb74d" data-tcolor="#e0e0e0" data-scalecolor="#e0e0e0" data-linecap="butt" data-linewidth="3" data-size="80" data-animate="2000"><span class="percent"></span>
                    </span>
                    <span class="chart-sub-title">Affiliate</span>
                    </li>
                    <li>
                    <span class="epie-chart" data-percent="25" data-barcolor="#4caf50" data-tcolor="#e0e0e0" data-scalecolor="#e0e0e0" data-linecap="butt" data-linewidth="3" data-size="80" data-animate="2000"><span class="percent"></span>
                    </span>
                    <span class="chart-sub-title">Renew</span>
                    </li>
                  </ul>
                </div>
                <div class="line-chart-container">
                  <div class="sparkline" data-type="line" data-resize="true" data-height="200" data-width="100%" data-line-width="1" data-line-color="#00acc1" data-spot-color="#00838f" data-fill-color="rgba(240,240,240,0.5)" data-highlight-line-color="#e1e5e9" data-highlight-spot-color="#ff8a65" data-spot-radius="4" data-data="[500,590,620,690,700,740,660,530,600,640, 770,600,550,520,610,650,780,690,680,790,680,664,600,800]" data-stack-line-color="#ffb74d" data-stack-fill-color="rgba(190,100,10,.08)" data-stack-spot-color="#ef6c00" data-stack-spot-radius="4" data-compositedata="[450,480,500,590,600,640,560,530,500,540, 570,600,550,520,510,500,510,540,580,590,580,564,600,700]">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="w-info-chart-meta">
                <h2>Alltime Earning</h2>
                <span class="info-meta-value">$90,808</span>
                <span class="w-meta-title">Traffic Source</span>
                <div class="progress-wrap">
                  <div class="clearfix progress-meta">
                    <span class="pull-left progress-label">google.com</span><span class="pull-right progress-percent label label-info"></span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar progress-bar-info" data-progress="40">
                    </div>
                  </div>
                </div>
                <div class="progress-wrap">
                  <div class="clearfix progress-meta">
                    <span class="pull-left progress-label">yahoo.com</span><span class="pull-right progress-percent label label-danger"></span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar progress-bar-danger" data-progress="25">
                    </div>
                  </div>
                </div>
                <div class="progress-wrap">
                  <div class="clearfix progress-meta">
                    <span class="pull-left progress-label">jaman.me</span><span class="pull-right progress-percent label label-primary"></span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar progress-bar-primary" data-progress="20">
                    </div>
                  </div>
                </div>
                <div class="progress-wrap">
                  <div class="clearfix progress-meta">
                    <span class="pull-left progress-label">envato.com</span><span class="pull-right progress-percent label label-success"></span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar progress-bar-success" data-progress="10">
                    </div>
                  </div>
                </div>
                <div class="progress-wrap">
                  <div class="clearfix progress-meta">
                    <span class="pull-left progress-label">Others</span><span class="pull-right progress-percent label label-warning"></span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar progress-bar-warning" data-progress="5">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  </div>
</div>