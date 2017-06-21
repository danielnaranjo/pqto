<?
/* variables */
$title ="";
// comienza el formulario
$model = $this->uri->segment(1);
$action = $this->uri->segment(3);
$nivel = $this->session->userdata('level');
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
                        <div class="col-md-6" id="mapa">
                            <h5>Cargando mapa..</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
window.onload = function(){
    $('#latitude, #longitude').parent().parent().attr('style','display:none;');

    // blanqueo
    //$('#task_id').parent().html('<select id="task_id" name="task_id" class="form-control"><option>Seleccionar</option></select>');
    //$('#company_id').parent().html('<select id="company_id" name="company_id" class="form-control"><option>Seleccionar</option></select>');
    //var company = <?= json_encode($tables['company']) ?>;
    
    <?php if($action=='edit') {?>
        //$('#task_id, #company_id').parent().parent().attr('style','display:none;');
        var data = <? echo json_encode($result) ?>;
        console.log('fire', data);
        $.each(data, function (index, value) {
            $('#'+index).val(value);
        });
        $('#password').val('');
    <?php } ?>
    <?php  
        if($this->uri->segment(4)!='' && $model=='user' && $nivel!=0) { ?>
        $('#property_id').parent().parent().attr('style','display:none;');
        $('#property_id').replaceWith('<input type="hidden" value="<?=$property_id ?>" id="property_id" name="property_id" />');
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

    //https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=YOUR_API_KEY
    $('form #address').parent().append('<small class="help-block">Ejemplo: Av Santa Fe 1769, CABA. Para obtener las coordenadas, haz clic <a href="#" id="getGeo">aqui</a></small>');
    $('#getGeo').on('click', function(){
        var k = 'AIzaSyAjG4vTqfOTigocCXenkGOuv33OPIeqJUI';
        var Url = 'https://maps.googleapis.com/maps/api/geocode/json?key='+k+'&address='+$('#address').val();
        $.getJSON(Url, function(data){
            $('#latitude, #longitude').parent().parent().removeAttr('style');
            $('form #latitude').val(data.results[0].geometry.location.lat);
            $('form #longitude').val(data.results[0].geometry.location.lng);
            $('#mapa').html('<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d410.541450976443!2d'+data.results[0].geometry.location.lng+'!3d'+data.results[0].geometry.location.lat+'!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2sar!4v1480612524635" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>');
            console.log('getGeo', data.results[0]);
        });
    });
};

</script>