<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script type="text/javascript" src="<?php echo base_url('assets/');?>ckeditor/ckeditor.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="<?php echo base_url('assets/');?>/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="<?php echo base_url('assets/');?>/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('assets/');?>/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo base_url('assets/');?>/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="<?php echo base_url('assets/');?>/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="<?php echo base_url('assets/');?>/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?php echo base_url('assets/');?>/dist/js/custom.min.js"></script>

<script src="<?php echo base_url('assets/');?>/libs/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url('assets/');?>/libs/select2/dist/js/select2.min.js"></script>
<script src="<?php echo base_url('assets/');?>/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>


<!-- form js -->
<script src="<?php echo base_url('assets/');?>/assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="<?php echo base_url('assets/');?>/dist/js/pages/mask/mask.init.js"></script>
<script src="<?php echo base_url('assets/');?>/assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
<script src="<?php echo base_url('assets/');?>/assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
<script src="<?php echo base_url('assets/');?>/assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
<script src="<?php echo base_url('assets/');?>/assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
<script src="<?php echo base_url('assets/');?>/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url('assets/');?>/assets/libs/quill/dist/quill.min.js"></script>


 <!-- wizard js -->
<script src="<?php echo base_url('assets/');?>/libs/jquery-steps/build/jquery.steps.min.js"></script>
<script src="<?php echo base_url('assets/');?>/libs/jquery-validation/dist/jquery.validate.min.js"></script>

<!--This page JavaScript -->
<script>
    //***********************************//
    // For select 2
    //***********************************//
    $(".select2").select2();

    /*colorpicker*/
    $('.demo').each(function() {
    //
    // Dear reader, it's actually very easy to initialize MiniColors. For example:
    //
    //  $(selector).minicolors();
    //
    // The way I've done it below is just for the demo, so don't get confused
    // by it. Also, data- attributes aren't supported at this time...they're
    // only used for this demo.
    //
    $(this).minicolors({
            control: $(this).attr('data-control') || 'hue',
            position: $(this).attr('data-position') || 'bottom left',

            change: function(value, opacity) {
                if (!value) return;
                if (opacity) value += ', ' + opacity;
                if (typeof console === 'object') {
                    console.log(value);
                }
            },
            theme: 'bootstrap'
        });

    });
    /*datwpicker*/
    jQuery('.mydatepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    var quill = new Quill('#editor', {
        theme: 'snow'
    });

</script>
<script>
    // Basic Example with form
    var form = $("#example-form");
    form.validate({
        errorPlacement: function errorPlacement(error, element) { element.before(error); },
        rules: {
            confirm: {
                equalTo: "#password"
            }
        }
    });
     form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function(event, currentIndex, newIndex) {
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinishing: function(event, currentIndex) {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function(event, currentIndex) {
            alert("Submitted!");
        }
    });
</script>