<?php

namespace App\Imports;

use App\Models\ExcelOne;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ExcelDataImport implements ToModel, WithHeadingRow,WithValidation
{
    use Importable;
    public $columns, $model, $validationInfo;

    public function __construct($model, array $columns, array $validationInfo)
    {
        $this->model = $model;
        $this->columns = $columns;
        $this->validationInfo = $validationInfo;
    }
    public function model(array $row)
    {
        if (is_array($this->columns)) {
            $match_col = array_intersect($this->columns,array_keys($row));
            $dataArray = [];
            foreach ($match_col as $eachColumn) {
                array_push($dataArray,[
                    $eachColumn =>  isset($row[$eachColumn]) ? $row[$eachColumn] : null
                    ]);
                }
                $makeSingleArray = (collect($dataArray)->collapse())->toArray();
                $this->model::create($makeSingleArray);
                // dd($match_col);
          
        }
       
    }
    public function rules(): array
    {
        return $this->validationInfo;
    }
}
