<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class UserController extends Controller
{
    public function export(Excel $excel) 
{
    return $excel->download(new UserExport,'all_user.xlsx');
    // return Excel::download(new UserExport, 'all_users.csv',\Maatwebsite\Excel\Excel::CSV);
    // return (new UserExport)->download('all_users.csv', Excel::CSV);

}
}
