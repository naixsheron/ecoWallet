@extends('layouts.master')
 
@section('content')

<section class="section">
           
     <div class="card" style="max-width: 1200px">
               <div class="card-header">
              <h4>Add Code</h4>
                </div>
        <div class="card-body">
          <form action="{{ route('code.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                  <div class="form-group">
                    <label>File</label>
                    <input type="file" class="form-control" name="banner">
                  </div>
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                  </div>
                  
                  <div class="form-group">
                    <label>Hours</label>
                    <input type="text" class="form-control" name="hours" value="{{ old('hours') }}">
                  </div>
                  <div class="form-group">
                    <label>Details</label>
                    <textarea class="form-control" name="details" value="{{ old('details') }}"></textarea>
                  </div>
                  <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">Create</button>
                  </div>
             </form>
        </div>
               
    </div>
       
  </section> 
@endsection