<?php $__env->startSection('content'); ?>
        <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Latest Orders</div>
                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th width="91px">Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <a href="invoice.html">AT2584</a>
                            </td>
                            <td>@Jack</td>
                            <td>$564.00</td>
                            <td>
                                <span class="badge badge-success">Shipped</span>
                            </td>
                            <td>10/07/2017</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="invoice.html">AT2575</a>
                            </td>
                            <td>@Amalia</td>
                            <td>$220.60</td>
                            <td>
                                <span class="badge badge-success">Shipped</span>
                            </td>
                            <td>10/07/2017</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="invoice.html">AT1204</a>
                            </td>
                            <td>@Emma</td>
                            <td>$760.00</td>
                            <td>
                                <span class="badge badge-default">Pending</span>
                            </td>
                            <td>10/07/2017</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="invoice.html">AT7578</a>
                            </td>
                            <td>@James</td>
                            <td>$87.60</td>
                            <td>
                                <span class="badge badge-warning">Expired</span>
                            </td>
                            <td>10/07/2017</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="invoice.html">AT0158</a>
                            </td>
                            <td>@Ava</td>
                            <td>$430.50</td>
                            <td>
                                <span class="badge badge-default">Pending</span>
                            </td>
                            <td>10/07/2017</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="invoice.html">AT0127</a>
                            </td>
                            <td>@Noah</td>
                            <td>$64.00</td>
                            <td>
                                <span class="badge badge-success">Shipped</span>
                            </td>
                            <td>10/07/2017</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.seller', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ecom-530-v2\resources\views/seller/index.blade.php ENDPATH**/ ?>