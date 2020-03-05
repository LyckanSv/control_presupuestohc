<?php

namespace App\Admin\Controllers;

use App\Director;
use App\User;
use App\Escuela;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class DirectorController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Director';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Director());

        $grid->column('id', __('Id'));
        $grid->column('usuario_id', __('Usuario id'));
        $grid->column('escuela_id', __('Escuela id'));
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
        $show = new Show(Director::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('usuario_id', __('Usuario id'));
        $show->field('escuela_id', __('Escuela id'));
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
        $form = new Form(new Director());

        $form->select('usuario_id')->options(function ($id) {
            $result = User::find($id);
        
            if ($result) {
                return [$result->id => $result->name];
            }
        })->ajax('/admin/api/admin-users');

        $form->select('escuela_id')->options(function ($id) {
            $result = Escuela::find($id);
        
            if ($result) {
                return [$result->id => $result->nombre];
            }
        })->ajax('/admin/api/escuelas');

        return $form;
    }

    public function dias(Request $request)
    {
        $q = $request->get('q');

        return DirectorController::where('id', 'like', "%$q%")->paginate(null, ['id', 'usuario_id as text']);
    }
}
