<?php

namespace App\Admin\Controllers;

use App\Clase;
use App\Aula;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ClaseController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Clase';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Clase());

        $grid->column('id', __('Id'));
        $grid->column('materia_id', __('Materia id'));
        $grid->column('aula_id', __('Aula id'));
        $grid->column('usuario_id', __('Usuario id'));
        $grid->column('bloque_horas_id', __('Bloque horas id'));
        $grid->column('estado_clase_id', __('Estado clase id'));
        $grid->column('codigo', __('Codigo'));
        $grid->column('fecha_inicio_curso', __('Fecha inicio curso'));
        $grid->column('fecha_finalizacion_curso', __('Fecha finalizacion curso'));
        $grid->column('cupo', __('Cupo'));
        $grid->column('inscritos', __('Inscritos'));
        $grid->column('seccion', __('Seccion'));
        $grid->column('sueldo_hora', __('Sueldo hora'));
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
        $show = new Show(Clase::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('materia_id', __('Materia id'));
        $show->field('aula_id', __('Aula id'));
        $show->field('usuario_id', __('Usuario id'));
        $show->field('bloque_horas_id', __('Bloque horas id'));
        $show->field('estado_clase_id', __('Estado clase id'));
        $show->field('codigo', __('Codigo'));
        $show->field('fecha_inicio_curso', __('Fecha inicio curso'));
        $show->field('fecha_finalizacion_curso', __('Fecha finalizacion curso'));
        $show->field('cupo', __('Cupo'));
        $show->field('inscritos', __('Inscritos'));
        $show->field('seccion', __('Seccion'));
        $show->field('sueldo_hora', __('Sueldo hora'));
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
        $form = new Form(new Clase());

        $form->number('materia_id', __('Materia id'));
        $form->select('aula_id')->options(function ($id) {
            $result = Aula::find($id);
            if ($result) {
                return [$result->id => $result->numero];
            }
        })->ajax('/admin/api/aulas');
        $form->number('usuario_id', __('Usuario id'));
        $form->number('bloque_horas_id', __('Bloque horas id'));
        $form->number('estado_clase_id', __('Estado clase id'));
        $form->number('codigo', __('Codigo'));
        $form->date('fecha_inicio_curso', __('Fecha inicio curso'))->default(date('Y-m-d'));
        $form->date('fecha_finalizacion_curso', __('Fecha finalizacion curso'))->default(date('Y-m-d'));
        $form->number('cupo', __('Cupo'));
        $form->number('inscritos', __('Inscritos'));
        $form->text('seccion', __('Seccion'));
        $form->decimal('sueldo_hora', __('Sueldo hora'));

        return $form;
    }
}
