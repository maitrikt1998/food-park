@extends('admin.layouts.master')

@section('content')
<section class="section mt-4">
    <div id="accordion">
        <div class="accordion">
            <div class="accordion-header collapsed bg-primary text-light p-3" role="button" data-toggle="collapse" data-target="#panel-body-1" aria-expanded="true">
                <h4>Send News Letter</h4>
            </div>
            <div class="accordion-body collapse show" id="panel-body-1" data-parent="#accordion">
                <form action="{{ route('admin.news-letter.send') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Subject</label>
                        <input type="text" class="form-control" name="subject" value="">
                    </div>

                    <div class="form-group">
                        <label for="">Message</label>
                        <textarea name="message" class="summernote"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

            </div>
        </div>

    </div>
</section>
<div class="section">
    <div class="section-header">
        <h1>Subscriber</h1>
    </div>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>All Subscriber</h4>
            <div class="card-header-action">
              <a href="{{ route('admin.chefs.create') }}" class="btn btn-primary">
                Create New
              </a>
            </div>
          </div>
          <div class="card-body">
            {{ $dataTable->table() }}
          </div>
        </div>
      </div>
</div>
@endsection

@push('scripts')
  {{ $dataTable->scripts() }}
@endpush
