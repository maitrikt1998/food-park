@extends('admin.layouts.master')

@section('content')
<div class="section">
    <div class="section-header">
        <h1>Settings</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>All Settings</h4>
          </div>
          </div>
          <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-2">
                  <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab4" data-toggle="tab" href="#general-setting" role="tab" aria-controls="home" aria-selected="true">General Settings</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#pusher-setting" role="tab" aria-controls="profile" aria-selected="false">Pusher Settings</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#mail-setting" role="tab" aria-controls="contact" aria-selected="false">Mail Settings</a>
                    </li>
                  </ul>
                </div>
                <div class="col-12 col-sm-12 col-md-10">
                  <div class="tab-content no-padding" id="myTab2Content">
                    @include('admin.setting.section.general-settings')
                    @include('admin.setting.section.pusher-settings')
                    @include('admin.setting.section.mail-settings')
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
</div>
@endsection

