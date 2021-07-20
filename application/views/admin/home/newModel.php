
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
                <h3>Add New Model</h3>
                <?php echo form_open_multipart('admin/addModel') ?>
                    <div class="form-group">
                        <?php echo form_input('modelName','',array('placeholder'=>'Enter Model Name','class'=>'form-control')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_textarea('mDes','',array('placeholder'=>'Enter Model Description','class'=>'form-control')); ?>
                    </div>

                    <div class="form-group">
                    <?php 
                    //var_dump($categories->result());
                    $productOptions = array();
                    foreach($products->result() as $product){
                        $productOptions[$product->pId] = $product->pName;

                    }
                    echo form_dropdown('productId',$productOptions,'','class="form-control"');
                    ?>
                    </div>
                    <div class="form-group">
                        <label for="">Price</label>
                        <?php echo form_input('modelPrice','',array('placeholder'=>'Enter Price','class'=>'form-control')); ?>
                    </div>
                    
                    <div class="form-group">
                        <?php echo form_upload('modelDp','',''); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_submit('Add Model','Add Model','class="btn btn-primary"'); ?>
                    </div>
                <?php echo form_close(); ?>    
            </div>
    </div>
</div>