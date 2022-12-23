<?php
    $month_get = (isset($_GET['month'])) ? $_GET['month']:'';
    $year_get = (isset($year_get)) ? $year_get:'';
    if($month_get!='' && $year_get!='')
    {
        $time = $year_get.'-'.$month_get.'-1';
        $date = strtotime($time);
    }
    else
    {
        $date = strtotime(date('y-m-d')); 
    }
    $day = date('d', $date);
    $month = date('m', $date);
    $year = date('Y', $date);
    $firstDay = mktime(0,0,0,$month, 1, $year);
    $title = strftime('%B', $firstDay);
    $dayOfWeek = date('D', $firstDay);
    $daysInMonth = cal_days_in_month(0, $month, $year);
    $timestamp = strtotime('next Sunday');
    $weekDays = array();
    for($i=0;$i<7;$i++)
    {
        $weekDays[] = strftime('%a', $timestamp);
        $timestamp = strtotime('+1 day', $timestamp);
    }
    $blank = date('w', strtotime("{$year}-{$month}-01"));
?>
<!-- Main content -->

<div class="wrap-banner-top-index-admin">
    <div class="text-admin">
        <h1>Xin chào <?=$_SESSION[$login_admin]['username']?>!</h1>
        <p>Bao lâu rồi bạn không quay lại trang quản trị, nào cùng kiểm tra xem chúng ta có gì mới nhé!!</p>
    </div>
    <div class="box-account-admin">
        <div class="img-box-">
            <span>
                <img src="assets/images/bg-account.png" alt="">
            </span>
            
        </div>
        <p>
                <strong>Administrator</strong><span>Nhà quản trị website</span>
            </p>
    </div>
</div>
<section class="content pb-4">
   <div class="container-fluid">
       <div class="card card-boder">
           <div class="card-header">
               <h5 class="mb-0">Thống kê truy cập tháng <?=$month?>/<?=$year?></h5>
           </div>
           <div class="card-body">
            <form class="form-filter-charts row align-items-center mb-1" action="index.php" method="get" name="form-thongke" accept-charset="utf-8">
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="form-control select2" name="month" id="month">
                            <option>Chọn tháng</option>
                            <?php for($i=1; $i<=12 ;$i++) { ?>
                                <?php
                                if($year_get) $selected = ($i==$month_get) ? 'selected':'';
                                else $selected = ($i==date('m')) ? 'selected':'';
                                ?>
                                <option value="<?=$i?>" <?=$selected?>>Tháng <?=$i?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="form-control select2" name="year" id="year">
                            <option>Chọn năm</option>
                            <?php for($i=2000;$i<=date(Y)+20;$i++) { ?>
                                <?php
                                if($year_get) $selected = ($i==$year_get) ? 'selected':'';
                                else $selected = ($i==date('Y')) ? 'selected':'';
                                ?>
                                <option value="<?=$i?>" <?=$selected?>>Năm <?=$i?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"><button type="submit" class="btn btn-success">Thống Kê</button></div>
                </div>
            </form>
               <div id="apexMixedChart"></div>
           </div>
       </div>
   </div>
</section>

<script src="assets/apexcharts/apexcharts.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var apexMixedChart;
        var options = {
            colors: ['#3c8dbc'],
            chart:
            {
                id: 'apexMixedChart',
                height: 450,
                type: 'line',
                dropShadow:
                {
                    enabled: true,
                    color: '#000',
                    top: 18,
                    left: 7,
                    blur: 20,
                    opacity: 0.2
                }
            },
            series: [{
                name: 'Thống kê truy cập tháng <?=$month?>',
                type: 'line',
                data: [
                    <?php for($i = 1; $i <= $daysInMonth; $i++) {
                        $k = $i+1;
                        $begin = strtotime($year.'-'.$month.'-'.$i);
                        $end = strtotime($year.'-'.$month.'-'.$k);
                        $todayrc = $d->rawQueryOne("SELECT COUNT(*) AS todayrecord FROM #_counter WHERE tm >= ? and tm < ?",array($begin,$end));
                        $today_visitors = $todayrc['todayrecord']; ?>
                        <?=$today_visitors?>,
                    <?php } ?>
                ]
            }],
            stroke: {
              curve: 'smooth'
            },
            grid: {
                borderColor: '#e7e7e7',
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            markers: {
                size: 1
            },
            dataLabels: {
                enabled: false
            },
            labels: [
                <?php for($i = 1; $i <= $daysInMonth; $i++) {
                    $k = $i+1;
                    $begin = strtotime($year.'-'.$month.'-'.$i);
                    $end = strtotime($year.'-'.$month.'-'.$k);
                    $todayrc = $d->rawQueryOne("SELECT COUNT(*) AS todayrecord FROM #_counter WHERE tm >= ? and tm < ?",array($begin,$end));
                    $today_visitors = $todayrc['todayrecord']; ?>
                    'D<?=$i?>',
                <?php } ?>
            ],
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                floating: true,
                offsetY: -25,
                offsetX: -5
            }
        }

        apexMixedChart = new ApexCharts(document.querySelector("#apexMixedChart"), options);
        apexMixedChart.render();
    })
</script>