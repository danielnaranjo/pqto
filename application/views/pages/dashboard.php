<?php
    $nivel = $this->session->userdata('level');
    if($this->uri->segment(3)==''){
        $Id = $this->session->userdata('property_id');
    } else {
        $Id = $this->uri->segment(3);
    }
?>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="<?php echo base_url() ?>">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Dashboard</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">
            <? echo $title; ?>
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->

        <?// if($nivel==1) { ?>
        <!-- BEGIN DASHBOARD STATS 1-->
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="<?=count($tasks)?>">0</span>
                        </div>
                        <div class="desc"> Contactos </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="<?=count($points)?>">0</span>
                        </div>
                        <div class="desc"> Enviados </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="<?=count($users)?>">0</span>
                        </div>
                        <div class="desc"> Recibidos </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            $<span data-counter="counterup" data-value="100">0</span></div>
                        <div class="desc"> Ganado </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- END DASHBOARD STATS 1-->
        <?// } ?>
        <!-- <div class="row">
            <div class="col-md-12 col-sm-12" style="background-color:#fefefe">
                <div id="gmap_marker" class="gmaps"> </div>
            </div>
        </div> -->
        <div class="clearfix"></div>

        <div class="row">
            <!-- <div class="col-md-6 col-sm-6">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bar-chart font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase">Sucursal/Tarea completada</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="visitantes" class="chart" style="height:300px;width:594px;"></div>
                    </div>
                </div>
            </div> -->
            <div class="col-md-12 col-sm-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-red-sunglo hide"></i>
                            <span class="caption-subject font-dark bold uppercase">Actividad</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="ventas" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase"> Ultimas tareas</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="mt-comments">
                            <? foreach($todos as $todo) { ?>
                            <div class="mt-actions">
                                <div class="mt-action">
                                    <div class="mt-action-body">
                                        <div class="mt-action-row">
                                            <div class="mt-action-info ">
                                                <div class="mt-action-icon ">
                                                    <i class="fa fa-thumb-tack"></i>
                                                </div>
                                                <div class="mt-action-details ">
                                                    <span class="mt-action-author"><? echo $todo['title'] ?></span>
                                                    <p class="mt-action-desc">
                                                        <!-- <?=word_limiter($todo['description'],5) ?><br/> -->
                                                        <strong><?=$todo['amount'] ?></strong> Creditos
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="mt-action-datetime ">
                                                <span class="mt=action-time">
                                                    <? echo mdate('%d/%m/%y', strtotime($todo['valid_to'])) ?>
                                                </span>
                                            </div>

                                            <div class="mt-action-buttons" style="width: 150px !important;">
                                                <div class="btn-group btn-group-circle">
                                                    <a href="<?=site_url()?>/branch/bycompany/<?=$todo['task_id']?>/<? echo $todo['title'] ?>" class="btn btn-outline green btn-sm">Sucursales</a>
                                                    <a href="<?=site_url()?>/task/view/<?=$todo['task_id']?>" class="btn btn-outline red btn-sm">Ver</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <? } ?>
                            <? if(count($todos)==0) { ?>
                                <h3>No hay tareas disponibles</h3>
                            <? } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-microphone font-dark hide"></i>
                            <span class="caption-subject bold font-dark uppercase"> Pagos solicitados</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="tab-pane active" id="tab_actions_pending">
                            <? foreach($payments as $payment) { ?>
                            <div class="mt-actions">
                                <div class="mt-action">
                                    <div class="mt-action-body">
                                        <div class="mt-action-row">
                                            <div class="mt-action-info ">
                                                <div class="mt-action-icon ">
                                                    <i class="fa fa-money"></i>
                                                </div>
                                                <div class="mt-action-details ">
                                                    <span class="mt-action-author"><?= $payment['email'] ?></span>
                                                    <p class="mt-action-desc">
                                                        <strong><?= $payment['amount'] ?></strong> creditos
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="mt-action-datetime ">
                                                <span class="mt=action-time">
                                                    <?= mdate('%d/%m/%y %h:%i', strtotime(@$payment['requested'])) ?>
                                                </span>
                                            </div>
                                            <div class="mt-action-buttons" style="width: 150px !important;">
                                                <div class="btn-group btn-group-circle">
                                                    <a href="<?=site_url()?>/withdraw/approved/<?=$payment['withdraw_id']?>" class="btn btn-outline green btn-sm">Aprobar</a>
                                                    <a href="<?=site_url()?>/task/report/<?=$payment['withdraw_id']?>" class="btn btn-outline red btn-sm">Revisar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <? } ?>
                            <? if(count($payments)==0) { ?>
                                <h3>No hay solicitudes de pago</h3>
                            <? } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- END CONTENT BODY -->
</div>

<script>
window.onload = function(){
    var dataValues = [<? foreach ($stats as $stat) { ?> { "date": "<?=$stat['d']?>", "value": <?=$stat['t']?>, "status": <?=$stat['e']?>, "money": <?=$stat['m']?> },<? } ?>]
    var preguntas = function(chartContainer, data) {
        if(data==0){
            $('#'+chartContainer).html('No hay datos para mostrar');
            console.log(chartContainer, data);
        } else {
            var chart = AmCharts.makeChart( chartContainer, {
              "type": "serial",
              "theme": "light",
              "dataDateFormat": "YYYY-MM-DD",
              "graphs": [ {
                "id": "g1",
                "type":"column",
                "fillAlphas": 1,
                "balloonText": "<div style='margin:5px;'>Cantidad:<b>[[value]]</b></div>",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "hideBulletsCount": 50,
                "lineThickness": 2,
                // "title": "Tareas",
                "useLineColorForBulletBorder": true,
                "valueField": "value"
            },{
                "id": "g2",
                "balloonText": "<div style='margin:5px;'><b>Solicitud: [[status]]</b></div>",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "hideBulletsCount": 50,
                "lineThickness": 2,
                // "title": "Tareas",
                "useLineColorForBulletBorder": true,
                "valueField": "status"
            }],
            //   "chartScrollbar": {
            //     "graph": "g1",
            //     "oppositeAxis": false,
            //     "offset": 30,
            //     "scrollbarHeight": 80,
            //     "backgroundAlpha": 0,
            //     "selectedBackgroundAlpha": 0.1,
            //     "selectedBackgroundColor": "#888888",
            //     "graphFillAlpha": 0,
            //     "graphLineAlpha": 0.5,
            //     "selectedGraphFillAlpha": 0,
            //     "selectedGraphLineAlpha": 1,
            //     "autoGridCount": true,
            //     "color": "#AAAAAA"
            //   },
              "chartCursor": {
                "cursorAlpha": 1,
                "cursorColor": "#258cbb"
              },
              "categoryField": "date",
              "categoryAxis": {
                "parseDates": true,
                "equalSpacing": true,
                "gridPosition": "middle",
                "dashLength": 1,
                "minorGridEnabled": true
              },
              "zoomOutOnDataUpdate": false,
              "listeners": [ {
                "event": "init",
                "method": function( e ) {
                  e.chart.zoomToIndexes( e.chart.dataProvider.length - 40, e.chart.dataProvider.length - 1 );
                }
              }, {
                "event": "changed",
                "method": function( e ) { e.chart.lastCursorPosition = e.index; }
              } ],
              "dataProvider": data
            } );
        }
    };
    preguntas("ventas", dataValues);
    //preguntas("visitant", dataValues);
    //console.debug('dataValues', dataValues);

    // Google Maps Markers
    <? foreach ($points as $p) { ?>
    addMarker({lat: <?=$p['latitude']?>, lng: <?=$p['longitude']?>}, 'gmap_marker');
    <? } ?>;
    <?php if(@$_GET['msg'] && @$_GET['code']) { ?>
        toastr.<?=$_GET['code']?>('<?=$_GET['msg']?>');
    <? } ?>

}//onLoad()
//console.debug('dash',<?php echo json_encode($this->session->userdata)?>);
</script>
