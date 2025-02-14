@extends('admin.layouts.master')

@section('content')

    <section class="section">
        <div class="card">
            <div class="card-body">
                <div id="accordion">
                    <div class="accordion">
                        <div class="accordion-header collapsed bg-primary text-light p-3" role="button" data-toggle="collapse" data-target="#panel-body-1" aria-expanded="true">
                            <h4>Daily offer Section Titles..</h4>
                        </div>
                        <div class="accordion-body collapse show" id="panel-body-1" data-parent="#accordion">
                            <form action="{{ route('admin.daily-offer-title.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Top Title</label>
                                    <input type="text" class="form-control" name="daily_offer_top_title" value="{{ @$titles['daily_offer_top_title'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Main Title</label>
                                    <input type="text" class="form-control" name="daily_offer_main_title" value="{{ @$titles['daily_offer_main_title'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Sub Title</label>
                                    <input type="text" class="form-control" name="daily_offer_sub_title" value="{{ @$titles['daily_offer_sub_title'] }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


<section class="section mt-4">
    <div class="section-header">
        <h1>Daily offer</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>All Daily offer</h4>
            <div class="card-header-action">
              <a href="{{ route('admin.daily-offer.create') }}" class="btn btn-primary">
                Create New
              </a>
            </div>
          </div>
          <div class="card-body">
            {{ $dataTable->table() }}
          </div>
        </div>
      </div>
    </section>
@endsection

@push('scripts')
  {{ $dataTable->scripts() }}
@endpush
