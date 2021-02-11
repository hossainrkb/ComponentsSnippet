<?php

namespace App\Http\Controllers;

use App\Models\ExcelOne;
use Illuminate\Http\Request;
use App\Imports\ExcelDataImport;

class ExcelOneController extends Controller
{
    public function excelInportCreate()
    {
        return view('file_upload.excel_file_upload');
    }
    public function excelInportStore(Request $request)
    {
        try {
            $filePathData = null;
            if (($request->has('excel_file_upload'))) {
                $file_path = $request->file('excel_file_upload')->store('/public/test_folder/');
                $filePathData = storage_path("app/" . $file_path);
                $columnsInfo = [
                    "first_column", "second_column", "third_column", "forth_column",
                ];
                $validationInfo = [
                    "*.first_column" => ['required'],
                    "*.second_column" => ['required', 'integer'],
                    "*.third_column" => ['required', 'integer'],
                ];
                $itemsInport = new ExcelDataImport(ExcelOne::class, $columnsInfo, $validationInfo);
                $itemsInport->import($filePathData);

                return json_encode(['status' => "success"]);
            }
        } catch (\Throwable $th) {
            return json_encode(['status' => "error", "message" => $th->failures()]);
        }
    }
}
