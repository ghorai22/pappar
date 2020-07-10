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
.change-dp{
  background: #000;
  padding: 10px;
  text-align: center;
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
              <a class="nav-link" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false"><i class="fa fa-info-circle" aria-hidden="true"></i> Info</a>
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
                <input type="hidden" name="csrf" id="csrf1" value="{{ csrf_token() }}">
                <input type="hidden" name="id" id="phId1" value="{{$phgrapher->_id}}">
                <div class="row">
                  <div class="col-md-3">
                     @if(isset($phgrapher->photo) && !empty($phgrapher->photo))
                     <span id="imgView">
                      <img src="https://api.paparazzme.blazingtrail.in/static/{{str_replace('public/', '', $phgrapher->photo[0])}}" style="height: auto; width: 100%;">
                      <a href="#!" id="change"><h5 class="change-dp"><i class="fa fa-pencil" aria-hidden="true"></i> Change DP</h5></a>
                    </span>
                    @endif
                    <div id="imgEdit" style="display: none;">
                      <label>Profile Picture</label>
                      <input type="file" name="dp" id="dp" class="form-control-file" accept="image/*">
                    </div>
                  </div>
                  <div class="col-md-9">
                    <div class="row">
                      @php
                      $nameArr = explode(" ", $phgrapher->fullname);
                      @endphp
                      <div class="col-md-5">
                        <label>First Name</label>
                        <input type="text" name="firstname" id="firstname" class="form-control" value="{{$nameArr[0]}}">
                      </div>
                      <div class="col-md-5">
                        <label>Last Name</label>
                        <input type="text" name="lastname" id="lastname" class="form-control" value="{{$nameArr[1]}}">
                      </div>
                      <div class="col-md-2">
                        <label>Age</label>
                        <input type="text" name="age" id="age" class="form-control" value="{{$phgrapher->pinfo[0]->age}}">
                      </div>
                      <div class="col-md-6">
                        <label>Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{$phgrapher->email}}">
                      </div>
                      <div class="col-md-6">
                        <label>Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{$phgrapher->mobileNO}}">
                      </div>
                      <div class="col-md-6">
                        <label>Brief Bio</label>
                        <textarea class="form-control" name="bio" id="bb" rows="3">{{$phgrapher->pinfo[0]->briefBio}}</textarea>
                      </div>
                      <div class="col-md-6">
                        <label>Address</label>
                        <textarea class="form-control" name="address" id="address" rows="3">{{$phgrapher->billingAddress}}</textarea>
                      </div>
                    </div>
                  </div>
                </div></form>
                <br>
                <div class="row">
                  <div class="col-md-11" style="text-align: right;">
                    <a href="#!" class="btn btn-primary nxt-btn" onclick="stepOne();">Update & Next</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
              <div class=""><form method="POST" id="stepTwoForm">
                <input type="hidden" name="csrf" id="csrf" value="{{ csrf_token() }}">
                <input type="hidden" name="id" id="phId" value="{{$phgrapher->_id}}">
                @php
                $phinfo = $phgrapher->pinfo[0];
                @endphp
                <div class="row">
                  <div class="col-md-4">
                    <label>Type</label>
                    <select name="type" id="type" class="form-control">
                      @if($phinfo->type[0] == 'Photographer')
                      <option value="Photographer">Photographer</option>
                      <option value="Videographer">Videographer</option>
                      @else
                      <option value="Videographer">Videographer</option>
                      <option value="Photographer">Photographer</option>
                      @endif
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label>Experties</label>
                      <select name="expertise" id="expertise" class="form-control">
                        @if(isset($phinfo->expertise) && $phinfo->expertise == 'mobile')
                        <option value="mobile">Mobile</option>
                        <option value="amateur">Amateur</option>
                        <option value="semi-pro">Semi Pro</option>
                        <option value="pro">Pro</option>
                        @elseif(isset($phinfo->expertise) && $phinfo->expertise == 'amateur')
                        <option value="amateur">Amateur</option>
                        <option value="mobile">Mobile</option>
                        <option value="semi-pro">Semi Pro</option>
                        <option value="pro">Pro</option>
                        @elseif(isset($phinfo->expertise) && $phinfo->expertise == 'semi-pro')
                        <option value="semi-pro">Semi Pro</option>
                        <option value="amateur">Amateur</option>
                        <option value="mobile">Mobile</option>
                        <option value="pro">Pro</option>
                        @else
                        <option value="pro">Pro</option>
                        <option value="semi-pro">Semi Pro</option>
                        <option value="amateur">Amateur</option>
                        <option value="mobile">Mobile</option>
                        @endif
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label>Equipment Level</label>
                    <select name="equipmentLevel" id="el" class="form-control">
                      @if(isset($phinfo->equipmentLevel) && $phinfo->equipmentLevel == 'DSLR')
                        <option value="DSLR">DSLR</option>
                        <option value="Mobile camera">Mobile Camera</option>
                        <option value="360 degree camera">360 Degree Camera</option>
                      @elseif(isset($phinfo->equipmentLevel) && $phinfo->equipmentLevel == 'Mobile camera')
                        <option value="Mobile camera">Mobile Camera</option>
                        <option value="DSLR">DSLR</option>
                        <option value="360 degree camera">360 Degree Camera</option>
                      @else
                        <option value="360 degree camera">360 Degree Camera</option>
                        <option value="Mobile camera">Mobile Camera</option>
                        <option value="DSLR">DSLR</option>
                      @endif
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>Amount Of Service</label>
                    <input type="text" name="amountOfService" id="aos" class="form-control" value="{{$phinfo->amountOfService}}">
                  </div>
                  <div class="col-md-3">
                    <label>Currency Of Service</label>
                    <input type="text" name="currencyOfService" id="aos" class="form-control" value="{{$phinfo->currencyOfService}}">
                  </div>
                  <div class="col-md-6">
                    <label>Language Spoken</label>
                    @if(isset($phinfo->languageSpoken) && gettype($phinfo->languageSpoken) == 'array' && count($phinfo->languageSpoken) > 0)
                    <input type="text" name="languageSpoken" id="ls" class="form-control" value="{{$phinfo->languageSpoken[0]}}">
                    @elseif(gettype($phinfo->languageSpoken) != 'array')
                    <input type="text" name="languageSpoken" id="ls" class="form-control" value="{{$phinfo->languageSpoken}}">
                    @else
                    <input type="text" name="languageSpoken" id="ls" class="form-control">
                    @endif
                  </div>
                  <div class="col-md-3">
                    <label>Lighting Option</label>
                    <select name="lightingOption" id="lo" class="form-control">
                      @if($phinfo->lightingOption == 'Yes')
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      @else
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                      @endif
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>Green Screens</label>
                    <select name="greenScreens" id="gs" class="form-control">
                      @if($phinfo->greenScreens == 'Yes')
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      @else
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                      @endif
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>Post Shoot Retouching Editing</label>
                    <select name="postShoot_retouching_editing" id="psre" class="form-control">
                      @if($phinfo->postShoot_retouching_editing == 'Yes')
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      @else
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                      @endif
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>Virtual Reality Shoot</label>
                    <select name="virtualReality_shoot" id="vrs" class="form-control">
                      @if($phinfo->virtualReality_shoot == 'Yes')
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      @else
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                      @endif
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>Drone Aerial Shoot</label>
                    <select name="droneAerial_shoot" id="das" class="form-control">
                      @if($phinfo->droneAerial_shoot == 'Yes')
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      @else
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                      @endif
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>Animation Creation</label>
                    <select name="animationCreation" id="ac" class="form-control">
                      @if($phinfo->animationCreation == 'Yes')
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      @else
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                      @endif
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>Music</label>
                    <select name="music" id="music" class="form-control">
                      @if($phinfo->music == 'Yes')
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      @else
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                      @endif
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>Voice Over</label>
                    <select name="voiceOver" id="vo" class="form-control">
                      @if($phinfo->voiceOver == 'Yes')
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      @else
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                      @endif
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>Sound Effect</label>
                    <select name="soundEffect" id="se" class="form-control">
                      @if($phinfo->soundEffect == 'Yes')
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      @else
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                      @endif
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>Special Effects Filter</label>
                    <select name="specialEffects_filter" id="sef" class="form-control">
                      @if($phinfo->specialEffects_filter == 'Yes')
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      @else
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                      @endif
                    </select>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-11" style="text-align: right;">
                    <a href="#!" class="btn btn-primary nxt-btn" onclick="next('profile-tab');">&nbsp;&nbsp;&nbsp;Previus&nbsp;&nbsp;&nbsp;</a>
                    <a href="#!" class="btn btn-primary nxt-btn" onclick="stepTwo();">Update & Next</a>
                  </div>
                </div>
              </div></form>
            </div>
            <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
              <div class="">
                <div class="row">
                  <div class="col-md-6">
                    <label>Registration Date</label>
                    <input type="text" name="created_at" class="form-control" value="{{ date('F jS, Y', strtotime($phgrapher->pinfo[0]->created_at)) }}" disabled="">
                  </div>
                  <div class="col-md-6">
                    <label>Account Status</label>
                    @if(\Session::get('loginType') == 'admin')
                    <select class="form-control" id="accStatus">
                      <option value="0">Inactive</option>
                      @if($phgrapher->status == 1)
                      <option value="1" selected="">Active</option>
                      @else
                      <option value="1">Active</option>
                      @endif
                    </select>
                    @else
                    @if($phgrapher->status == 1)
                    <input type="text" name="status" value="Active" disabled="">
                    @else
                    <input type="text" name="status" value="Inactive" disabled="">
                    @endif
                    @endif
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-11" style="text-align: right;">
                    <a href="#!" class="btn btn-primary nxt-btn" onclick="next('details-tab');">
                    &nbsp;&nbsp;&nbsp;Previus&nbsp;&nbsp;&nbsp;</a>
                    @if(\Session::get('loginType') == 'admin')
                    <a href="#!" class="btn btn-primary nxt-btn" onclick="stepThree();">Update & Next</a>
                    @else
                    <a href="#!" class="btn btn-primary nxt-btn" onclick="next('portfolio-tab');">
                    &nbsp;&nbsp;&nbsp;Next&nbsp;&nbsp;&nbsp;</a>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="portfolio" role="tabpanel" aria-labelledby="portfolio-tab">
              <div class=""><form method="POST" id="portfolioForm">
                <input type="hidden" name="csrf" id="csrf2" value="{{ csrf_token() }}">
                <input type="hidden" name="id" id="phgId" value="{{$phgrapher->_id}}">
                <div class="row">
                  <div class="col-md-7"></div>
                  <div class="col-md-3">
                    <input type="file" name="portfolio[]" class="form-control-file" id="files" multiple>
                  </div>
                  <div class="col-md-2">
                    <a href="#!" class="btn btn-info" id="addBtn" onclick="stepFour();">Upload</a>
                  </div>
                </div></form>
                <br>
                <div class="row" id="portfolioView">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $(".kt-menu__item").each(function(){
      $(this).removeClass('kt-menu__item--active');
    })
    $("#photographer").addClass('kt-menu__item--active');
  })
  function next(id) {
    $("#"+id).click();
  }
  $("#change").click(function(){
    $("#imgView").hide();
    $("#imgEdit").show();
  })
  function insertData(dp) {
    let csrf = $("#csrf1").val();
    let id = $("#phId1").val();
    let name = $("#fullname").val();
    let email = $("#email").val();
    let phone = $("#phone").val();
    let age = $("#age").val();
    let bio = $("#bb").val();
    let address = $("#address").val();

    $.ajax({
      headers: {'X-CSRF-TOKEN': csrf },
      url: "{{url('step-one-update')}}",
      method: "POST",
      data: {id: id, name: name, email: email, phone: phone, age: age, bio: bio, address: address, dp: dp},
      beforeSend: function(){
        loader('Please wait..');
      },
      success: function (res) {
        console.log(res);
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
    let csrf = $("#csrf1").val();
    let file = $("#dp").val();
    if (file != "") {
      var file_data = $('#dp').prop('files')[0];
      var form_data = new FormData($('#stepOneForm')[0]);
      form_data.append('file', file_data);
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
      insertData('no-change');
    }
  }
  function stepTwo(){
    let csrf = $("#csrf").val();
    let id = $("#phId").val();
    if(id != ""){
      let frmData = new FormData($("#stepTwoForm")[0]);
      $.ajax({
        headers: {'X-CSRF-TOKEN': csrf },
        url: "{{url('step-two')}}",
        method: "POST",
        data: frmData,
        contentType: false,
        processData: false,
        beforeSend: function(){
          loader('Please wait..');
        },
        success: function (data) {
          console.log(data);
          $("#info-tab").click();
          Swal.close();
        },
        error: function (data) {
          console.log('Error:', data);
          errPop(data.responseJSON.message);
        }
      });
    }else{
      $("#profile-tab").click();
    }
  }
  function stepThree(){
    let csrf = $("#csrf").val();
    let id = $("#phId").val();
    let status = $("#accStatus").val();
    $.ajax({
      headers: {'X-CSRF-TOKEN': csrf },
      url: "{{url('step-three')}}",
      method: "POST",
      data: {id: id, status: status},
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
  function stepFour(){
    let csrf = $("#csrf2").val();
    let id = $("#phgId").val();
    if(id != ""){
      let frmData = new FormData($("#portfolioForm")[0]);
      let fi = document.getElementById('files');
      let nof = fi.files.length;
      if(nof > 0){
        for(let j= 0; j < nof; j++){
          frmData.append('row', j);
          $.ajax({
            headers: {'X-CSRF-TOKEN': csrf },
            url: "{{url('step-four')}}",
            method: "POST",
            data: frmData,
            beforeSend: function(){
              loader('Uploading..');
              $("#swal2-content").show();
              $("#swal2-content").html("0 upload of "+nof);
            },
            success: function (data) {
              console.log(data);
              let nou = j + 1;
              $("#swal2-content").html(nou+" upload of "+nof);
              let url = 'https://api.paparazzme.blazingtrail.in/'+data.file;
              let html = '<div class="col-md-4"><img src="'+url.replace("public", "static")+'" class="portfolio-img"></div>';
              $("#portfolioView").append(html);
            },
            error: function (data) {
              console.log('Error:', data);
              errPop(data.responseJSON.message);
            }
          });
        };
        $("#files").val("");
        Swal.close();
      }else{
        errPop('Please select file');
      }
    }else{
      $("#profile-tab").click();
    }
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
