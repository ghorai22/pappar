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

<div class="kt-subheader  kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Photogapher</h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            <a href="{{ url('photographer-add') }}" class="btn btn-lg btn-primary ml-auto" id="addBtn"><i class="fa fa-user-plus" aria-hidden="true"></i> Create New</a>
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
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Expertise</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($photographers as $photographer)
                   <tr>
                    <td>{{date('F jS, Y', strtotime($photographer->updated_at))}}</td>
                    @if(count($photographer->photo) > 0)
                    <td>
                      <img src="https://api.paparazzme.blazingtrail.in/static/{{str_replace('public/', '', $photographer->photo[0])}}">
                    </td>
                    @else
                    <td></td>
                    @endif
                     <td>{{$photographer->fullname}}</td>
                     <td>{{$photographer->email}}</td>
                     <td>{{$photographer->mobileNO}}</td>
                     <td>{{$photographer->billingAddress}}</td>
                     @if( isset($photographer->pinfo[0]->expertise))
                     <td>{{$photographer->pinfo[0]->expertise}}</td>
                    @else
                    <td></td>
                    @endif
                    @if(count($photographer->prating))
                     <td>{{$photographer->prating[0]->rating}}</td>
                    @else
                     <td>0</td>
                    @endif

                    @if(Session::get('loginType') == 'admin')
                      @if($photographer->status == '0')
                        <td onclick="statusChange('{{$photographer->_id}}');">
                          <span class="label label-pending"> Inactive </span>
                        </td>
                      @else
                        <td><span class="label label-success"> Active </span></td>
                      @endif
                    @else
                      @if($photographer->status == '0')
                        <td>
                          <span class="label label-pending"> Pending </span>
                        </td>
                      @else
                        <td><span class="label label-success"> Active </span></td>
                      @endif
                    @endif
                    @if(Session::get('loginType') == 'admin')
                     <td>
                      <a href="#!" onclick="editUser('{{$photographer->_id}}')"><i class="fas fa-pencil-alt"></i></a> |
                      <a href="#!" onclick="deleteUser('{{$photographer->_id}}')"><i class="fa fa-trash"></i></a>
                    </td>
                    @else
                    <td>
                      <a href="#!" onclick="editUser('{{$photographer->_id}}')"><i class="fas fa-pencil-alt"></i> Edit</a>
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
    function editUser(id) {
        $("#formModal").modal('show');
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
            $.get('status-ph/'+id, function(data){
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
</script>
@endsection
