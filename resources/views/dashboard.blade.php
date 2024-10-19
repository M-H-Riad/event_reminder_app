@extends('layouts.admin')

@section('content')
<style>
  .dashboard {
    height: 700px;
  }
</style>
<section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">

          <!-- Event Card -->
          <div class="col-xxl-3 col-md-6">
            <div class="card info-card revenue-card">

              <div class="card-body">
                <h5 class="card-title">Total Events</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-card-list"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{$eventCount}}</h6>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Event Card -->

          

    </div>
  </section>
@endsection