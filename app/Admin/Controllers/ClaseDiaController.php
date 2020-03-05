<?php

namespace App\Admin\Controllers;

use App\ClaseDia;
use App\Dia;
use App\Clase;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ClaseDiaController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\ClaseDia';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ClaseDia());

        $grid->column('id', __('Id'));
        $grid->column('clase_id', __('Clase id'));
        $grid->column('dia_id', __('Dia id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ClaseDia::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('clase_id', __('Clase id'));
        $show->field('dia_id', __('Dia id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ClaseDia());

        $form->select('clase_id')->options(function ($id) {
            $result = Clase::find($id);
            if ($result) {
                return [$result->id => $result->codigo];
            }
        })->ajax('/admin/api/clases');

        $form->select('dia_id')->options(function ($id) {
            $result = Dia::find($id);
            if ($result) {
                return [$result->id => $result->name];
            }
        })->ajax('/admin/api/dias');

        return $form;
    }

    public function claseDias(Request $request)
    {
        $q = $request->get('q');

        return ClaseDia::where('id', 'like', "%$q%")->paginate(null, ['id', 'dia_id as text']);
    }
}
