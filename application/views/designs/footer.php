<br><br><br><br><br><br><br> </div>
        </main>
        <!-- END: Content-->
        <!-- START: Footer-->
        <footer class="site-footer">
            <?php echo date('Y'); ?> &copy; <?php echo app_name; ?>
        </footer>
        <!-- END: Footer-->


        <!-- START: Back to top-->
        <a href="#" class="scrollup text-center"> 
            <i class="icon-arrow-up"></i>
        </a>
        <!-- END: Back to top-->

 <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>




        <!-- START: Template JS-->
        <script src="<?php echo base_url(); ?>assets/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/vendors/moment/moment.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>    
        <script src="<?php echo base_url(); ?>assets/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
        <!-- END: Template JS-->

        <!-- START: APP JS-->
        <script src="<?php echo base_url(); ?>assets/dist/js/app.js"></script>
        <!-- END: APP JS-->

        <!-- START: Page Vendor JS-->
         <script src="<?php echo base_url(); ?>assets/dist/vendors/datatable/js/jquery.dataTables.min.js"></script> 
        <script src="<?php echo base_url(); ?>assets/dist/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/vendors/datatable/jszip/jszip.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/vendors/datatable/pdfmake/pdfmake.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/vendors/datatable/pdfmake/vfs_fonts.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/vendors/datatable/buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/vendors/datatable/buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/vendors/datatable/buttons/js/buttons.colVis.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/vendors/datatable/buttons/js/buttons.flash.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/vendors/datatable/buttons/js/buttons.html5.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/vendors/datatable/buttons/js/buttons.print.min.js"></script>
        <!-- END: Page Vendor JS-->

        <!-- START: Page Script JS-->        
        <script src="<?php echo base_url(); ?>assets/dist/js/datatable.script.js"></script>
        <!-- END: Page Vendor JS-->

        <!-- START: Page JS-->
        <script src="<?php echo base_url(); ?>assets/dist/js/home.script.js"></script>
        <!-- END: Page JS-->
         <script src="<?php echo base_url(); ?>assets/dist/js/app.filemanager.js"></script>
         
<script src="<?php echo base_url(); ?>assets/dist/js/todo.js"></script>
        
    <script src="<?php echo base_url(); ?>assets/jsform.js"></script>

        <?php if(!empty($table_rec)){ ?>
            <script type="text/javascript">
                  
                $(document).ready(function() {
                    //datatables
                    var table = $('#dtable').DataTable({
                            //"stateSave": true,
                        "processing": true, //Feature control the processing indicator.
                        "serverSide": true, //Feature control DataTables' server-side processing mode.
                        "order": [[<?php if(!empty($order_sort)){echo $order_sort;} ?>]], //Initial order.
                        "language": {
                            "processing": "<i class='fa fa-spinner fa-2x fa-spin' aria-hidden='true'></i> Processing... please wait"
                        },
                        "pagingType": "full",
                
                        // Load data for the table's content from an Ajax source
                        "ajax": {
                            url: "<?php echo base_url($table_rec); ?>",
                            type: "POST"
                        },

                        

                        //Set column definition initialisation properties.
                        "columnDefs": [
                            { 
                                "targets": [<?php if(!empty($no_sort)){echo $no_sort;} ?>], //columns not sortable
                                "orderable": false, //set not orderable
                            },
                        ],
                         pageLength: 10,
                         //lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "Todos"]],
                        stateSave: true,
                        
                       
                    });
                    
                });
            </script>
            
        <?php } ?>
    </body>
    <!-- END: Body-->
</html>
