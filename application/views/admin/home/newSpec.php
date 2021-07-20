<?php
?>


<div class="content-wrapper">
    <div class="row padtop">
            <div class="col-md-6 col-md-offset-3">
            <?php if($this->session->flashdata('class')): ?>
            <div class="alert <?php echo $this->session->flashdata('class')?> alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"></span></button>
                <?php echo $this->session->flashdata('message');?>
            </div>
            <?php endif; ?>
                <h3>Add New Specs</h3>
                <?php echo form_open_multipart('admin/addSpec') ?>
                <div class="form-group">
                    <?php 
                    //var_dump($categories->result());
                    $categoriesOptions = array();
                    foreach($models->result() as $model){
                        $modelOptions[$model->mId] = $model->mName;

                    }
                    echo form_dropdown('modelId',$modelOptions,'','class="form-control"');
                    ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_input('sp_name','',array('placeholder'=>'Enter Spec Name','class'=>'form-control')); ?>
                    </div>
                    <div class="htmlitem">
                        <div class="form-group contspecvalue">
                            <?php echo form_input('sp_value[]','',array('placeholder'=>'Enter Spec value','class'=>'form-control sp_cn')); ?>
                            <a href="javascript:void(0)" class="add_spec">+</a>
                        </div>
                    </div>

                    
                   
                    <div class="form-group">
                        <?php echo form_submit('Add Spec','Add Spec','class="btn btn-primary"'); ?>
                    </div>
                <?php echo form_close(); ?>    
            </div>
    </div>
</div>