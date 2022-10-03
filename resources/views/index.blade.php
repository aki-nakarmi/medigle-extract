@extends('layout.app')
@section('body')
    <div>
        <div class="card mb-5">
            <div class="card-body">
                <form method="post" action="{{route('closed.import')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="mb-3">
                        <label for="formFileSm" class="form-label">ファイルのアップロード</label>
                        <input class="form-control form-control-sm"　 id="formFileSm" type="file" name="closed_data">
                    </div>

                    <button type="submit" class="btn btn-primary">アップロード</button>
                </form>
            </div>
            <div class="card-footer">
                <a class="btn btn-primary" href="{{route('closed.download')}}" role="button">ダウンロード</a>
                <a class="btn btn-danger pull-right" href="{{route('closed.destroy')}}" role="button">すべて削除</a>
            </div>
        </div>

        <div class="mt-5">
            <h3>電話番号 一致</h3>
            <div class="card mt-20">
                <div class="card-body">
                    <form method="post" action="{{route('tel.import')}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="mb-3">
                            <label for="formFileSm" class="form-label">ファイルのアップロード</label>
                            <input class="form-control form-control-sm"　 id="formFileSm" type="file" name="compare_tel">
                        </div>

                        <button type="submit" class="btn btn-primary">アップロード</button>
                    </form>
                </div>
                <div class="card-footer">
                    <a class="btn btn-primary" href="{{route('tel.download')}}" role="button">ダウンロード</a>
                    <a class="btn btn-danger pull-right" href="{{route('tel.destroy')}}" role="button">すべて削除</a>
                </div>
            </div>
        </div>



    </div>
@endsection
