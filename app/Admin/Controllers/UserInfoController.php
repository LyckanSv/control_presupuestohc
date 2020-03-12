<?php

namespace App\Admin\Controllers;

use App\UserInfo;
use App\AdminUser;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserInfoController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\UserInfo';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new UserInfo());

        $grid->column('id', __('Id'));
        $grid->column('usuario_id', __('Usuario id'));
        $grid->column('codigo', __('Codigo'));
        $grid->column('direccion', __('Direccion'));
        $grid->column('telefono', __('Telefono'));
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
        $show = new Show(UserInfo::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('usuario_id', __('Usuario id'));
        $show->field('codigo', __('Codigo'));
        $show->field('direccion', __('Direccion'));
        $show->field('telefono', __('Telefono'));
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
        $form = new Form(new UserInfo());

        $form->select('usuario_id')->options(function ($id) {
            $result = AdminUser::find($id);
            if ($result) {
                return [$result->id => $result->username];
            }
        })->ajax('/admin/api/admin-users');
        $form->text('codigo', __('Codigo'));
        $form->text('direccion', __('Direccion'));
        $form->text('telefono', __('Telefono'));

        return $form;
    }
}
