@extends('layout_master.layout')
@section('content')

<!-- The Modal -->

<div class="kt-subheader  kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Photogapher</h3>
        </div>
    </div>
</div>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-xl-12">
            <table class="table table-striped table-bordered table-sm" id="invoiceTable">
                <thead>
                    <tr>
                        <th>Photographer</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Expertise</th>
                        <th>Rating</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="invoiceList">
                  
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
