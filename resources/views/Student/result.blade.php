@extends('layouts.Student.dashboard')



@section('studentcontent')

<h1>Exam Results</h1>
@foreach ($result as $result)   
<h5>Theory Exam <span class="badge bg-secondary">{{ $result->Tresults }}</span></h5>
<h5>Theory Exam <span class="badge bg-secondary">{{ $result->Presults }}</span></h5>

@endforeach 

@endsection