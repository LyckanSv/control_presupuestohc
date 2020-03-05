<?php

namespace App\Admin\Controllers;

use App\ClaseImpartida;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;


class ClaseImpartidaController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\ClaseImpartida';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ClaseImpartida());

        $grid->column('id', __('Id'));
        $grid->column('clase_id', __('Clase id'));
        $grid->column('fecha', __('Fecha'));
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
        $show = new Show(ClaseImpartida::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('clase_id', __('Clase id'));
        $show->field('fecha', __('Fecha'));
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
        $form = new Form(new ClaseImpartida());

        $form->number('clase_id', __('Clase id'));
        $form->date('fecha', __('Fecha'))->default(date('Y-m-d'));

        return $form;
    }

    public function clases(Request $request)
    {
        $q = $request->get('q');

        return ClaseImpartida::where('id', 'like', "%$q%")->paginate(null, ['id', 'fecha as text']);
    }
    
}
