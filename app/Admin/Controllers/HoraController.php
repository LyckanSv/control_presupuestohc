<?php

namespace App\Admin\Controllers;

use App\Hora;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class HoraController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Hora';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Hora());

        $grid->column('id', __('Id'));
        $grid->column('materia_id', __('Materia id'));
        $grid->column('docente_id', __('Docente id'));
        $grid->column('seccion', __('Seccion'));
        $grid->column('hora', __('Hora'));
        $grid->column('dias', __('Dias'));
        $grid->column('cupo', __('Cupo'));
        $grid->column('inscritos', __('Inscritos'));
        $grid->column('disponible', __('Disponible'));
        $grid->column('aula', __('Aula'));
        $grid->column('estado', __('Estado'));
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
        $show = new Show(Hora::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('materia_id', __('Materia id'));
        $show->field('docente_id', __('Docente id'));
        $show->field('seccion', __('Seccion'));
        $show->field('hora', __('Hora'));
        $show->field('dias', __('Dias'));
        $show->field('cupo', __('Cupo'));
        $show->field('inscritos', __('Inscritos'));
        $show->field('disponible', __('Disponible'));
        $show->field('aula', __('Aula'));
        $show->field('estado', __('Estado'));
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
        $form = new Form(new Hora());

        $form->number('materia_id', __('Materia id'));
        $form->number('docente_id', __('Docente id'));
        $form->text('seccion', __('Seccion'));
        $form->text('hora', __('Hora'));
        $form->text('dias', __('Dias'));
        $form->text('cupo', __('Cupo'));
        $form->text('inscritos', __('Inscritos'));
        $form->text('disponible', __('Disponible'));
        $form->text('aula', __('Aula'));
        $form->text('estado', __('Estado'));
        $form->select('estado', 'Estado')->options(['cerrado' => 'Cerrado', 'abierto' => 'Abierto']);


        return $form;
    }
}
