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
<!-- The Modal -->
<div class="modal show" id="viewModal" aria-modal="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">User Details</h4>
        <button type="button" class="close" data-dismiss="modal" id="closeModal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="userForm" method="post" enctype="multipart/form-data">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
              <img src="public/loader.gif" id="dp" style="height: auto; width: 150px;">
            </div>
            <div class="col-md-9" id="abc">
              <div class="row">
                <div class="col-md-6">
                  <label>Full Name</label>
                  <h4 id="name">Bikash Ghorai</h4>
                </div>
                <div class="col-md-6">
                  <label>Phone</label>
                  <h4 id="phone">7003307060</h4>
                </div>
                <div class="col-md-12">
                  <label>Email</label>
                  <h4 id="email">mr.bikashghorai@gmail.com</h4>
                </div>
                <div class="col-md-12">
                  <label>Address</label>
                  <h4 id="address">Gariahat, Kolkata, WB - 721156</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        </form>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
      </div>
    </div>
  </div>
</div>
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
                        @if(count($booking->udetails) > 0)
                        <td>{{$booking->udetails[0]->fullname}} <a href="#!" onclick="viewUser('{{$booking->udetails[0]->_id}}');"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
                        @else
                        <td></td>
                        @endif
                        @if(count($booking->pdetails) > 0)
                        <td>{{$booking->pdetails[0]->fullname}} <a href="#!" onclick="viewPhgrapher('{{$booking->pdetails[0]->_id}}');"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
                        @else
                        <td></td>
                        @endif
                        @if(count($booking->currentlang_lat) > 0)
                        <td>{{$booking->currentlang_lat[0]}}, {{$booking->currentlang_lat[0]}}</td>
                        @else
                        <td></td>
                        @endif
                        <td>{{date('F jS, Y', strtotime($booking->created_at))}}</td>
                        <td>{{$booking->estimatePayment}}</td>
                        <td>{{$booking->payment_mode}}</td>
                        @if(count($booking->rdetails) > 0)
                        <td>$booking->rdetails[0]</td>
                        @else
                        <td></td>
                        @endif
                        @if($booking->confirmFlag != 0)
                        <td><span class="label label-info">Confirmed</span></td>
                        @elseif($booking->cancelFlag != 0)
                        <td><span class="label label-danger">Canceled</span></td>
                        @elseif($booking->completeFlag != 0)
                        <td><span class="label label-success">Complete</span></td>
                        @else
                        <td><span class="label label-pending">Pending</span></td>
                        @endif
                        <td><a href="{{url('single-booking/'.$booking->_id)}}"><i class="fas fa-eye"></i></a></td>
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
    function viewUser(id) {
        loader('Please wait..');
        $(".modal-title").html('User Details');
        $("#dp").attr('src', 'public/loader.gif');
        $.get('single-subscriber/'+id, function(data){
            console.log(data);
            Swal.close();
            let url = 'https://api.paparazzme.blazingtrail.in/'+data.photo[0];
            let img = url.replace("public", "static");
            $("#dp").attr('src', img);
            $("#name").html(data.fullname);
            $("#email").html(data.email);
            $("#phone").html(data.mobileNO);
            $("#address").html(data.billingAddress);
            $("#viewModal").modal('show');
        })
    }
    function viewPhgrapher(id){
      loader('Please wait..');
      $(".modal-title").html('Photographer Details');
      $("#dp").attr('src', 'public/loader.gif');
      $.get('ph-subscriber/'+id, function(res){
        console.log(res);
        Swal.close();
        let data = res;
        let url = 'https://api.paparazzme.blazingtrail.in/'+data.photo[0];
        let img = url.replace("public", "static");
        $("#dp").attr('src', img);
        $("#name").html(data.fullname);
        $("#email").html(data.email);
        $("#phone").html(data.mobileNO);
        $("#address").html(data.billingAddress);
        $("#viewModal").modal('show');
      })
    }
    function loader(msg){
      Swal.fire({
        title: msg,
        allowEscapeKey: false,
        allowOutsideClick: false,
        background: '#fff',
        showConfirmButton: false,
        onOpen: ()=>{
            Swal.showLoading();
        }
      });
    }
</script>
@endsection
