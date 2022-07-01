<?php

namespace App\Http\Controllers;

use App\Exports\ClosedExport;
use App\Imports\FacilityImport;
use App\Models\ClosedFacility;
use App\Utilities\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Maatwebsite\Excel\Excel;

class ClosedFacilityController extends Controller
{
    /**
     * @var FileUpload
     */
    private $fileUpload;

    /**
     * @param FileUpload $fileUpload
     */
    public function __construct(FileUpload $fileUpload)
    {
        $this->fileUpload = $fileUpload;
    }

    public function index()
    {

        return view('index');
    }

    public function import(Request $request)
    {

        if ($request->hasFile('closed_data')) {
            $file = $request->file('closed_data');
            $upload = $this->fileUpload->handle($file, storage_path('app'), "closed");
            $filePath = sprintf("%s/%s", storage_path('app'), Arr::get($upload, 'filename'));

            (new FacilityImport)->import($filePath);

        }
        return redirect()->back();
    }

    public function download()
    {

       return (new ClosedExport())->download('closed_epark_answer.xlsx',);

    }
}
