<?php 
include 'header.php';

$month = $_GET['m'] ?? 0;
$year = $_GET['y'] ?? 0;


?>

<h3>Teachers & Staffs Salary Management</h3>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                    Select Month & Year and press 'Proceed' to proceed
                </h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Month</label>
                            <div class="col-12">
                                <select class="form-control">
                                    <option>America</option>
                                    <option>Italy</option>
                                    <option>Russia</option>
                                    <option>Britain</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Month</label>
                            <div class="col-12">
                                <select class="form-control">
                                    <option>America</option>
                                    <option>Italy</option>
                                    <option>Russia</option>
                                    <option>Britain</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Month</label>
                            <div class="col-12">
                                <select class="form-control">
                                    <option>America</option>
                                    <option>Italy</option>
                                    <option>Russia</option>
                                    <option>Britain</option>
                                </select>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                    Record found for the month of <b>March, 2024</b>
                </h6>
                <div class="row">

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Ref.</th>
                                    <th>Slot</th>
                                    <th>Category</th>
                                    <th>Cheque</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>332/2024</td>
                                    <td>School</td>
                                    <td>Govt.</td>
                                    <td>SBD 6300383</td>
                                    <td>01 / 04 / 2024</td>
                                    <td class="text-danger"> 226548.00 <i class="mdi mdi-arrow-up"></i></td>
                                    <td><label class="badge badge-danger">Pending</label></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Messsy</td>
                                    <td>Flash</td>
                                    <td class="text-danger"> 21.06% <i class="mdi mdi-arrow-down"></i></td>
                                    <td><label class="badge badge-warning">In progress</label></td>
                                </tr>
                                <tr>
                                    <td>John</td>
                                    <td>Premier</td>
                                    <td class="text-danger"> 35.00% <i class="mdi mdi-arrow-down"></i></td>
                                    <td><label class="badge badge-info">Fixed</label></td>
                                </tr>
                                <tr>
                                    <td>Peter</td>
                                    <td>After effects</td>
                                    <td class="text-success"> 82.00% <i class="mdi mdi-arrow-up"></i></td>
                                    <td><label class="badge badge-success">Completed</label></td>
                                </tr>
                                <tr>
                                    <td>Dave</td>
                                    <td>53275535</td>
                                    <td class="text-success"> 98.05% <i class="mdi mdi-arrow-up"></i></td>
                                    <td><label class="badge badge-warning">In progress</label></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>


<?php 
include 'footer.php';
