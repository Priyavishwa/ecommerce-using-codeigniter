<?php  ?>

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
                <h2>All Models</h2>
                <div class="error">
                </div>
                <?php if($allModels): ?>
                
                <table class="table table-dashed">
                <th>Id</th>
                <th>Model Name</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
                <?php foreach($allModels as $model): ?>
                    <tr class="ccat <?php echo $model->mId; ?>">
                        <td>
                            <?php echo $model->mId; ?>
                        </td>
                        <td>
                            <?php echo $model->mName; ?>
                        </td>
                        <td>
                            <?php echo $model->mDescription; ?>
                        </td>
                        <td>
                            <a href="<?php echo site_url('admin/editModel/'.$model->mId); ?>" class="btn btn-info">
                                Edit
                            </a>    
                        </td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-danger delmodel" 
                            data-id="<?php $model->mId; ?>" data-text="<?php echo $this->encryption->encrypt($model->mId); ?>">
                                Delete
                            </a>
                        </td>
                </tr>    
                <?php endforeach; ?>
                </table>
                <?php echo $link; ?>
                <?php else: ?>
                model not available
                
                <?php endif;  ?>  
            </div>
    </div>
</div>