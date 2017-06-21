<?
    /* variables */

    // comienza el formulario
    $model = $this->uri->segment(1);
    $action = $this->uri->segment(2);
    //$action = $this->uri->segment(3);
    // niveles de usuario
    $nivel = $this->session->userdata('level');
    $user_id = $this->session->userdata('user_id');

    if($title==''){
        $title=$model;
    }

    if($this->uri->segment(3)==''){
        $Id = $this->session->userdata('user_id');
    } else {
        $Id = $this->uri->segment(3);
    }

?>
<!-- BEGIN CONTENT -->
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
                    <span style="text-transform: capitalize;"><?php echo traducir($title) ?></span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title" style="text-transform: capitalize;">
            <?php echo $title ?>

            <div class="actions pull-right">
                <div class="btn-group">
                    <? //if($nivel!=0) { ?>
                    <a class="btn dark btn-outline" href="javascript:history.back();">
                        <i class="fa fa-chevron-left"></i>
                        Volver atras
                    </a><? //} ?>
                </div>
            </div>

        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-body">
                        <?php //if($nivel==0) { ?>
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <? if($action!='reports' && $action!='report') { ?>
                                        <a href="javascript:;" onclick="javascript:actions('new',<?=$Id ?>)" id="" class="btn green">   Agregar nuevo
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <? } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                        </div>
                        <? //} ?>

                        <? if(count($result)>0) { ?>

                        <table class="table table-striped table-hover table-bordered" id="sample_2">
                            <thead>
                                <tr>
                                    <?php foreach ($fields as $field){ //campos ?>
                                        <?php
                                            if (!preg_match("/".$model."_id/i", $field->name) // Muestra todo, excepto el model_id de la tabla
                                                //&& !preg_match("/status/i", $field->name)
                                                && !preg_match("/password/i", $field->name)
                                                && !preg_match("/type/i", $field->name)
                                                && !preg_match("/avatar/i", $field->name)
                                                && !preg_match("/token/i", $field->name)
                                                && !preg_match("/timetocomplete/i", $field->name)
                                                && !preg_match("/task_completed/i", $field->name)
                                                && !preg_match("/task_started/i", $field->name)
                                                && !preg_match("/problem/i", $field->name)
                                                && !preg_match("/company_id/i", $field->name)
                                                && !preg_match("/user_id/i", $field->name)
                                                && !preg_match("/rushhours/i", $field->name)
                                                && !preg_match("/businesshours/i", $field->name)
                                                && !preg_match("/image/i", $field->name)
                                                && !preg_match("/audio/i", $field->name)
                                                && !preg_match("/task_id/i", $field->name)
                                                && !preg_match("/position/i", $field->name)
                                                && !preg_match("/task_taken/i", $field->name)
                                                && !preg_match("/created/i", $field->name)
                                                && !preg_match("/balance_id/i", $field->name)
                                                && !preg_match("/email/i", $field->name)
                                                && !preg_match("/latitude/i", $field->name)
                                                && !preg_match("/longitude/i", $field->name)
                                                && !preg_match("/text/i", $field->name)
                                                && !preg_match("/updateAt/i", $field->name)
                                                && !preg_match("/keyword/i", $field->name)
                                                && !preg_match("/verified/i", $field->name)
                                                && !preg_match("/amount/i", $field->name)
                                            ) {  // campos con "_id" ?>
                                            <th style="text-transform: capitalize;" id="<? echo $field->name ?>">
                                                <?php
                                                    echo traducir($field->name);
                                                ?>
                                            </th>
                                        <? } ?>
                                    <? } ?>
                                    <? if($action!='report') { ?>
                                    <th id="opciones">
                                        Opciones
                                    </th>
                                    <? } ?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($result as $r) { // filas ?>
                                <tr>
                                    <?php foreach ($fields as $f) { // columnas ?>
                                        <?php
                                            if (
                                                !preg_match("/".$model."_id/i", $f->name) // Muestra todo, excepto el model_id de la tabla
                                                //&& !preg_match("/status/i", $f->name)
                                                && !preg_match("/password/i", $f->name)
                                                && !preg_match("/type/i", $f->name)
                                                && !preg_match("/avatar/i", $f->name)
                                                && !preg_match("/token/i", $f->name)
                                                && !preg_match("/email/i", $f->name)
                                                && !preg_match("/timetocomplete/i", $f->name)
                                                && !preg_match("/task_completed/i", $f->name)
                                                && !preg_match("/task_started/i", $f->name)
                                                && !preg_match("/problem/i", $f->name)
                                                && !preg_match("/company_id/i", $f->name)
                                                && !preg_match("/user_id/i", $f->name)
                                                && !preg_match("/rushhours/i", $f->name)
                                                && !preg_match("/businesshours/i", $f->name)
                                                && !preg_match("/image/i", $f->name)
                                                && !preg_match("/required_image/i", $f->name)
                                                && !preg_match("/required_audio/i", $f->name)
                                                && !preg_match("/task_id/i", $f->name)
                                                && !preg_match("/position/i", $f->name)
                                                && !preg_match("/task_taken/i", $f->name)
                                                && !preg_match("/created/i", $f->name)
                                                && !preg_match("/balance_id/i", $f->name)
                                                && !preg_match("/latitude/i", $f->name)
                                                && !preg_match("/longitude/i", $f->name)
                                                && !preg_match("/text/i", $f->name)
                                                && !preg_match("/updateAt/i", $f->name)
                                                && !preg_match("/keyword/i", $f->name)
                                                && !preg_match("/verified/i", $f->name)
                                                && !preg_match("/amount/i", $f->name)

                                            ) {  // campos con "_id" ?>
                                            <td id="<?php echo $f->name ?>">
                                                <?php
                                                    //echo $r[$f->name];
                                                    if (
                                                            preg_match("/task_created/i", $f->name)
                                                        ||  preg_match("/task_taken/i", $f->name)
                                                        ||  preg_match("/valid_to/i", $f->name)
                                                        ||  preg_match("/valid_from/i", $f->name)
                                                        ||  preg_match("/requested/i", $f->name)
                                                    ) {
                                                        /*
                                                        $fecha = mysql_to_unix($r[$f->name]);
                                                        $now = time();
                                                        $units = 2;
                                                        echo 'Hace '.timespan($fecha, $now, $units);
                                                        */
                                                        echo mdate('%d/%m %h:%i', strtotime($r[$f->name]));

                                                    } else if (preg_match("/type/i", $f->name) ) {

                                                        switch ($r['type']) {
                                                            case 0:
                                                                echo 'Usuario';
                                                                break;
                                                            case 1:
                                                                echo 'Administrador';
                                                            default:
                                                                echo "Usuario";
                                                                break;
                                                        }

                                                    } else if (preg_match("/status/i", $f->name) ) {

                                                        switch ($r['status']) {
                                                            case 1:
                                                                echo '<span style="color:gray;">Revision</span>';
                                                                break;
                                                            case 2:
                                                                echo '<span style="color:red;">Transito</span>';
                                                                break;
                                                            case 3:
                                                                echo '<span style="color:green;">Entregado</span>';
                                                                break;
                                                            default:
                                                                echo '<span style="color:orange;">Abierto</span>';
                                                                break;
                                                        }

                                                    } else if (preg_match("/required_image/i", $f->name)) {

                                                        /*$imagen = array(
                                                            'src'   => base_url().'/upload/'.$r['file'],
                                                            'class' => 'img_responsive',
                                                            'width' => '200',
                                                            'height'=> '200',
                                                        );
                                                        echo img($imagen);*/
                                                        echo "Si";

                                                    } else if(preg_match("/price/i", $f->name) || preg_match("/amount/i", $f->name)) {

                                                        echo number_format($r[$f->name],2);

                                                    } else {

                                                        echo $r[$f->name];

                                                    }
                                                ?>
                                            </td>
                                        <? } ?>
                                    <? } ?>
                                    <? if($action!='report') { ?>
                                    <td>
                                        <!-- condicional -->
                                        <? if($action!='reports') { ?>
                                        <!-- fijas -->
                                        <!-- <a class="edit" href="<? echo site_url()?>/<?php echo $model ?>/action/edit/<? echo $r[$model.'_id']?>"> -->
                                        <a class="edit" href="javascript:actions('edit',<?=$r[$model.'_id']?>);">
                                            <i class="fa fa-pencil"></i>
                                            Editar
                                        </a>
                                        <a class="delete" href="javascript:actions('trash',<? echo $r[$model.'_id']?>);">
                                            <i class="fa fa-trash"></i>
                                           Borrar
                                        </a>
                                        <? } ?>
                                    </td>
                                    <? } ?>
                                </tr>
                                <? } ?>
                            </tbody>
                        </table>
                        <!--json -->
                        <? } else {//if/else ?>
                        <h3>No hay datos disponibles</h3>
                        <? } ?>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>

<!-- <div class="modal fade" id="modal-<?=$model?>" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><?=$title?></h4>
            </div>
            <div class="modal-body" style="height:auto !important;min-height:auto;">
                <?=form_open('', ['role'=>"form", 'id'=>'form-'.$model]); ?>
                <?php require_once('forms.php');// campos ?>
                <?php makeaform($forms, $model, $nivel, $action, 'Actualizar', $tables, $user_id) ?>
                <?=form_close(); ?>
            </div>
            <div class="form-actions" style="margin-bottom:30px !important; border-bottom:none !important;">
                <?=form_submit('reset','Borrar', ['class'=>'btn btn-default uppercase pull-right']);?>
                <?=form_submit('submit','Cambiar', ['class'=>'btn btn-success uppercase pull-right', 'id'=> 'btn-'.$model.'']);?>
            </div>
        </div>
    </div>
</div> -->


<!-- END CONTENT -->
<script>
var trash = function(id){
    // confirm delete or not
    if (confirm('Desea eliminar este registro?','Acción requerida')) {
        var Url='<?=site_url()?>/<?=$model?>/delete/'+id;
        $.ajax({
            url: Url,
            method: "GET",
        }).done(function(data) {
            toastr.success('Acción ejecutada con exito!');
            setTimeout(function(){
                location.reload();
            }, 3000);
        });
    } else {
        return false;
    }
}
var edit = function(id){
    var data = [];
    console.log('data', data);
    $.each(data, function (index, value) {
        $('#'+index).val(value);
    });
    $('#password').val('');
}
function actions(action,id){
    switch (action) {
        case "trash":
            trash(id);
            break;
        default:
            window.location.href="<?=site_url()?>/<?=$model?>/action/"+action+"/"+id;
    }
}

<?php if(@$_GET['msg']!='' && @$_GET['code']!='') { ?>
    window.onload = function(){
        toastr.<?=@$_GET['code']?>('<?=@$_GET['msg']?>');
        setTimeout(function(){
            window.location.href="<?=current_url()?>";
        }, 3000);
    }
<? } ?>
</script>
