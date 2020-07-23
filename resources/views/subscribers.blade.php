@extends('layout_master.layout')
@section('content')
<style type="text/css">
  .label-pending {
    background-color: #c49f47;
    cursor: pointer;
  }
  .label-success {
    background-color: #36c6d3;
  }
  .label {
    text-shadow: none!important;
    font-size: 14px;
    font-weight: 300;
    padding: 3px 6px;
    color: #fff;
  }
  td img{
    height: auto;
    width: 50px;
  }
  .change-dp{
    background: #000;
    padding: 10px;
    text-align: center;
  }
</style>
<!-- The Modal -->
<div class="modal show" id="formModal" aria-modal="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit User</h4>
        <button type="button" class="close" data-dismiss="modal" id="closeModal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="userForm" method="POST" id="updateForm">
          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrf">
          <input type="hidden" name="id" id="userId">
          <div class="row">
            <div class="col-md-3">
              <span id="imgView">
                <img src="public/loader.gif" id="photo" style="height: auto; width: 100%;">
                <a href="#!" id="change"><h5 class="change-dp"><i class="fa fa-pencil" aria-hidden="true"></i> Change DP</h5></a>
              </span>
              <span id="imgEdit" style="display: none;">
                <label>Profile Picture</label>
                <input type="file" name="dp" id="dp" class="form-control-file" accept="image/*">
              </span>
            </div>
            <div class="col-md-9" id="abc">
              <div class="row">
                <div class="col-md-6">
                  <label>First Name</label>
                  <input type="text" name="firstname" id="firstname" class="form-control">
                </div>
                <div class="col-md-6">
                  <label>Last Name</label>
                  <input type="text" name="lastname" id="lastname" class="form-control">
                </div>
                <div class="col-md-6">
                  <label>Email</label>
                  <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="col-md-6">
                  <label>Phone</label>
                  <input type="text" name="phone" id="phone" class="form-control">
                </div>
                <div class="col-md-12">
                  <label>Address</label>
                  <textarea class="form-control" name="address" id="address" rows="3"></textarea>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="submitBtn">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">cancel</button>
      </div>
    </div>
  </div>
</div>
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Subscribers</h3>
        </div>
    </div>
</div>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-xl-12">
            <table class="table table-striped table-bordered table-sm" id="invoiceTable">
                <thead>
                    <tr>
                      <th>Date</th>
                      <th>Picture</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Address</th>
                      <th>Mobile</th>
                      <th>FB</th>
                      <th>Active</th>
                      <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($subscribers as $subscriber)
                   <tr>
                    <td>{{date('F jS, Y', strtotime($subscriber->updated_at))}}</td>
                    <td>
                      <img src="https://api.paparazzme.blazingtrail.in/{{$subscriber->photo[0]}}">
                    </td>
                     <td>{{$subscriber->fullname}}</td>
                     <td>{{$subscriber->email}}</td>
                     <td>{{$subscriber->billingAddress}}</td>
                     <td>{{$subscriber->mobileNO}}</td>
                    @if($subscriber->socialid == 'dashboard')
                     <td>NULL</td>
                    @else
                     <td>{{substr($subscriber->socialid, 0, 20)}}..</td>
                    @endif

                    @if(Session::get('loginType') == 'admin')
                      @if($subscriber->status == '0')
                        <td onclick="statusChange('{{$subscriber->_id}}');">
                          <span class="label label-pending"> Inactive </span>
                        </td>
                      @else
                        <td><span class="label label-success"> Active </span></td>
                      @endif
                    @else
                      @if($subscriber->status == '0')
                        <td>
                          <span class="label label-pending"> Pending </span>
                        </td>
                      @else
                        <td><span class="label label-success"> Active </span></td>
                      @endif
                    @endif
                    @if(Session::get('loginType') == 'admin')
                     <td>
                      <a href="#!" onclick="editUser('{{$subscriber->_id}}')"><i class="fas fa-pencil-alt"></i></a> |
                      <a href="#!" onclick="deleteUser('{{$subscriber->_id}}')"><i class="fa fa-trash"></i></a>
                    </td>
                    @else
                    <td>
                      <a href="#!" onclick="editUser('{{$subscriber->_id}}')"><i class="fas fa-pencil-alt"></i> Edit</a>
                    </td>
                    @endif
                   </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#invoiceTable').DataTable();
    $(".kt-menu__item").each(function(){
      $(this).removeClass('kt-menu__item--active');
    })
    $("#subscriber").addClass('kt-menu__item--active');
  })
  function editUser(id) {
    $.get('single-subscriber/'+id, function(data){
      $("#userId").val(data._id);
      if(data.photo.length > 0 && data.photo[0] != 'N/A'){
        let url = 'https://api.paparazzme.blazingtrail.in/'+data.photo[0];
        $("#photo").attr('src', url);
      }else{
        $("#imgView").hide();
        $("#imgEdit").show();
      }
      let flname = data.fullname;
      let nameArr = flname.split(" ");
      $("#firstname").val(nameArr[0]);
      $("#lastname").val(nameArr[1]);
      $("#email").val(data.email);
      $("#phone").val(data.mobileNO);
      $("#address").val(data.billingAddress);
      $("#formModal").modal('show');
    })
  }
  $("#change").click(function(){
    $("#imgView").hide();
    $("#imgEdit").show();
  })
  function deleteUser(id){
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        $.get('delete-subscriber/'+id, function(data){
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
          location.reload();
        })
      }
    })
  }
  function statusChange(id){
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        $.get('status-subscriber/'+id, function(data){
          if(data == 'status changed'){
            Swal.fire(
              'Changed!',
              'User status has been changed.',
              'success'
            );
            location.reload();
          }
        })
      }
    })
  }
  $("#submitBtn").click(function(){
    let file = $("#dp").val();
    if (file == "") {
      updateData('no-change');
    }else{
      uploadFile();
    }
  })
  function updateData(dp){
    let csrf = $("#csrf").val();
    let id = $("#userId").val();
    let fname = $("#firstname").val()+" "+$("#lastname").val();
    let email = $("#email").val();
    let phone = $("#phone").val();
    let address = $("#address").val();
    $.ajax({
      headers: {'X-CSRF-TOKEN': csrf },
      url: "update-subscriber",
      method: "POST",
      data: {id: id, fname: fname, email: email, phone: phone, address: address, dp: dp},
      success: function (data) {
        console.log(data);
        location.reload();
      },
      error: function (data) {
          console.log('Error:', data);
      }
    });
  }
  function uploadFile(){
    let csrf = $("#csrf").val();
    var file_data = $('#dp').prop('files')[0];
    var form_data = new FormData($('#updateForm')[0]);
    form_data.append('dp', file_data);
    $.ajax({
      headers: {'X-CSRF-TOKEN': csrf },
      url: "{{url('upload-img')}}",
      method: "POST",
      data: form_data,
      dataType: "json",
      processData: false,
      contentType: false,
      beforeSend: function(){
        loader('Uploading..');
      },
      success: function (data) {
        console.log(data);
        if(data.status == 'success'){
          updateData(data.dp);
          Swal.close();
        }else{
          errPop(data.message);
        }
      },
      error: function (data) {
        console.log('Error:', data);
        Swal.close();
      }
    });
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
  function errPop(msg){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: msg
    })
  }
</script>
@endsection
