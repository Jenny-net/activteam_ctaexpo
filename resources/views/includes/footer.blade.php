<!--JS Start here -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/js/all.min.js"></script> -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="{{ asset('/public/admin/js/bootstrap.min.js') }}"></script>


<!-- Custom Scrollbar Js -->
<script src="{{ asset('/public/admin/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>

<!-- Data Tables JS -->
<script src="{{ asset('/public/admin/js/datatables.min.js') }}"></script>
<script src="{{ asset('/public/admin/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('/public/admin/js/datatables-init.js') }}"></script>

<!-- Page Loader JS -->
<script src="{{ asset('/public/admin/js/pace.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>


<!-- Custome js -->
<script src="{{ asset('/public/admin/js/custom.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.counterup/1.0/jquery.counterup.min.js"></script>
<script type="text/javascript" src="{{ asset('/public/assets/tinymce/js/tinymce/tinymce.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
<!-- <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script> -->

<script src="https://activteam.com/public/admin/texteditor/ckeditor.js"></script>

<script>
    $('.counter').counterUp({
        delay: 10,
        time: 4000
    });
    $('.counter').addClass('animated fadeInDownBig');
    $('h3').addClass('animated fadeIn');
</script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
    integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>

<script>
    var fixHelperModified = function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index) {
                $(this).width($originals.eq(index).width())
            });
            return $helper;
        },
        updateIndex = function(e, ui) {
            $('td.index', ui.item.parent()).each(function(i) {
                $(this).html(i + 1);
            });
            $('input[type=text]', ui.item.parent()).each(function(i) {
                $(this).val(i + 1);
            });
        };

    $("#bootstrap-data-table tbody").sortable({
        helper: fixHelperModified,
        stop: updateIndex
    }).disableSelection();

    $("tbody").sortable({
        distance: 5,
        delay: 100,
        opacity: 0.6,
        cursor: 'move',
        update: function() {}
    });
</script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
