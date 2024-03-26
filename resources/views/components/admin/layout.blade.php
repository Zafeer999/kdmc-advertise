<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <link href="{{ asset('admin/dist/images/logo.svg') }}" rel="shortcut icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Rubick admin is super flexible, powerful, clean & modern responsive bootstrap admin template with unlimited possibilities." />
    <meta name="keywords" content="admin template, Rubick Admin Template, dashboard template, flat admin template, responsive admin template, web app" />
    <meta name="author" content="LEFT4CODE" />
    <title>{{ config('app.name') }} {{ $title ?? 'Dashboard' }}</title>
    <link rel="stylesheet" href="{{ asset('admin/dist/css/app.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- New DATATABLE CSS --}}
    <link rel="stylesheet" href="{{ asset('admin/vendor/datatables/media/css/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/vendor/datatables/media/css/datatables.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/dist/css/custom.css') }}" />
</head>

@stack('styles')

<body class="main">

    <x-admin.mobile-nav />

    <div class="d-flex">
        <x-admin.sidebar />

        <div class="content">

            <x-admin.header breadcrumb="{{ $breadcrumb ?? 'Dashboard' }}" />

            {{ $slot }}

        </div>

    </div>

    <x-admin.footer />


    <section>
        <div id="myModal" class="modal">

            <!-- The Close Button -->
            <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>

            <!-- Modal Content (The Image) -->
            <img class="modal-content" id="img01">

            <!-- Modal Caption (Image Text) -->
            <div id="caption"></div>
        </div>
    </section>

</body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- NEW DATATABLE JS --}}
    <script src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/js/datatable.custom.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin/js/examples/examples.datatables.default.js') }}"></script>
    <script src="{{ asset('admin/js/examples/examples.datatables.row.with.details.js') }}"></script>
    <script src="{{ asset('admin/js/examples/examples.datatables.tabletools.js') }}"></script>

    @stack('scripts')


    {{-- SCROLL PAGE EVENT LISTENER --}}
    <script>
        window.addEventListener('swal:modal', event => {
            swal({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
            });
        });
        window.addEventListener('validate:scroll-to', (ev) => {
            ev.stopPropagation();
            let selector = ev?.detail?.query;
            if (!selector) {
                return;
            }
            console.log(selector);
            $('html, body').animate({
                scrollTop: $(selector).offset().top - 150
            }, 1000);

        }, false);
    </script>

    {{-- Script to show image in preview modal --}}
    <script>
        var modal = document.getElementById('myModal');

        var img = $('.myImg');
        var modalImg = $("#img01");
        var captionText = document.getElementById("caption");
        $('.myImg').click(function() {
            modal.style.display = "block";
            var newSrc = this.src;
            modalImg.attr('src', newSrc);
            captionText.innerHTML = this.alt;
        });

        var span = document.getElementsByClassName("close")[0];

        span.onclick = function() {
            modal.style.display = "none";
        }
    </script>

    {{-- AddForm n EditForm Open/Close jquery --}}
    <script>
        $(document).ready(function() {

            $("#btnCancel").click(function() {
                $("#addContainer").slideUp();
                $("#editContainer").slideUp();
                $(this).hide();
                $("#addToTable").show();
            });
        });

        $(document).ready(function() {
            $("#addToTable").click(function(e) {
                e.preventDefault();
                // var id = $(this).attr('data-id');
                $("#addContainer").slideDown();
                $("#editContainer").slideUp();
                $("#btnCancel").show();

            });
        });
    </script>

    {{-- Add / Update Form validation --}}
    <script>
        function resetErrors() {
            var form = document.getElementById('addForm');
            if(form)
            {
                var data = new FormData(form);
                for (var [key, value] of data) {
                    var field = key.replace('[]', '');
                    $('.' + field + '_err').text('');
                    $("[name='"+field+"']").removeClass('is-invalid');
                    $("[name='"+field+"']").addClass('is-valid');
                }
            }
        }

        function printErrMsg(msg) {
            $.each(msg, function(key, value) {
                var field = key.replace('[]', '');
                $('.' + field + '_err').text(value);
                $("[name='"+field+"']").addClass('is-invalid');
                $("[name='"+field+"']").removeClass('is-valid');
            });
        }

        function resetErrors() {
            var form = document.getElementById('editForm');
            if(form){
                var data = new FormData(form);
                for (var [key, value] of data) {
                    var field = key.replace('[]', '');
                    $('.' + field + '_err').text('');
                    $("[name='"+field+"']").removeClass('is-invalid');
                    $("[name='"+field+"']").addClass('is-valid');
                }
            }
        }

        function editFormBehaviour() {
            $("#addContainer").slideUp();
            $("#btnCancel").show();
            $("#addToTable").hide();
            $("#editContainer").slideDown();
            $("html, body").animate({ scrollTop: 0 }, "slow");
        }
    </script>

</html>
