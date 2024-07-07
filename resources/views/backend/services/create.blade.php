@extends('layouts.master')

@section('title') Website @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Dashboards @endslot
@slot('title') Create Service @endslot
@endcomponent


<div class="row">
    <div class="col-m-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Create Service </h4>

                <form action="{{ route('createService') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                        <label for="title-input" class="col-sm-3 col-form-label">Title</label>
                        <div class="col-sm-9">
                          <input type="text" name="title" class="form-control" value="" id="title-input" placeholder="Enter the title of the service ">
                        </div>
                    </div>
                   
                    <div class="row mb-4">
                        <label for="description-input" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                          <input type="text" name="description" class="form-control" value="" id="first_role-input" placeholder="Enter the description of te service ">
                        </div>
                    </div>
                  
                    <div class="row mb-4">
                        <label for="service_image" class="col-sm-3 col-form-label">Image Of The service</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="file" id="formFile" name="service_image">
                            {{-- <a href="{{ empty($about) ? '#' : URL::asset('photo_attachments/' . $about->photo) }}"><img class="mt-2" src="{{ empty($about) ? '' : URL::asset('photo_attachments/' . $about->photo) }}" width="80" alt=""></a> --}}
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <button type="submit" class="btn btn-primary w-md">Create</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>


@endsection
@section('script')
  
<!-- dashboard init -->
<script src="{{ URL::asset('build/js/pages/dashboard.init.js') }}"></script>
@endsection