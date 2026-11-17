@extends('layouts.admin')

@section('content')
<div class="clearfix"></div>
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row mt-3">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"> Add New Career Post <a class="btn btn-success mx-3" href="{{route('careers.create')}}" > Add new Career post</a> </h5>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">SL</th>
                      <th scope="col">Title</th>
                      <th scope="col">Edit</th>
                      <th scope="col">View</th>
                      <th scope="col">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($careers as $index => $career)
                    <tr>
                      <th scope="row">{{$loop->iteration}}</th>
                      <td>{{$career->title}}</td>
                      <td><a class="btn btn-success" href="{{route('careers.edit', $career->id)}}">Edit</a></td>
                      <td><a class="btn btn-success" href="{{route('job.view', $career->id)}}">View</a></td>
                      <td>
                         <form action="{{ route('careers.destroy', $career->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

    </div><!--End Row-->

  <!--start overlay-->
      <div class="overlay toggle-menu"></div>
    <!--end overlay-->

    </div>
    <!-- End container-fluid-->
    @endsection



