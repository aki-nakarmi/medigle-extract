<?php

namespace App\Http\Controllers;

use App\Exports\ClosedExport;
use App\Exports\TelExport;
use App\Imports\FacilityImport;
use App\Imports\TelImport;
use App\Models\CompareTel;
use App\Utilities\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class FacilityTelController extends Controller
{
    protected $fileUpload;

    public function __construct(FileUpload $fileUpload)
    {
        $this->fileUpload=$fileUpload;
    }

    public function import(Request  $request){
        if ($request->hasFile('compare_tel')) {
            $file = $request->file('compare_tel');
            $upload = $this->fileUpload->handle($file, storage_path('app'), "tel");
            $filePath = sprintf("%s/%s", storage_path('app'), Arr::get($upload, 'filename'));

            (new TelImport())->import($filePath);
            flash('アップロードが完了しました。');
        }
        flash('ファイルが利用できません。');
        return redirect()->back();
    }
    public function download()
    {

        return (new TelExport())->download('compare_tel_answer.xlsx');

    }
    public function destroy(){
        try {
            CompareTel::truncate();
            flash()->message("テーブルからすべてのデータを消しました。");
        }catch (\Exception $exception){
            logger()->error($exception->getMessage());
            flash()->error($exception->getMessage());
        }
        return redirect()->back();
    }
}
