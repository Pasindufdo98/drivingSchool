@extends('layouts.Admin.dashboard')

@section('admincontent')

<div class="container">
    
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('students.index') }}"> Back</a>
            </div><br>

            <div class="pull-left">
                <h2> Show Doctor</h2>
            </div>
        </div>
    </div>
</div>

<section>
    <div class="card shadow mb-3">
        <div class="card-body" style="margin-bottom: 5px; padding-bottom: 0px;">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $suser->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Contact No:</strong><br>
                            {{ $student->contact }}
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection