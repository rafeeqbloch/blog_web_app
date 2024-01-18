<?php $this->load->view('admin/header');?>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
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
            <div class="card">
            <?php if ($this->session->flashdata('success')!="") {?>
<div class="alert alert-success"> <?php echo $this->session->flashdata('success');?></div>
              <?php }?>
              <?php if ($this->session->flashdata('error')!="") {?>
<div class="alert alert-danger"> <?php echo $this->session->flashdata('error');?></div>
              <?php }?>
             <div class="card-header">
                <div class="card-title">
                <form id="searchForm" method="get" name="searchForm" action=""> 
                    <div class="input-group mb-0">
                    <input type="text" id="query" value="<?php echo $queryString; ?>" name="q" placeholder="Search">
                    <div class="input-group-append">
                    <button class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></button>
                    </div>
                    </div>
                </form>
                </div>
                <div class="card-tools">
                  <a href="<?php echo base_url().'admin/category/create' ?>" class="btn btn-primary btn-sm">
                   <i class="fas fa-plus"></i> Create</a>
                </div>
             </div>
             <div class="card-body">
              <table class="table">
                <tr>
                  <th width="50" >#</th>
                  <th>Name</th>
                  <th width="100">Status</th>
                  <th width="160" class="text-center" >Action</th>

                </tr>
                <?php if(!empty($categories)){?>
                  <?php foreach($categories as $categoryRow){?>

                <tr>
                  <td><?php echo $categoryRow['id']?></td>
                  <td><?php echo $categoryRow['name']?></td>
                  <td>
                    <?php if($categoryRow['status']==1){?>
                    <span class="badge badge-success">Active</span>
                    <?php }?>
                    <?php if($categoryRow['status']==0){?>
                    <span class="badge badge-danger">Block</span>
                    <?php }?>

                  </td>
                  <td>
                    <a href="<?php echo base_url().'admin/category/edit/'.$categoryRow['id']?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>Edit</a>
                    <a href="javascript:void(0)"; onclick="deleteCategory(<?php echo $categoryRow['id']; ?>)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Delete</a>
                  </td>
                </tr>
                <?php }?>
                <?php } else{?>

                  <tr>
                    <td colspan="4">Records Not Found</td>
                  </tr>
                  <?php }?>
              
              </table>
             </div>
            </div>

            
          </div>
          <!-- /.col-md-6 -->

          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('admin/footer');?>

<script>
function deleteCategory(id) {
    console.log('Base URL:', "<?php echo base_url(); ?>");
    console.log('Category ID:', id);

    if (confirm('Are you sure you want to delete category?' + id)) {
        window.location.href = "<?php echo base_url() . 'admin/category/delete/'; ?>" + id;
    }
}

</script>