<?php

namespace App\Admin\Controllers;

use App\Aula;
use App\Edificio;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class AulaController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Aula';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Aula());

        $grid->column('id', __('Id'));
        $grid->column('cod', __('Cod'));
        $grid->column('numero', __('Numero'));
        $grid->column('edificio_id', __('Edificio id'));
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
        $show = new Show(Aula::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('cod', __('Cod'));
        $show->field('numero', __('Numero'));
        $show->field('edificio_id', __('Edificio id'));
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
        $form = new Form(new Aula());

        $form->number('cod', __('Cod'));
        $form->number('numero', __('Numero'));
       
        $form->select('edificio_id')->options(function ($id) {
            $edificio = Edificio::find($id);
        
            if ($edificio) {
                return [$edificio->id => $edificio->nombre];
            }
        })->ajax('/admin/api/edificios');
        return $form;
    }
}
