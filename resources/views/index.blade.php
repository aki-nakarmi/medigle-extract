@extends('layout.app')
@section('body')
    <div>
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{route('closed.import')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="mb-3">
                        <label for="formFileSm" class="form-label">File Upload</label>
                        <input class="form-control form-control-sm"　 id="formFileSm" type="file" name="closed_data">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="card-footer">
                <a class="btn btn-primary" href="{{route('closed.download')}}" role="button">Download</a>
            </div>
        </div>


    </div>
@endsection
