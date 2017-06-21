<?
// comienza el formulario
$model = $this->uri->segment(1);
$action = $this->uri->segment(3);
$nivel = $this->session->userdata('level');
    if($nivel==1) {
        //$property_id = $this->session->userdata('property_id');
    } else {
        //$property_id = $this->input->get("property_id");
    }

?>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="<?php echo base_url() ?>">Home </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="<?php echo site_url() ?>/<?php echo $model ?>/all">
                        <span style="text-transform: capitalize;">
                            <?php echo traducir($model); ?>
                        </span>
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span><?=$result['title']?></span>
                </li>
            </ul>
        </div>

        <h3 class="page-title">
            <?=$result['title']?>
            <!--<div class="page-toolbar">-->
                <div class="actions pull-right">
                    <div class="btn-group">
                        <a class="btn dark btn-outline" href="javascript:history.back();">
                            <i class="fa fa-chevron-left"></i>
                            Volver atras
                        </a>
                        <a class="btn dark btn-outline" href="<? echo site_url()?>/task/action/edit/<?=$result['task_id']?>">
                            Editar
                        </a>
                    </div>
                </div>
            <!--</div>-->
        </h3>

        <div class="profile">
            <div class="tabbable-line tabbable-full-width">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1_1">
                        <div class="row">
                            <div class="col-md-3">
                                <ul class="list-unstyled profile-nav">
                                    <li>
                                        <img src="<?=$result['image']?>" class="img-responsive" alt="" style="min-width: 100% !important;" />
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-8 profile-info">
                                        <h1 class="font-green sbold uppercase"><?=$result['title']?></h1>
                                        <p>
                                            <?=$result['description']?>
                                        </p>
                                        <p>
                                            <?=$company['name']?>
                                            <? if($company['name']!=''){?>
                                            <a href="<?=site_url()?>/company/action/edit/<?=$company['company_id']?>"><i class="fa fa-pencil"></i> Editar compañia</a>
                                            <? } else { ?>
                                                <a href="<?=site_url()?>/company/action/new/<?=$this->session->userdata('user_id')?>">Agregar datos de compañia
                                            <?}?></a>
                                        </p>
                                        <ul class="list-inline">
                                            <li>
                                                <i class="fa fa-map-marker"></i> <?=$company['address']?>
                                            </li>
                                            <li>
                                                <i class="fa fa-phone"></i> <?=$company['phone']?>
                                            </li>
                                            <li>
                                                <i class="fa fa-user"></i> <?=mailto($company['email'],$company['contact'])?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--end row-->
                                <div class="tabbable-line tabbable-custom-profile">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#branches" data-toggle="tab"> Sucursales </a>
                                        </li>
                                        <li>
                                            <a href="#quizzes" data-toggle="tab"> Preguntas </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="branches">
                                            <div class="portlet-body">
                                                <table class="table table-striped table-bordered table-advance table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                Sucursal
                                                                <a href="<?=site_url()?>/branch/action/new/<?=$this->uri->segment(3);?>"><i class="fa fa-plus"></i></a>
                                                            </th>
                                                            <th class="hidden-xs">
                                                                Dirección
                                                            </th>
                                                            <th> </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($branches as $branch) { ?>
                                                        <tr>
                                                            <td>
                                                                <a href="<? echo site_url()?>/branch/action/edit/<?=$branch['branch_id']?>">
                                                                    <?=$branch['branch']?>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <?=$branch['address']?>
                                                                <?if($branch['task_completed']!=''){?>
                                                                    <!-- <span class="label label-success label-sm"> Completada </span> -->
                                                                <?// } else { ?>
                                                                <!--<span class="label label-success label-sm"> Completada </span>-->
                                                                <? } ?>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-sm grey-salsa btn-outline" href="<?=site_url()?>/branch/action/edit/<?=$branch['branch_id']?>"> Editar </a>
                                                            </td>
                                                        </tr>
                                                        <? } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!--tab-pane-->
                                        <div class="tab-pane" id="quizzes">
                                            <div class="tab-pane active" id="tab_1_1_1">
                                                <div class="portlet-body">
                                                <table class="table table-striped table-bordered table-advance table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                Pregunta
                                                                <a href="<?=site_url()?>/quiz/action/new/<?=$this->uri->segment(3);?>"><i class="fa fa-plus"></i></a>
                                                            </th>
                                                            <!-- <th>
                                                                Ver
                                                            </th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($quizzes as $quiz) { ?>
                                                        <tr>
                                                            <td>
                                                                <a href="<? echo site_url()?>/quiz/action/edit/<?=$quiz['quiz_id']?>">
                                                                    <? echo $quiz['question']?>
                                                                </a>
                                                                <br/>
                                                                    Opciones: <a href="<?=site_url()?>/quiz_option/action/new/<?=$this->uri->segment(3);?>"><i class="fa fa-plus"></i></a>
                                                                    <? foreach ($quiz['quiz'] as $opcion) { ?>
                                                                        <a href="<? echo site_url()?>/quiz_option/action/edit/<?=$opcion['quiz_option_id']?>"><?=$opcion['text']?></a>
                                                                    <? } ?>
                                                            </td>
                                                            <!-- <td>
                                                                <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> Ver </a>
                                                            </td> -->
                                                        </tr>
                                                        <? } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            </div>
                                        </div>
                                        <!--tab-pane-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<script>
window.onload = function(){
//
};
</script>
