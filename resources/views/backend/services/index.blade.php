@extends('layouts.master')

@section('title') Website @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Dashboards @endslot
@slot('title') Services @endslot
@endcomponent

<div class="row">
    @foreach ($services as $service)
    <div class="col-xl-4 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-4">
                        <div class="avatar-md">
                            <span class="avatar-title rounded-circle bg-light text-danger font-size-16">
                                <img src="{{ URL::asset('service_images_attachments/'.$service->service_image) }}" alt="" height="30">
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-truncate font-size-15"><a href="javascript: void(0);" class="text-dark">{{ $service->title }}</a></h5>
                        <p class="text-muted mb-4">{{ $service->description }}</p>
                        <div class="avatar-group">
                            <div class="avatar-group-item">
                                <a href="javascript: void(0);" class="d-inline-block">
                                    <button class="btn btn-primary"><a href="{{ route('showService',['id' => $service->id]) }}" class="text-white">Edit</a></button>
                                </a>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 border-top">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item me-3">
                        <span class="badge bg-success">Created By: {{ Auth::user()->name }}</span>
                    </li>
                    <li class="list-inline-item me-3">
                        <i class= "bx bx-calendar me-1"></i> {{ $service->created_at }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
@section('script')
  
<!-- dashboard init -->
<script src="{{ URL::asset('build/js/pages/dashboard.init.js') }}"></script>
@endsection