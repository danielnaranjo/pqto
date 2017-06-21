<?
/* variables */
$title ="";
// comienza el formulario
$model = $this->uri->segment(1);
$action = $this->uri->segment(3);
$nivel = $this->session->userdata('level');
$ID = $this->uri->segment(4); // http://localhost/pipol/index.php/task/action/new/4

    if($nivel==1) {
        $company_id = $this->session->userdata('company_id');
    } else {
        $company_id = $this->input->get("company_id");
    }

    if($action=='edit'){
        $titulo="Modificar";
        $btn = "Guardar";
        $ejecutar ="update"; //"update/".$this->uri->segment(4);
    } else if($action=='upload'){
        $titulo="Cargar imagen";
        $btn = "Subir imagen";
        $ejecutar ="upload"; //"update/".$this->uri->segment(4);
    } else {
        $titulo="Nuevo";
        $btn = "Guardar";
        $ejecutar = "add";
    }

//$Id=1;
?>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE BAR -->
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
                    <span><?=$titulo?></span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <div class="row">
            <div class="col-md-12">
                <h3>

                </h3>
                <div class="actions pull-right">
                    <div class="btn-group">
                        <a class="btn dark btn-outline" href="javascript:history.back();">
                            <i class="fa fa-chevron-left"></i>
                            Volver atras
                        </a>
                    </div>
                </div>

                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase"><?=$titulo?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="portlet-body form">
                                <!-- necesario si hay upload files -->
                                <?php
                                    if (!preg_match("/_photo/i", $model) ) {
                                        echo form_open($model.'/'.$ejecutar, ['class'=>"form-horizontal", 'role'=>"form"]);
                                    } else {
                                        echo form_open_multipart($model.'/'.$ejecutar.'/'.$company_id, ['class'=>"form-horizontal", 'role'=>"form"]);
                                    }
                                ?>
                                    <?php require_once('formulario.php');// campos ?>
                                    <?php makeaform($fields, $model, $nivel, $action, $btn, $tables, $company_id) ?>
                                <?php echo form_close();?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
window.onload = function(){
    function checkRequired(d){
        if(d=='Y'){
            return 1;
        } else {
            return 0;
        }
    }
    <?php if($action=='edit') {?>
    var data = <? echo json_encode($result) ?>;
    console.log('data', data);
    $.each(data, function (index, value) {
        $('#'+index).val(value);
    });
    //$('#password').val('');
        <? if($model=='task' && $action=='edit'){?>
        $('#valid_from').val((data.valid_from).substring(0, 10));
        $('#valid_to').val((data.valid_to).substring(0, 10));
        $('#required_image').val(checkRequired(data.required_image));
        $('#required_audio').val(checkRequired(data.required_audio));
        $('#task_status').val(checkRequired(data.task_status));
        <? } ?>
    <?php } ?>
    <?php
        if($this->uri->segment(4)!='' && $model=='user' && $nivel!=0) { ?>
        $('#company_id').parent().parent().attr('style','display:none;');
        $('#company_id').replaceWith('<input type="hidden" value="<?=$company_id ?>" id="company_id" name="company_id" />');
    <?php } ?>

    <?php if($action=='upload') {?>
        $("#btn<?=strtoupper($action)?>").attr('disabled',true);
        $("input:file").change(function (){
            var fileName = $(this).val();
            $("#btn<?=strtoupper($action)?>").removeAttr('disabled');
        });
    <?php } ?>

    <?php if($action=='new') {?>
        $("#btn<?=strtoupper($action)?>").attr('disabled',true);
        $("input").change(function (){
            $("#btn<?=strtoupper($action)?>").removeAttr('disabled');
        });
    <?php } ?>

    <?php if($model=='branch') {?>
        //https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=YOUR_API_KEY
        $('form #address').parent().append('<p class="help-block"><a href="#">Obtener geolocalización</a></p>');
    <?php } ?>

    $('#image').on('change', function(){
        $.ajax({
            url : $('#image').val(),
            cache: true,
            processData : false,
        }).always(function(url){
            $("#image").parent().append('<p><img id="preview"/></p>').fadeIn();
            $("#preview").attr("src", $('#image').val()).fadeIn();
            console.log('Ok');
        }).error(function(){
            $("#preview").remove();
            toastr.error('Hay ocurrido un error, por favor, intenta nuevamente');
            console.log('Hay ocurrido un error, por favor, intenta nuevamente');
        });
    })
    <? if($model=='task' && $action=='new' && $ID!=''){?>
        $.getJSON('<?=site_url()?>/company/getUser/<?=$this->uri->segment(4);?>', function(d){
            $('form #user_id').val(d.user_id);
        })
        $('form #task_status').val(1).parent().parent().css('display','none');
        $('form #valid_from').val('<?=date('Y-m-d')?>');
        $('form #valid_to').val('<?=date('Y-m-d')?>');

        $('form #required_image option[value="1"]').text('Si, requiere fotografias');
        $('form #required_audio option[value="1"]').text('Si, requiere grabar audio');

        //console.debug(<?=$this->uri->segment(4)?>);
        //$('form #company_id').val(<?=$ID?>);
    <? } ?>

    <? if($model=='quiz' && $action=='new' && $ID!=''){?>
        $('form #task_id').val(<?=$ID?>).parent().parent().css('display','none');
        $('form #quiz_type option[value="1"]').text('Pregunta abierta');
        $('form #quiz_type option[value="0"]').text('Selección simple');
        console.debug('<?=$this->uri->segment(4)?>', $('form #task_id').val());
    <? } ?>

    <? if($model=='user' && $action=='new'){?>
        //$("form #type").parent().parent().css('display','none');
        $('form #type').val(<?=$this->uri->segment(4)?>).parent().parent().css('display','none');
        $('form #registered').val('<?=date('Y-m-d')?>').parent().parent().css('display','none');
        console.debug('<?=$this->uri->segment(4)?>', $('form #type').val());
    <? } ?>

    <? if($model=='user' && $action=='edit'){?>
        $('form #registered').val(<?=date('Y-m-d')?>).parent().parent().css('display','none');
        $('form #type').parent().parent().css('display','none');
        $('form #email').attr('disabled',true);
        $('form #password').attr('disabled',true);
    <? } ?>

    <? if($model=='package'){?>
        $('form #delivery').val('').parent().parent().css('display','none');
        $('form #origin').attr('readonly',true);
        $('form #tracking').val('<?=$uuid?>').attr('readonly',true);
        if($('form #origin').val()==''){ $('form #origin').val('VE'); }
        $('form #price').parent().parent().css('display','none');
        $('form #service_id').on('change', function(){
            if($('form #service_id').val()==1){
                $('form #price').parent().parent().css('display','none');
                $('form #auction').parent().parent().css('display','none');
            } else {
                $('form #auction').parent().parent().css('display','block');
                $('form #price').parent().parent().css('display','block');
            }
        });
    <? } ?>

    <? if($model=='quiz_option' && $action=='edit'){?>
        $.getJSON("<?=site_url() ?>/quiz_option/opciones/<?=$this->uri->segment(4) ?>", function(data){
            console.debug('preguntas', data);
            var opt = "";
            for(var i=0; i< data.length; i++){
                opt+="<option value="+data[i].quiz_id+">"+data[i].question+" - "+data[i].quiz_id+"</option>";
            }
            $('select#quiz_id').append(opt);
            $('select#quiz_id').val(data[0].quiz_id).change().attr('readonly', true);
        });
    <? } ?>
    <? if($model=='quiz_option' && $action=='new'){?>
        $.getJSON("<?=site_url() ?>/quiz_option/opciones", function(data){
            var opt = "";
            for(var i=0; i< data.length; i++){
                opt+="<option value="+data[i].quiz_id+">"+data[i].question+" - "+data[i].quiz_id+"</option>";
            }
            $('select#quiz_id').append(opt);
        });
    <? } ?>

    <? if($nivel!=1){?>
        /* Olculta el monto a las compañias */
        $('#amount').parent().parent().css('display','none');
    <? } ?>
};

</script>
