<?php

namespace App\Admin\Controllers;

use App\Models\Assessment;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AssesmentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Assessment';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Assessment());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('structure', __('Structure'));
        $grid->column('duration', __('Duration'));
        $grid->column('type', __('Type'));
        $grid->column('user_id', __('User Id'));

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
        $show = new Show(Assessment::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('structure', __('Structure'));
        $show->field('duration', __('Duration'));
        $show->field('type', __('Type'));
        $show->field('user_id', __('User Id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Assessment());

        $form->text('title', __('Title'));
        $form->textarea('structure', __('Structure'));
        $form->number('duration', __('Duration'));
        $form->number('type', __('Type'));
        $form->number('user_id', __('User'));

        return $form;
    }
}
