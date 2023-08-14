<?php

namespace App\Admin\Controllers;

use App\Models\Course;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CourseController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Course';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Course());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('price', __('Price'));
        $grid->column('overview', __('Overview'));
        $grid->column('subjects', __('Subjects'));
        $grid->column('outcomes', __('Outcomes'));
        $grid->column('pre_requisites', __('Pre Requisites'));
        $grid->column('about', __('About'));
        $grid->column('image', __('Image Path'));
        $grid->column('category_id', __('Category'));


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
        $show = new Show(Course::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Course());

        $form->text('title');
        $form->tmeditor('overview');
        $form->text('subjects');
        $form->number('price');
        $form->tmeditor('outcomes');
        $form->text('pre_requisites');
        $form->tmeditor('about');
        $form->file('image');
        $form->select('category_id')->options(\App\Models\Category::all()->pluck('category', 'id'));

        return $form;
    }
}
