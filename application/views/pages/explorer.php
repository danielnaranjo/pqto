<?
    /* variables */

    // comienza el formulario
    $model = $this->uri->segment(1);
    $action = $this->uri->segment(2);
    // niveles de usuario
    $nivel = $this->session->userdata('level');

    if($title==''){
        $title=$model;
    }

    if($this->uri->segment(3)==''){
        $Id = $this->session->userdata('company_id');
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
                    <a class="btn dark btn-outline" href="javascript:history.back();">
                        <i class="fa fa-chevron-left"></i>
                        Volver atras
                    </a>
                </div>
            </div>

        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-body">
                        <div class="row">
                            <? if(count($result)>0) { ?>
                            <?php foreach($result as $r): ?>
                            <div class="col-md-4" style="margin-bottom:10px;">
                                <!--begin: widget 1-1 -->
                                <div class="mt-widget-1">
                                    <? if(@$r['package_id']) { ?>
                                    <div class="mt-icon">
                                        <a href="javascript:take(<?=$r['package_id']?>)">
                                            <i class="fa fa-truck"></i>
                                        </a>
                                    </div>
                                    <? } ?>
                                    <div class="mt-img">
                                        <img src="<?php echo base_url()?>assets/layouts/layout/img/photo1.jpg">
                                    </div>
                                    <div class="mt-body">
                                        <h3 class="mt-username">
                                            <a href="#"><?=$r['user']?></a>
                                        </h3>
                                        <p class="mt-user-title">
                                            <? if(@$r['package_id']) { ?>
                                            <?=$r['title']?><br/>
                                            <strong><?=$r['type']?></strong>
                                            <? } ?>
                                        </p>
                                        <div class="mt-stats">
                                            <div class="btn-group btn-group btn-group-justified">
                                                <a href="javascript:;" class="btn">
                                                    <? if(@$r['package_id']) { ?>

                                                    <?if(@$r['price']>0){ ?>
                                                        <?=number_format(@$r['price'],2);?>
                                                        <?if(@$r['auction']=='Y'){ ?><i class="fa fa-fire text-yellow" style="top:0;"></i><? } ?>
                                                    <? } else { ?>
                                                        <strong>Gratis</strong>
                                                    <? } ?>
                                                    <? } ?>
                                                    <? if(@$r['downvotes']) { ?>
                                                        <i class="fa fa-thumbs-o-down" style="top:0;"></i>
                                                        <?=@$r['downvotes']?>
                                                    <? } ?>
                                                </a>
                                                <? if(@$comments) { ?>
                                                <a href="javascript:;" class="btn">
                                                    <i class="fa fa-comments" style="top:0;"></i>
                                                    <?=count($comments)?>
                                                </a>
                                                <? } ?>
                                                <a href="javascript:;" class="btn">
                                                    <? if(@$r['package_id']) { ?>
                                                    <?=@$r['origin']?>
                                                    <i class="fa fa-angle-double-right" aria-hidden="true" style="top:0;"></i>
                                                    <?=@$r['name']?>
                                                    <? } ?>
                                                    <? if(@$r['upvotes']) { ?>
                                                        <i class="fa fa-thumbs-o-up" style="top:0;"></i>
                                                        <?=@$r['upvotes']?>
                                                    <? } ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end: widget 1-1 -->
                            </div>
                            <?php endforeach; ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->


<div class="modal fade" id="open-package" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body" style="height:auto !important;min-height:auto;">
                <h2></h2>
                <p></p>
                <dd></dd>
                <dt></dt>
            </div>
            <div class="modal-footer">
                <div class="form-actions" style="margin-bottom:30px !important; border-bottom:none !important;">
                    <?=form_submit('submit','Tomar este Paqueto', ['class'=>'btn btn-default uppercase pull-right', 'id'=> 'takePackage']);?>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    window.onload = function(){
        $('#takePackage').on('click',function(){
            toastr.success('Haz tomado el paquete!');
            $('#open-package').modal('hide');
            setTimeout(function(){
                window.location.href="<?=current_url()?>?take=1";
            }, 3000);
        })
    }
    var take = function(id){
        $.getJSON('<?=site_url()?>/package/view/'+id, function(d){
            console.log('d', d);
            $('#open-package .modal-title').html('Pais de destino: '+d.destination);
            $('#open-package .modal-body h2').html(d.title);
            $('#open-package .modal-body p').html(d.description);
            $('#open-package .modal-body dd').html('Tipo de servicio: '+d.service_id);
            $('#open-package .modal-body dt').html('Publicado el '+d.created);
            $('#open-package').modal('show');
        })

    }
</script>
