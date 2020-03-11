<?php

namespace App\Admin\Controllers;

use App\Materia;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class MateriaController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Materia';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Materia());

        $grid->column('id', __('Id'));
        $grid->column('codigo', __('Codigo'));
        $grid->column('nombre', __('Nombre'));
        $grid->column('unidad_valorativa', __('Unidad valorativa'));
        $grid->column('facultad_id', __('Facultad id'));
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
        $show = new Show(Materia::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('codigo', __('Codigo'));
        $show->field('nombre', __('Nombre'));
        $show->field('unidad_valorativa', __('Unidad valorativa'));
        $show->field('facultad_id', __('Facultad id'));
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
        $form = new Form(new Materia());

        $form->text('codigo', __('Codigo'));
        $form->text('nombre', __('Nombre'));
        $form->number('unidad_valorativa', __('Unidad valorativa'));
        $form->select('facultad_id')->options(function ($id) {
            $result = Materia::find($id);
        
            if ($result) {
                return [$result->id => $result->nombre];
            }
        })->ajax('/admin/api/facultades');

        return $form;
    }

    public function materias(Request $request)
    {
        $q = $request->get('q');

        return Materia::where('id', 'like', "%$q%")->paginate(null, ['id', 'nombre as text']);
    }
}
