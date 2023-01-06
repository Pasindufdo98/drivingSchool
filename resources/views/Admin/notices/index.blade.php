@extends('layouts.Admin.dashboard')
@section('admincontent')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Notice Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('notices.create') }}"> Creat New Notice</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
 <tr>
   <th>No</th>
   <th>Notice</th>
   <th>Created Date</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($data as $key => $notice)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->notice }}</td>
    
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="badge bg-primary">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td>
       <a class="btn btn-info" href="{{ route('notices.show',$notice->id) }}">Show</a>
       <a class="btn btn-primary" href="{{ route('notices.edit',$notice->id) }}">Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['notices.destroy', $notice->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
</table>


<!-- {!! $data->render() !!} -->



@endsection
