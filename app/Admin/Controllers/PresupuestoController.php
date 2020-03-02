<?php

namespace App\Admin\Controllers;

use App\Presupuesto;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PresupuestoController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Presupuesto';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Presupuesto());

        $grid->column('id', __('Id'));
        $grid->column('director_id', __('Director id'));
        $grid->column('fecha', __('Fecha'));
        $grid->column('dinero', __('Dinero'));
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
        $show = new Show(Presupuesto::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('director_id', __('Director id'));
        $show->field('fecha', __('Fecha'));
        $show->field('dinero', __('Dinero'));
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
        $form = new Form(new Presupuesto());

        $form->number('director_id', __('Director id'));
        $form->date('fecha', __('Fecha'))->default(date('Y-m-d'));
        $form->decimal('dinero', __('Dinero'));

        return $form;
    }
}
