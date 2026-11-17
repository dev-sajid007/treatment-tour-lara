@extends('layouts.admin')


@section('content')


<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>


    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


<div class="clearfix"></div>
  
  <div class="content-wrapper">
    <div class="container-fluid">

      <div class="row mt-3">
        <div class="col-lg-12">
          <div class="card">
             <div class="card-body">
             <div class="card-title text-left">Add Career Post</div>
             <hr>
            <form method="POST" action="{{route('careers.store')}}">
              @csrf
             <div class="row"> 
               <div class="form-group col-md-12 mt-2 mb-2">
                <label for="input-6"> Job title</label>
                <input type="text" name="title" class="form-control form-control-rounded" id="input-6" placeholder="Job title" >
               </div>
             </div> 

              <div class="row"> 
               <div class="form-group col-md-12 mt-2 mb-2">
                <label for="input-6"> Job Description </label>
                <textarea type="text" name="description" id="editor" class="form-control" rows="8" placeholder="Description"></textarea>
               </div>
             </div> 

             <div class="form-group mt-2 mb-2">
              <button type="submit" class="btn btn-light btn-block btn-round px-5"><i class="icon-lock"></i> Save</button>
            </div>
            </form>
           </div>
           </div>
        </div>   

    </div><!--End Row-->

  <!--start overlay-->
      <div class="overlay toggle-menu"></div>
    <!--end overlay-->

    </div>
    <!-- End container-fluid-->


<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: "{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}"
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>

@endsection