@extends('layout_master.layout')
@section('content')
<style type="text/css">
  img.portfolio-img {
    height: auto;
    width: 300px;
    margin-bottom: 45px;
  }
  .form-control-file{
    padding: 7px;
  }
  .btn-info {
    color: #fff;
    background-color: #17a2b8;
    border-color: #17a2b8;
}
</style>
<!-- The Modal -->

<div class="kt-subheader  kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Photographer</h3>
        </div>
    </div>
</div>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-xl-12">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="false"><i class="fa fa-id-card" aria-hidden="true"></i> Professional Details</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="false"><i class="fa fa-university" aria-hidden="true"></i> Payment Details</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="portfolio-tab" data-toggle="tab" href="#portfolio" role="tab" aria-controls="portfolio" aria-selected="false">
                <i class="fa fa-camera" aria-hidden="true"></i> Portfolio
              </a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <div class=""><form method="POST" id="stepOneForm">
                <div class="row">
                  <div class="col-md-4">
                    <label>Full Name</label>
                    <input type="text" name="name" id="fullname" class="form-control">
                  </div>
                  <div class="col-md-4">
                    <label>Email</label>
                    <input type="text" name="email" id="email" class="form-control">
                  </div>
                  <div class="col-md-4">
                    <label>Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control">
                  </div>
                  <div class="col-md-6">
                    <label>Age</label>
                    <input type="text" name="age" id="age" class="form-control">
                  </div>
                  <div class="col-md-6">
                    <label>Profile Picture</label>
                    <input type="file" name="dp" id="dp" class="form-control-file" accept="image/*">
                  </div>
                  <div class="col-md-6">
                    <label>Brief Bio</label>
                    <textarea class="form-control" name="bio" id="bb" rows="3"></textarea>
                  </div>
                  <div class="col-md-6">
                    <label>Address</label>
                    <textarea class="form-control" name="address" id="address" rows="3"></textarea>
                  </div>
                </div></form>
                <br>
                <div class="row">
                  <div class="col-md-11" style="text-align: right;">
                    <a href="#!" class="btn btn-primary nxt-btn" onclick="stepOne();">&nbsp;&nbsp;&nbsp;Next&nbsp;&nbsp;&nbsp;</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
              <div class=""><form method="POST" id="stepTwoForm">
                <input type="hidden" name="csrf" id="csrf" value="{{ csrf_token() }}">
                <input type="hidden" name="id" id="phId">
                <div class="row">
                  <div class="col-md-4">
                    <label>Type</label>
                    <select name="type" id="type" class="form-control">
                      <option value="Photographer">Photographer</option>
                      <option value="Videographer">Videographer</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label>Experties</label>
                      <select name="expertise" id="expertise" class="form-control">
                        <option value="mobile">Mobile</option>
                        <option value="amateur">Amateur</option>
                        <option value="semi-pro">Semi Pro</option>
                        <option value="pro">Pro</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label>Equipment Level</label>
                    <select name="equipmentLevel" id="el" class="form-control">
                        <option value="DSLR">DSLR</option>
                        <option value="Mobile camera">Mobile Camera</option>
                        <option value="360 degree camera">360 Degree Camera</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>Amount Of Service</label>
                    <input type="text" name="amountOfService" id="aos" class="form-control">
                  </div>
                  <div class="col-md-3">
                    <label>Currency Of Service</label>
                    <input type="text" name="currencyOfService" id="aos" class="form-control">
                  </div>
                  <div class="col-md-6">
                    <label>Language Spoken</label>
                    <input type="text" name="languageSpoken" id="ls" class="form-control">
                  </div>
                  <div class="col-md-3">
                    <label>Lighting Option</label>
                    <select name="lightingOption" id="lo" class="form-control">
                      <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>Green Screens</label>
                    <select name="greenScreens" id="gs" class="form-control">
                      <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>Post Shoot Retouching Editing</label>
                    <select name="postShoot_retouching_editing" id="psre" class="form-control">
                      <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>Virtual Reality Shoot</label>
                    <select name="virtualReality_shoot" id="vrs" class="form-control">
                      <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>Drone Aerial Shoot</label>
                    <select name="droneAerial_shoot" id="das" class="form-control">
                      <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>Animation Creation</label>
                    <select name="animationCreation" id="ac" class="form-control">
                      <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>Music</label>
                    <select name="music" id="music" class="form-control">
                      <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>Voice Over</label>
                    <select name="voiceOver" id="vo" class="form-control">
                      <option value="No">No</option>
                      <option value="Yes">Yes</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>Sound Effect</label>
                    <select name="soundEffect" id="se" class="form-control">
                      <option value="No">No</option>
                      <option value="Yes">Yes</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>Special Effects Filter</label>
                    <select name="specialEffects_filter" id="sef" class="form-control">
                      <option value="No">No</option>
                      <option value="Yes">Yes</option>
                    </select>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-11" style="text-align: right;">
                    <a href="#!" class="btn btn-primary nxt-btn" onclick="next('profile-tab');">&nbsp;&nbsp;&nbsp;Previus&nbsp;&nbsp;&nbsp;</a>
                    <a href="#!" class="btn btn-primary nxt-btn" onclick="stepTwo();">&nbsp;&nbsp;&nbsp;Next&nbsp;&nbsp;&nbsp;</a>
                  </div>
                </div>
              </div></form>
            </div>
            <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
              <div class="">
                <div class="row">
                  <div class="col-md-4">
                    <label>Account Name</label>
                    <input type="text" name="" class="form-control">
                  </div>
                  <div class="col-md-4">
                    <label>Payment Method</label>
                    <select class="form-control">
                      <option>Bank Transfer</option>
                      <option>UPI</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label>Tax Info (Optional)</label>
                    <input type="text" name="" class="form-control">
                  </div>
                  <div class="col-md-6">
                    <label>Account Number</label>
                    <input type="text" name="" class="form-control">
                  </div>
                  <div class="col-md-6">
                    <label>IFSC Code</label>
                    <input type="text" name="" class="form-control">
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-11" style="text-align: right;">
                    <a href="#!" class="btn btn-primary nxt-btn" onclick="next('details-tab');">&nbsp;&nbsp;&nbsp;Previus&nbsp;&nbsp;&nbsp;</a>
                    <a href="#!" class="btn btn-primary nxt-btn" onclick="next('portfolio-tab');">&nbsp;&nbsp;&nbsp;Next&nbsp;&nbsp;&nbsp;</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="portfolio" role="tabpanel" aria-labelledby="portfolio-tab">
              <div class="">
                <div class="row">
                  <div class="col-md-7"></div>
                  <div class="col-md-3">
                    <input type="file" name="" class="form-control-file">
                  </div>
                  <div class="col-md-2">
                    <a href="#!" class="btn btn-info" id="addBtn">Upload</a>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-4">
                    <img src="https://i.pinimg.com/474x/73/90/d4/7390d4f07ea6ad287185df4ea789621f.jpg" class="portfolio-img">
                  </div>
                  <div class="col-md-4">
                    <img src="https://i.pinimg.com/474x/73/90/d4/7390d4f07ea6ad287185df4ea789621f.jpg" class="portfolio-img">
                  </div>
                  <div class="col-md-4">
                    <img src="https://i.pinimg.com/474x/73/90/d4/7390d4f07ea6ad287185df4ea789621f.jpg" class="portfolio-img">
                  </div>
                  <div class="col-md-4">
                    <img src="https://i.pinimg.com/474x/73/90/d4/7390d4f07ea6ad287185df4ea789621f.jpg" class="portfolio-img">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  function next(id) {
    $("#"+id);
  }
  function insertData(dp) {
    let csrf = $("#csrf").val();
    let name = $("#fullname").val();
    let email = $("#email").val();
    let phone = $("#phone").val();
    let age = $("#age").val();
    let bio = $("#bb").val();
    let address = $("#address").val();

    $.ajax({
      headers: {'X-CSRF-TOKEN': csrf },
      url: "step-one",
      method: "POST",
      data: {name: name, email: email, phone: phone, age: age, bio: bio, address: address, dp: dp},
      beforeSend: function(){
        loader('Please wait..');
      },
      success: function (res) {
        console.log(res);
        $("#phId").val(res.data._id);
        $("#details-tab").click();
        Swal.close();
      },
      error: function (data) {
        console.log('Error:', data);
        errPop(data.responseJSON.message);
      }
    });   
  }
  function stepOne(){
    let csrf = $("#csrf").val();
    let file = $("#dp").val();
    if (file != "") {
      var file_data = $('#dp').prop('files')[0];
      var form_data = new FormData($('#stepOneForm')[0]);
      form_data.append('file', file_data);
      $.ajax({
        headers: {'X-CSRF-TOKEN': csrf },
        url: "upload-img",
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
            insertData(data.dp);
            Swal.close();
          }else{
            stepOne();
          }
        },
        error: function (data) {
          console.log('Error:', data);
          Swal.close();
        }
      });
    }else{
      insertData('profilepic/default.png');
    }
  }
  function stepTwo(){
    let csrf = $("#csrf").val();
    let id = $("#phId").val();
    let frmData = new FormData($("#stepTwoForm")[0]);
    $.ajax({
      headers: {'X-CSRF-TOKEN': csrf },
      url: "step-two",
      method: "POST",
      data: frmData,
      contentType: false,
      processData: false,
      beforeSend: function(){
        loader('Please wait..');
      },
      success: function (data) {
        console.log(data);
        $("#portfolio-tab").click();
        Swal.close();
      },
      error: function (data) {
        console.log('Error:', data);
        errPop(data.responseJSON.message);
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
