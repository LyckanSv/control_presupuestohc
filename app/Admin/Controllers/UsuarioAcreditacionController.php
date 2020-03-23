<?php

namespace App\Admin\Controllers;

use App\UsuarioAcreditacion;
use App\AdminUser;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UsuarioAcreditacionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\UsuarioAcreditacion';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new UsuarioAcreditacion());

        $grid->column('id', __('Id'));
        $grid->column('usuario_id', __('Usuario id'));
        $grid->column('tipo_acreditacion_id', __('Tipo acreditacion id'));
        $grid->column('Acreditacion', __('Acreditacion'));
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
        $show = new Show(UsuarioAcreditacion::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('usuario_id', __('Usuario id'));
        
        $show->field('Acreditacion', __('Acreditacion'));
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
        $form = new Form(new UsuarioAcreditacion());

        $form->select('usuario_id')->options(function ($id) {
            $result = AdminUser::find($id);
            if ($result) {
                return [$result->id => $result->username];
            }
        })->ajax('/admin/api/admin-users'); 
        $form->select('Acreditacion', 'Acreditacion')->options(['Maestria1' => 'Maestria1', 'Maestria2' => 'Maestria2', 'Doctorado' => 'Doctorado', 'Doctrinado' => 'Doctrinado']);


        return $form;
    }
}
