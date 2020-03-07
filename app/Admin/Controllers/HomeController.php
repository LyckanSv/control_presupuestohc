<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Admin\Forms\UploadFile;
use Encore\Admin\Layout\Content;



class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Panel')
            ->description('Ayuda a administrar las horas clases')
            ->body(new UploadFile());
    }
}
