@extends('layouts.master')

@section('title') Website @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Dashboards @endslot
@slot('title') Edit about @endslot
@endcomponent


<div class="row">
    <div class="col-m-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Update About section</h4>

                <form action="{{ route('editAbout') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                        <label for="title-input" class="col-sm-3 col-form-label">Title</label>
                        <div class="col-sm-9">
                          <input type="text" name="title" class="form-control" value="{{ empty($about) ? '' : $about->title }}" id="title-input" placeholder="Enter a title ">
                        </div>
                    </div>
                   
                    <div class="row mb-4">
                        <label for="description-input" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <textarea id="textarea" name="description" class="form-control" maxlength="225" rows="3"
                            placeholder="Enter a description.">{{ empty($about) ? '' : $about->description }}</textarea>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="photo-input" class="col-sm-3 col-form-label">Profile Photo</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="file" id="formFile" name="photo">
                            <a href="{{ empty($about) ? '#' : URL::asset('photo_attachments/' . $about->photo) }}"><img class="mt-2" src="{{ empty($about) ? '' : URL::asset('photo_attachments/' . $about->photo) }}" width="80" alt=""></a>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="cv-input" class="col-sm-3 col-form-label">CV</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="file" id="formFile" name="cv">
                            <span class="text-primary mt-2"><a href="{{empty($about) ? '#' : URL::asset('cv_attachments/'.$about->cv) }}">Preview The CV</a></span>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="skill1-input" class="col-sm-3 col-form-label">Skill 1</label>
                        <div class="col-sm-9">
                          <input type="text" name="skill1" value="{{ empty($about) ? '' : $about->skill1 }}" class="form-control" id="skill1-input" placeholder="Enter a skill ">
                          <input type="range" name="range1" value="{{ empty($about) ? '' : $about->range1 }}" class="form-range mt-4" id="customRange1">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="skill2-input" class="col-sm-3 col-form-label">Skill 2</label>
                        <div class="col-sm-9">
                          <input type="text" name="skill2" value="{{ empty($about) ? '' :  $about->skill2 }}" class="form-control" id="skill2-input" placeholder="Enter a skill ">
                          <input type="range" name="range2" value="{{ empty($about) ? '' : $about->range2 }}" class="form-range mt-4" value="100" id="customRange1">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="skill3-input" class="col-sm-3 col-form-label">Skill 3</label>
                        <div class="col-sm-9">
                          <input type="text" name="skill3" value="{{ empty($about) ? '' : $about->skill3 }}" class="form-control" id="skill3-input" placeholder="Enter a skill ">
                          <input type="range" name="range3" value="{{ empty($about) ? '' : $about->range3 }}" class="form-range mt-4" value="20" id="customRange1">
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