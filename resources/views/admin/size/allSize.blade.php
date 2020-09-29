@extends('layouts.admin_master')

@section('title')
Size
@endsection
@section('content')
{{-- ------Modal-------- --}}
<!-- Button trigger modal -->  
  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Size</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{ url('/storeSize') }}" method="POST" >
              @csrf
              <div class="form-group">
                  <label for="">Size Name</label>
                  <input type="text" name="size_name" class="form-control" placeholder="Enter Size Name" >
              </div>
              <button class="btn btn-success btn-sm" type="submit">Submit</button>
          </form>
        </div>
        
      </div>
    </div>
  </div>
{{-- ------Modal-------- --}}
<div class="container">
    <div class="row">
            <div class="breadcrumbs">
                <div class="breadcrumbs-inner">
                    <div class="row m-0">
                        <div class="col-sm-4">
                            <div class="page-header float-left">
                                <div class="page-title">
                                    <h1>Dashboard</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="page-header float-right">
                                <div class="page-title">
                                    <ol class="breadcrumb text-right">
                                        <li><a href="#">Dashboard</a></li>
                                        <li class="active">All Size</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="card-head">
                        <button class="btn btn-success btn-sm pull-right m-2"  data-toggle="modal" data-target="#exampleModalCenter" > <b>+</b> Add Size</button>
                        <h3>All Size</h3>

                        <!-- --------error message------------ -->
                            <div class="col-md-12">
                                    @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                        <!-- --------error message------------ -->
                        {{--  --------NOTIFICATION------  --}}
                        @if(Session::has('message'))
                            <p class="alert alert-info mt-2">{{ Session::get('message') }}</p>
                        @endif

                    </div>
                    <br>
                {{--  if want to use Datatable id="mydatatable"  --}}
                <table id="mydatatable"  class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Size Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sizes as $size)
                    <tr>
                        <td>{{$size->id}}</td>
                        <td>{{ $size->size_name }}</td>
                        <td>
                            <button>Edit</button>
                            <button>Delete</button>
                        </td>
                    </tr>
                    @endforeach

                </tbody>

                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
