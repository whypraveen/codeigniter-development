<div class="wrapper">
    <?php echo getNotification(); ?>
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group pull-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Password Manager</a></li>
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <h4 class="m-t-0 header-title"><b>Archived Customers</b></h4>
                    <a href="#" data-toggle="modal" data-target="#add" class="btn btn-success pull-right">Add Customer</a>
                    <?php if (!empty($customer_list)): ?>
                        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Customer ID Name</th>
                                    <th>Customer Name</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($customer_list as $each): ?>
                                    <?php $assets = getAssets($each->CustID); ?>
                                    <?php $contact = getContact($each->CustID); ?>
                                    <tr class="<?php echo ($i % 2 == 0) ? ('even') : ('odd'); ?>">
                                        <td><a href="#info_<?php echo $i; ?>" class="collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="info_<?php echo $i; ?>"><span class="row-details row-details-close"></span></a></td>
                                        <td><?php echo $each->CustIDName; ?></td>
                                        <td><?php echo $each->CustName; ?></td>
                                        <td><a href="javascript:void(0);" id="status_<?php echo $each->CustID; ?>"><span class="btn <?php echo ($each->IsActive) ? ('btn-info') : ('btn-warning'); ?>"><i class="fa <?php echo ($each->IsActive) ? ('fa-check') : ('fa-times'); ?>"></i> <?php echo ($each->IsActive) ? ('Active') : ('InActive'); ?></span></td>
                                        <td><a id="editcustomer_<?php echo $each->CustID; ?>" href="javascript:void(0);" data-toggel="modal" data-target="#edit" class="btn btn-icon waves-effect waves-light btn-purple"><i class="fa fa-pencil"></i></a>&nbsp;
                                            <a id="delCustomer_<?php echo $each->CustID; ?>" href="javascript:void(0);" data-toggel="modal" data-target="#delete" class="btn btn-icon waves-effect waves-light btn-danger"><i class="fa fa-trash-o"></i></a>&nbsp;
                                            <a id="assets_<?php echo $each->CustID; ?>" href="javascript:void(0);" data-toggle="modal" data-target="#addAssets" class="btn btn-primary"><i class="fa fa-plus"></i> Assets</a>&nbsp;
                                            <a id="contact_<?php echo $each->CustID; ?>" href="javascript:void(0);" data-toggle="modal" data-target="#addContact" class="btn btn-primary"><i class="fa fa-plus"></i> Contact</a>
                                        </td>
                                    </tr>
                                    <tr class="collapse" id="info_<?php echo $i; ?>">
                                        <td colspan="11">    
                                            <div class="card card-body">
                                                <div class="col-lg-12 pad0">
                                                    <ul class="nav nav-tabs">
                                                        <li class="nav-item">
                                                            <a href="#assetsTable_<?php echo $i; ?>" class="nav-link active" data-toggle="tab" aria-expanded="false">
                                                                Assets
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="#contactTable_<?php echo $i; ?>" class="nav-link" data-toggle="tab" aria-expanded="false">
                                                                Contact
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div id="assetsTable_<?php echo $i; ?>" class="tab-pane active show">
                                                            <?php if ($assets): ?>
                                                                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                            <th>Name</th>
                                                                            <th>URL</th>
                                                                            <th>User Name</th>
                                                                            <th>Password</th>
                                                                            <th>Start Date</th>
                                                                            <th>Expiry Date</th>
                                                                            <th>Amount</th>
                                                                            <th>Renewal Amount</th>
                                                                            <th>Notes</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php $a = 1; ?>
                                                                        <?php foreach ($assets as $list): ?>
                                                                            <tr>
                                                                                <td><?php echo $a; ?></td>
                                                                                <td><?php echo $list->AssetName; ?></td>
                                                                                <td><?php echo $list->AssetURL; ?></td>
                                                                                <td><?php echo $list->AssetUsername; ?></td>
                                                                                <td><?php echo $list->AssetPassword; ?></td>
                                                                                <td><?php echo $list->AssetStartDate; ?></td>
                                                                                <td><?php echo $list->AssetExpiryDate; ?></td>
                                                                                <td><?php echo $list->AssetAmount; ?></td>
                                                                                <td><?php echo $list->AssetRenewalAmount; ?></td>
                                                                                <td><?php echo $list->Notes; ?></td>

                                                                                <td><a id="editAssets_<?php echo $list->AssetID; ?>" href="javascript:void(0);" data-toggel="modal" data-target="#editAssets" class="btn btn-icon waves-effect waves-light btn-purple"><i class="fa fa-pencil"></i></a>&nbsp;
                                                                                    <a id="delAssets_<?php echo $list->AssetID; ?>" href="javascript:void(0);" data-toggel="modal" data-target="#deleteAssets" class="btn btn-icon waves-effect waves-light btn-danger"><i class="fa fa-trash-o"></i></a>&nbsp;
                                                                                </td>
                                                                            </tr>
                                                                            <?php $a++; ?>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            <?php else: ?>
                                                                <div class="alert alert-error text-center">
                                                                    <p>No Record Found!!!</p>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div id="contactTable_<?php echo $i; ?>" class="tab-pane">
                                                            <?php if ($contact): ?>
                                                                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                            <th>Name</th>
                                                                            <th>Email</th>
                                                                            <th>Address 1</th>
                                                                            <th>Address 2</th>
                                                                            <th>City</th>
                                                                            <th>Country</th>
                                                                            <th>Phone</th>
                                                                            <th>Fax</th>
                                                                            <th>Mobile 1</th>
                                                                            <th>Mobile 2</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php $a = 1; ?>
                                                                        <?php foreach ($contact as $clist): ?>
                                                                            <tr>
                                                                                <td><?php echo $a; ?></td>
                                                                                <td><?php echo $clist->ContactName; ?></td>
                                                                                <td><?php echo $clist->ContactEmail; ?></td>
                                                                                <td><?php echo $clist->ContactAddress1; ?></td>
                                                                                <td><?php echo $clist->ContactAddress2; ?></td>
                                                                                <td><?php echo $clist->ContactCity; ?></td>
                                                                                <td><?php echo $clist->ContactCountry; ?></td>
                                                                                <td><?php echo $clist->ContactPhone; ?></td>
                                                                                <td><?php echo $clist->ContactPhone; ?></td>
                                                                                <td><?php echo $clist->ContactMobile1; ?></td>
                                                                                <td><?php echo $clist->ContactMobile2; ?></td>

                                                                                <td><a id="editContact_<?php echo $clist->ContactID; ?>" href="javascript:void(0);" data-toggel="modal" data-target="#editContact" class="btn btn-icon waves-effect waves-light btn-purple"><i class="fa fa-pencil"></i></a>&nbsp;
                                                                                    <a id="delContact_<?php echo $clist->ContactID; ?>" href="javascript:void(0);" data-toggel="modal" data-target="#deleteContact" class="btn btn-icon waves-effect waves-light btn-danger"><i class="fa fa-trash-o"></i></a>&nbsp;
                                                                                </td>
                                                                            </tr>
                                                                            <?php $a++; ?>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            <?php else: ?>
                                                                <div class="alert alert-error text-center">
                                                                    <p>No Record Found!!!</p>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="alert alert-info text-center">
                            <strong>Oh snap!</strong> <p>No record found!!</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- end row -->

    </div> <!-- end container -->
</div>
<!-- end wrapper -->
<div id="add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0">Add Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="<?php echo site_url('dashboard'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Customer ID Name</label>
                                <input type="text" class="form-control" id="customer_id_name" name="customer_id_name" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Customer Name</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" required="" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" name="save" value="save" class="btn btn-info waves-effect waves-light">Save</button>
                </div>
            </form>    
        </div>
    </div>
</div>
<div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0">Edit Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form name="editcustomer" action="<?php echo site_url('dashboard/edit'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Customer ID Name</label>
                                <input type="text" class="form-control" id="customer_id_name" name="customer_id_name" value="" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Customer Name</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" value="" required="" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="cid" name="cid" value="" />
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" name="update" value="update" class="btn btn-info waves-effect waves-light">Update</button>
                </div>
            </form>    
        </div>
    </div>
</div>
<div id="delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0">Remove Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form name="deletecustomer" action="<?php echo site_url('dashboard/delete'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger text-center">
                                <strong> Are You sure you want to delete this customer...</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="cid" name="cid" value="" />
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" name="delete" value="delete" class="btn btn-info waves-effect waves-light">Delete</button>
                </div>
            </form>    
        </div>
    </div>
</div>
<div id="addAssets" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0">Add Assets</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form name="assets" action="<?php echo site_url('dashboard/assets'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_name" class="control-label">Name</label>
                                <input type="text" class="form-control" id="asset_name" name="asset_name" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_url" class="control-label">URL</label>
                                <input type="url" class="form-control" id="asset_url" name="asset_url" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_user_name" class="control-label">User Name</label>
                                <input type="text" class="form-control" id="asset_user_name" name="asset_user_name" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_password" class="control-label">Password</label>
                                <input type="text" class="form-control" id="asset_password" name="asset_password" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_start_date" class="control-label">Start Date</label>
                                <input type="date" class="form-control" id="asset_start_date" name="asset_start_date" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_expiry_date" class="control-label">Expiry Date</label>
                                <input type="date" class="form-control" id="asset_expiry_date" name="asset_expiry_date" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_amount" class="control-label">Amount</label>
                                <input type="number" class="form-control" id="asset_amount" name="asset_amount" min="0" step="1" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_renewal_amount" class="control-label">Renewal Amount</label>
                                <input type="number" class="form-control" id="asset_renewal_amount" name="asset_renewal_amount" min="0" step="1" required="" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="asset_expiry_date" class="control-label">Notes</label>
                                <textarea class="form-control" id="notes" name="notes" rows="5" maxlength="200"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="cid" name="cid" value="" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="save" value="save" class="btn btn-info">Save</button>
                </div>
            </form>    
        </div>
    </div>
</div>
<div id="editAssets" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0">Edit Assets</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form name="assets" action="<?php echo site_url('dashboard/editAssets'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_name" class="control-label">Name</label>
                                <input type="text" class="form-control" id="asset_name" name="asset_name" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_url" class="control-label">URL</label>
                                <input type="url" class="form-control" id="asset_url" name="asset_url" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_user_name" class="control-label">User Name</label>
                                <input type="text" class="form-control" id="asset_user_name" name="asset_user_name" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_password" class="control-label">Password</label>
                                <input type="text" class="form-control" id="asset_password" name="asset_password" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_start_date" class="control-label">Start Date</label>
                                <input type="date" class="form-control" id="asset_start_date" name="asset_start_date" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_expiry_date" class="control-label">Expiry Date</label>
                                <input type="date" class="form-control" id="asset_expiry_date" name="asset_expiry_date" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_amount" class="control-label">Amount</label>
                                <input type="number" class="form-control" id="asset_amount" name="asset_amount" min="0" step="1" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset_renewal_amount" class="control-label">Renewal Amount</label>
                                <input type="number" class="form-control" id="asset_renewal_amount" name="asset_renewal_amount" min="0" step="1" required="" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="asset_expiry_date" class="control-label">Notes</label>
                                <textarea class="form-control" id="notes" name="notes" rows="5" maxlength="200"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="aid" name="aid" value="" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="save" value="save" class="btn btn-info">Update</button>
                </div>
            </form>    
        </div>
    </div>
</div>
<div id="addContact" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0">Add Contact</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form name="contact" action="<?php echo site_url('dashboard/contact'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="customer_contact_name" class="control-label">Name</label>
                                <input type="text" class="form-control" id="customer_contact_name" name="customer_contact_name" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="customer_contact_email" class="control-label">Email</label>
                                <input type="email" class="form-control" id="customer_contact_email" name="customer_contact_email" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address1" class="control-label">Address 1</label>
                                <textarea class="form-control" id="address1" name="address1" rows="5" maxlength="100" required=""></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address2" class="control-label">Address 2</label>
                                <textarea class="form-control" id="address2" name="address2" rows="5" maxlength="100"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city" class="control-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country" class="control-label">Country</label>
                                <input type="text" class="form-control" id="country" name="country" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone" class="control-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fax" class="control-label">Fax</label>
                                <input type="text" class="form-control" id="fax" name="fax" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile1" class="control-label">Mobile 1</label>
                                <input type="text" class="form-control" id="mobile1" name="mobile1" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile2" class="control-label">Mobile 2</label>
                                <input type="text" class="form-control" id="mobile2" name="mobile2" />
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="customer_id" name="customer_id" value="" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="save" value="save" class="btn btn-info">Save</button>
                </div>
            </form>    
        </div>
    </div>
</div>
<div id="editContact" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0">Edit Contact</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form name="contact" action="<?php echo site_url('dashboard/editContact'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="customer_contact_name" class="control-label">Name</label>
                                <input type="text" class="form-control" id="customer_contact_name" name="customer_contact_name" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="customer_contact_email" class="control-label">Email</label>
                                <input type="email" class="form-control" id="customer_contact_email" name="customer_contact_email" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address1" class="control-label">Address 1</label>
                                <textarea class="form-control" id="address1" name="address1" rows="5" maxlength="100" required=""></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address2" class="control-label">Address 2</label>
                                <textarea class="form-control" id="address2" name="address2" rows="5" maxlength="100"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city" class="control-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country" class="control-label">Country</label>
                                <input type="text" class="form-control" id="country" name="country" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone" class="control-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fax" class="control-label">Fax</label>
                                <input type="text" class="form-control" id="fax" name="fax" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile1" class="control-label">Mobile 1</label>
                                <input type="text" class="form-control" id="mobile1" name="mobile1" required="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile2" class="control-label">Mobile 2</label>
                                <input type="text" class="form-control" id="mobile2" name="mobile2" />
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="ccid" name="ccid" value="" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="update" value="update" class="btn btn-info">Update</button>
                </div>
            </form>    
        </div>
    </div>
</div>

<div id="deleteAssets" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0">Remove Assets</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form name="deletecustomer" action="<?php echo site_url('dashboard/deleteAssets'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger text-center">
                                <strong> Are You sure you want to delete this assets...</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="assets_id" name="assets_id" value="" />
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" name="delete" value="delete" class="btn btn-info waves-effect waves-light">Delete</button>
                </div>
            </form>    
        </div>
    </div>
</div>
<div id="deleteContact" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0">Remove Contact</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form name="deletecustomer" action="<?php echo site_url('dashboard/deleteContact'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger text-center">
                                <strong> Are You sure you want to delete this contact...</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="contactID" name="contactID" value="" />
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" name="delete" value="delete" class="btn btn-info waves-effect waves-light">Delete</button>
                </div>
            </form>    
        </div>
    </div>
</div>