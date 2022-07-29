<!-- START: Breadcrumbs-->
<div class="row ">
    <div class="col-12  align-self-center">
        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Manage Staff</h4></div>

            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item active"><a href="#">Staffs</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- END: Breadcrumbs-->

<!-- START: Card Data-->
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header  justify-content-between align-items-center">                               
                <div>
                    <a href="javascript:;" class="btn btn-primary pop rounded-btnt" style="float: right;" pageTitle="Add Employee" pageName="<?php echo base_url('users/staff/manage'); ?>" pageSize="modal-sm"><i class="fa fa-plus-square"></i> </a> </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dtable" class="display table dataTable table-striped table-bordered" >
                        <thead>
                            <tr>
                                <th>Staff ID</th>
                                <th>Name</th>
                                <th>User Role</th>
                                <th>Last Logged</th>
                                <th>Active Status</th>
                                <th width="200px">Action</th>
                            </tr>
                        </thead>
                       <tbody></tbody>
                        
                    </table>
                </div>
            </div>
        </div> 

    </div>                  
</div>
<!-- END: Card DATA--><br><br><br>