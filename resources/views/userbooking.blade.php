@extends('layout_master.layout')
@section('content')

<!-- The Modal -->

<div class="kt-subheader  kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Bookings</h3>
        </div>
    </div>
</div>


<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-xl-12">
            <table class="table table-striped table-bordered table-sm" id="invoiceTable">
                <thead>
                    <tr>
                        <th>Subscriber</th>
                        <th>Photographer</th>
                        <th>Location (Long / Lat)</th>
                        <th>Date & Time</th>
                        <th>Payment Amt</th>
                        <th>Payment Mode</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($bookings as $booking)
                    <tr>
                      <td>{{$booking->udetails[0]->fullname}}</td>
                      <td>{{$booking->pdetails[0]->fullname}}</td>
                      <td>{{$booking->currentlang_lat[0]}}, {{$booking->currentlang_lat[0]}}</td>
                      <td>{{date('F jS, Y', strtotime($booking->created_at))}}</td>
                      <td>{{$booking->estimatePaymenyt}}</td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
    $(".kt-menu__item").each(function(){
      $(this).removeClass('kt-menu__item--active');
    })
    $("#booking").addClass('kt-menu__item--active');
  })
</script>
@endsection
