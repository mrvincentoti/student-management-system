@extends('layouts.landing')

@section('content')
    <div class="container-fluid text-center">
         <div class="row">
              <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Upload students</h4>
                    </div>
                    <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        
                            @csrf
                            <!-- <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                                <div class="custom-file text-left">
                                    <input type="file" name="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div> -->
                            <div class="form-group form-float col-md-12" style="max-width: 500px; margin: 0 auto;">
                                <div class="form-line">
                                    <!-- <label class="form-label">Choose excel file</label> -->
                                    <code>Please not that the file must be an excel file with the following columns [jambregno,surname,middlename,firstname] in this same order</code>
                                    <input type="file" class="form-control" name="file" id="customFile" required>
                                </div>
                            </div>
                            <!-- <button class="btn btn-primary">Import data</button> -->
                            <!-- <a class="btn btn-success" href="{{ route('file-export') }}">Export data</a> -->
                       
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary mr-1">Import data</button>
                    </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
@endsection