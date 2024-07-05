@extends('layouts.master')

@section('title') Website @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Dashboards @endslot
@slot('title') Edit achievements @endslot
@endcomponent


<div class="row">
    <div class="col-m-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Update Achievements section</h4>

                <form action="{{ route('editAchievment') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                        <label for="projects-input" class="col-sm-3 col-form-label">Projects Completed</label>
                        <div class="col-sm-9">
                          <input type="text" name="projects" class="form-control" value="{{ !empty($achievment) ? $achievment->projects : '' }}" id="projects-input" placeholder="Enter the number of projects ">
                        </div>
                    </div>
                   
                    <div class="row mb-4">
                        <label for="coffees-input" class="col-sm-3 col-form-label">Coffees</label>
                        <div class="col-sm-9">
                          <input type="text" name="coffees" class="form-control" value="{{ !empty($achievment) ? $achievment->coffees : '' }}" id="coffees-input" placeholder="Enter the number of the cups of coffee ">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="satisfied-input" class="col-sm-3 col-form-label">Satisfied Clients</label>
                        <div class="col-sm-9">
                          <input type="text" name="satisfied" class="form-control" value="{{ !empty($achievment) ? $achievment->satisfied : '' }}" id="satisfied-input" placeholder="Enter how many satisfied clients ">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="feedbacl-input" class="col-sm-3 col-form-label">Positive Feedback</label>
                        <div class="col-sm-9">
                          <input type="text" name="feedback" class="form-control" value="{{ !empty($achievment) ? $achievment->feedback : '' }}" id="feedback-input" placeholder="Enter the number of positive feedback you got ">
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <button type="submit" class="btn btn-primary w-md">Update</button>
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