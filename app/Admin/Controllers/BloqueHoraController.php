<?php

namespace App\Admin\Controllers;

use App\BloqueHora;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BloqueHoraController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\BloqueHora';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BloqueHora());

        $grid->column('id', __('Id'));
        $grid->column('hora_entrada', __('Hora entrada'));
        $grid->column('hora_salida', __('Hora salida'));
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
        $show = new Show(BloqueHora::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('hora_entrada', __('Hora entrada'));
        $show->field('hora_salida', __('Hora salida'));
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
        $form = new Form(new BloqueHora());

        $form->text('hora_entrada', __('Hora entrada'));
        $form->text('hora_salida', __('Hora salida'));

        return $form;
    }
}
