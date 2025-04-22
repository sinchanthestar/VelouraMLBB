        <!-- App css -->
        <link href="<?php echo $config['web']['base_url'] ?>assets/css/bootstrap-creative.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
        <link href="<?php echo $config['web']['base_url'] ?>assets/css/app-creative.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
        
        <!-- icons -->
        <link href="<?php echo $config['web']['base_url'] ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
                        
        <!-- Plugins css -->
        <script src="<?php echo $config['web']['base_url'] ?>assets/js/vendor.min.js"></script>
        <script src="<?php echo $config['web']['base_url'] ?>assets/libs/morris-js/morris.min.js"></script>
        <script src="<?php echo $config['web']['base_url'] ?>assets/libs/raphael/raphael.min.js"></script>
        <script src="<?php echo $config['web']['base_url'] ?>assets/js/pages/morris.init.js"></script>
        <link href="<?php echo $config['web']['base_url'] ?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        
        
        <link href="<?php echo $config['web']['base_url'] ?>assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $config['web']['base_url'] ?>assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $config['web']['base_url'] ?>assets/libs/clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $config['web']['base_url'] ?>assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
        <!-- Sweet Alert-->
        <link href="<?php echo $config['web']['base_url'] ?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
        <!-- Lightbox css -->
        <link href="<?php echo $config['web']['base_url'] ?>assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />
        
        <style type="text/css">.hide{display:none!important}.show{display:block!important}</style>
        
        <script type="text/javascript">
        function modal_open(type, url) {
            $('#modal').modal('show');
            if (type == 'add') {
                $('#modal-title').html('<i class="fa fa-plus-square"></i> Tambah Data');
            } else if (type == 'edit') {
                $('#modal-title').html('<i class="fa fa-edit"></i> Ubah Data');
            } else if (type == 'detail') {
                $('#modal-title').html('<i class="fa fa-search"></i> Detail Data');
            } else {
                $('#modal-title').html(type);
            }
            $.ajax({
                type: "GET",
                url: url,
                dataType: "html",
                beforeSuccess: function() {
                    $('#body-result').html('<div class="progress progress-striped active"><div style="width: 100%" class="progress-bar progress-bar-primary"></div></div>');
                },
                success: function($data) {
                    $('#modal-body').html($data);
                }, error: function() {
                    $('#modal-body').html('<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>Terjadi kesalahan!</div>');
                }
            });
        }        
        </script>