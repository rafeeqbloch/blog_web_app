<?php $this->load->view('admin/header'); ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Categories</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/home/index'; ?>">Home</a></li>

                    <li class="breadcrumb-item active"><a href="<?php echo base_url() . 'admin/category/index'; ?>"></a>Categories</li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/category/create'; ?>">Create new categories</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php if ($this->session->flashdata('success') != '') { ?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?> </div>
                <?php } ?>

                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">
                            Create New Category
                        </div>

                    </div>
                    <form method="post" action="<?php echo base_url() . 'admin/category/create'; ?>" id="categoryForm" name="categoryForm" class="categoryForm"  enctype="multipart/form-data">

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" value="" name="name"  class="form-control <?php echo set_value('name');?> <?php echo (form_error('name') != "") ? "is-invalid" : '' ?>">
                                <?php echo form_error('name'); ?>
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label> <br>
                                <input type="file" id="image" name="image" class="<?php echo (!empty($errorImageUpload) != "") ? "is-invalid" : '' ?>">
                                <?php echo (!empty($errorImageUpload)) ? $errorImageUpload:'';?>
                            </div>
                            <div class="custom-control custom-radio float-left">
                                <input type="radio" class="custom-control-input" value="1" id="statusActive" name="status" checked="">
                                <label for="statusActive" class="custom-control-label">Active</label>

                            </div>
                            <div class="custom-control custom-radio float-left ml-5">
                                <input type="radio" class="custom-control-input" value="0" id="statusBlock" name="status">
                                <label for="statusBlock" class="custom-control-label">Block</label>
                            </div>


                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm" name="submit" value="submit">Submit </button>
                            <a href="<?php echo base_url() . 'admin/category/index' ?>" class="btn btn-info btn-sm">Back</a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php $this->load->view('admin/footer'); ?>