@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @else
                    <div class="alert alert-success">
                        You are logged in!
                    </div>       
                @endif                
            </div>
            <div class="card-footer">
                <div class="d-flex align-items-center">
                    <div class="card" style="width: 300px;">
                         
                    <img src="https://i.pinimg.com/564x/52/7e/52/527e52be925706f7d60a245c3e0812a6.jpg" alt="Project Icon" class="mr-3">
                    </div>
                    <div style="width: 300px;margin:10px">
                        <h5 class="mb-0">Project Management Module</h5> 
                        <p class="mb-0">Manage your projects efficiently.</p>
                    </div> 
                    <div class="ml-auto">
                        <a href="{{ route('projects.index') }}" class="btn btn-primary">Explore Module</a>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
    
@endsection
