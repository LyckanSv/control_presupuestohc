<?php

namespace App\Admin\Forms;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use App\ExcelPayload;
use App\Imports\ExcelImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;


class UploadFile extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Carga de excel';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        $aa = Storage::disk('admin')->put('test', $request->excel);
        $contents = Storage::disk('admin')->get($aa);

        $data = Excel::toArray(new ExcelPayload, $request->excel);
        dd($data[0][1][0]);
       
        admin_success('Processed successfully.');

        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->file('excel')->uniqueName();

    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        return [
        ];
    }
}
