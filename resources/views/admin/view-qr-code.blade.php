<x-admin.layout>
    <x-slot name="title" >QR Code</x-slot>
    <x-slot name="breadcrumb">QR Code</x-slot>



    <!-- Add Form -->
    <div class="row" id="addContainer">
        <div class="col-sm-12">
            <div class="card">

                <img src="{{ asset($qrPath) }}" class="img-fluid" style="width: 400px; height: 400px" alt="">

            </div>
        </div>
    </div>

</x-admin.layout>

