@extends('layout_master.layout')
@section('content')

<style type="text/css">
  label {
    text-shadow: none!important;
    font-size: 14px;
    font-weight: 300;
    padding: 3px 0px;
  }
  h5{
    margin-bottom: 10px;
  }
</style>
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Single Bookings</h3>
        </div>
    </div>
</div>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-md-12">
            <h5><u>Booking Details</u></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>Date: <b>{{date('F jS, Y', strtotime($photographers[0]->created_at))}}</b></label>
        </div>
        <div class="col-md-6">
            <label for="">Status: 
                @if($photographers[0]->completeFlag == 1) 
                <b> Active </b>
                @elseif($photographers[0]->confirmFlag == 1)
                <b> Done </b>
                @else
                <b> Not Active </b>
                @endif
            </label>
        </div>
        <div class="col-md-6">
            <label>Message: <b>{{$photographers[0]->bookingMsg}}</b></label>
        </div>
        <div class="col-md-6">
            <label>Location: <b> @if(!empty($photographers[0]->currentlang_lat[0])) {{ $photographers[0]->currentlang_lat[0] }} @endif</b>, <b> @if(!empty($photographers[0]->currentlang_lat[1])) {{ $photographers[0]->currentlang_lat[1] }} @endif</b></label>
        </div>
        <div class="col-md-6">
            <label for="">Price: <b> {{$photographers[0]->estimatePayment}} </b></label>
        </div>
        <div class="col-md-6">
            <label for="">Payment Status: <b> {{$photographers[0]->payment_mode}} </b></label>
        </div>
        <div class="col-md-6">
            <label for="">Payment Amount: </label>
        </div>
        <div class="col-md-6">
            <label for="">Payment Method: </label>
        </div>
        <div class="col-md-6">
            <label for="">Feedback: </label>
        </div>
        <div class="col-md-6">
            <label for="">Rating: </label>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <h5><u>Subscriber Details</u></h5>
            <div class="row">
                <div class="col-md-3" style="margin-top: 7px;">
                    @if(!empty($photographers[0]->udetails[0]->photo[0]))
                    <img src="https://api.paparazzme.blazingtrail.in/{{$photographers[0]->udetails[0]->photo[0] }}" style="width: 100%; height: auto;">
                    @endif
                </div>
                <div class="col-md-9">
                    <label>Name: <b> @if(!empty($photographers[0]->udetails[0])) {{ $photographers[0]->udetails[0]->fullname }} @endif</b></label>
                    <br>
                    <label>Email: <b> @if(!empty($photographers[0]->udetails[0])) {{ $photographers[0]->udetails[0]->email }} @endif</b></label>
                    <br>
                    <label>Phone: <b> @if(!empty($photographers[0]->udetails[0])) {{ $photographers[0]->udetails[0]->mobileNO }} @endif</b></label>
                    <br>
                    <label for="">Address: <b> @if(!empty($photographers[0]->udetails[0])) {{ $photographers[0]->udetails[0]->billingAddress }} @endif</b></label>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h5><u>Photographer Details</u></h5>
            <div class="row">
                <div class="col-md-3" style="margin-top: 7px;">
                    @if(!empty($photographers[0]->pdetails[0]))
                    <img src="https://api.paparazzme.blazingtrail.in/{{$photographers[0]->pdetails[0]->photo[0] }}" style="width: 100%; height: auto;">
                    @endif
                </div>
                <div class="col-md-9">
                    <label for="">Name: <b> @if(!empty($photographers[0]->pdetails[0])) {{ $photographers[0]->pdetails[0]->fullname }} @endif</b></label>
                    <br>
                    <label for="">Email: <b> @if(!empty($photographers[0]->pdetails[0])) {{ $photographers[0]->pdetails[0]->email }} @endif</b></label>
                    <br>
                    <label for="">Phone: <b> @if(!empty($photographers[0]->pdetails[0])) {{ $photographers[0]->pdetails[0]->mobileNO }} @endif</b></label>
                    <br>
                    <label for="">Address: <b> @if(!empty($photographers[0]->pdetails[0])) {{ $photographers[0]->pdetails[0]->billingAddress }} @endif</b></label>
                </div>
            </div>
        </div>
    </div>
<br>

<script type="text/javascript">
    $(document).ready(function(){
        $(".kt-menu__item").each(function(){
          $(this).removeClass('kt-menu__item--active');
        })
        $("#booking").addClass('kt-menu__item--active');
      })
</script>
@endsection
