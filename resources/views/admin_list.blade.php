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
        <form method="POST" id="userForm">
          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrf">
          <input type="hidden" name="id" id="userId">
          <div class="row">
            <div class="col-md-3">
              <h6>Details</h6>
            </div>
            <div class="col-md-9" id="abc">
              <div class="row">
                <div class="col-md-6">
                  <label>Full Name</label>
                  <input type="text" name="fullname" id="fullname" class="form-control">
                </div>
                <div class="col-md-6">
                  <label>Email</label>
                  <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="col-md-6">
                  <label>Phone</label>
                  <input type="text" name="phone" id="phone" class="form-control">
                </div>
                <div class="col-md-6">
                  <label>Password</label>
                  <input type="password" name="password" id="password" class="form-control">
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
            <h3 class="kt-subheader__title">User</h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            <a href="#!" class="btn btn-lg btn-primary ml-auto" id="addBtn"><i class="fa fa-user-plus" aria-hidden="true"></i> Create New</a>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <!-- <th>Status</th> -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($users as $user)
                   <tr>
                    <td>{{date('F jS, Y', strtotime($user->updated_at))}}</td>
                     <td>{{$user->fullname}}</td>
                     <td>{{$user->email}}</td>
                     <td>{{$user->mobileNO}}</td>
                      <td>{{$user->billingAddress}}</td>
                      <!-- @if($user->status == '0')
                        <td onclick="statusChange('{{$user->_id}}');">
                          <span class="label label-pending"> Inactive </span>
                        </td>
                      @else
                        <td><span class="label label-success"> Active </span></td>
                      @endif -->

                     <td>
                      <a href="#!" onclick="editUser('{{$user->_id}}')"><i class="fas fa-pencil-alt"></i></a> |
                      <a href="#!" onclick="deleteUser('{{$user->_id}}')"><i class="fa fa-trash"></i></a>
                    </td>
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
    $("#users").addClass('kt-menu__item--active');
  })
  $("#addBtn").click(function(){
    $(".modal-title").html('Add User');
    $("#userId").val("");
    $("#submitBtn").html('Add');
    $("#formModal").modal('show');
  })
  $("#submitBtn").click(function(){
    let csrf = $("#csrf").val();
    let frmData = new FormData($("#userForm")[0]);
    $.ajax({
      headers: {'X-CSRF-TOKEN': csrf },
      url: "{{url('user-cteate')}}",
      method: "POST",
      data: frmData,
      dataType: "json",
      processData: false,
      contentType: false,
      beforeSend: function(){
        loader('Please wait..');
      },
      success: function (data) {
        console.log(data);
        location.reload();
      },
      error: function (data) {
        console.log('Error:', data);
        errPop(data.responseJSON.message);
      }
    });
  })
  function editUser(id){
    $.get('user-single/'+id, function(data){
      $("#userId").val(data._id);
      $("#fullname").val(data.fullname);
      $("#email").val(data.email);
      $("#phone").val(data.mobileNO);
      $("#address").val(data.billingAddress);
      $("#formModal").modal('show');
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
          confirmButtonText: 'Yes, change it!'
        }).then((result) => {
          if (result.value) {
            $.get('user-status/'+id, function(data){
              if(data == 'status changed'){
                Swal.fire(
                  'Changed!',
                  'Photogapher status has been changed.',
                  'success'
                );
                location.reload();
              }
            })
          }
        })
    }
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
            $.get('user-delete/'+id, function(data){
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
