@extends('layout_master.layout')
@section('content')

<style type="text/css">
  .label-pending {
    background-color: #f0ad4e;
  }
  .label-success {
    background-color: #5cb85c;
  }
  .label-danger {
    background-color: #d9534f;
  }
  .label-info {
    background-color: #5bc0de;
  }
  .label {
    text-shadow: none!important;
    font-size: 14px;
    font-weight: 300;
    padding: 3px 6px;
    color: #fff;
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
        <div class="col-xl-12">
            <label for="">Subscriber Name: <b> @if(!empty($photographers[0][0]->udetails[0])) {{ $photographers[0][0]->udetails[0]->fullname }} @endif</b></label>
        </div>
        <div class="col-xl-12">
            <label for="">Photographer Name: <b> @if(!empty($photographers[0][0]->pdetails[0])) {{ $photographers[0][0]->pdetails[0]->fullname }} @endif</b></label>
        </div>
        <div class="col-xl-12">
            <label for="">Location lat: <b> @if(!empty($photographers[0][0]->currentlang_lat[0])) {{ $photographers[0][0]->currentlang_lat[0] }} @endif</b></label>
        </div>
        <div class="col-xl-12">
            <label for="">Location lang: <b> @if(!empty($photographers[0][0]->currentlang_lat[1])) {{ $photographers[0][0]->currentlang_lat[1] }} @endif</b></label>
        </div>
        <div class="col-xl-12">
            <label for="">Date Time: </label>
        </div>
        <div class="col-xl-12">
            <label for="">Status: 
                @if($photographers[0][0]->completeFlag == 1) 
                <b> Active </b>
                @elseif($photographers[0][0]->confirmFlag == 1)
                <b> Done </b>
                @else
                <b> Not Active </b>
                @endif
            </label>
        </div>
        <div class="col-xl-12">
            <label for="">Price: <b> {{$photographers[0][0]->estimatePayment}} </b></label>
        </div>
        <div class="col-xl-12">
            <label for="">Payment Status: <b> {{$photographers[0][0]->payment_mode}} </b></label>
        </div>
        <div class="col-xl-12">
            <label for="">Payment Amount: </label>
        </div>
        <div class="col-xl-12">
            <label for="">Payment Method: </label>
        </div>
        <div class="col-xl-12">
            <label for="">Feedback: </label>
        </div>
        <div class="col-xl-12">
            <label for="">Rating: </label>
        </div>
        <div class="col-xl-12">
            <label for="">Photos: </label>
        </div>
        <div class="col-xl-12">
            <label for="">Videos: </label>
        </div>
        <div class="col-xl-12">
            <label for="">Dated: </label>
        </div>
    </div>
</div>
@endsection
