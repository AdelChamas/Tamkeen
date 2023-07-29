<?php

namespace App\Admin\Controllers;

use App\Models\Chapter;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ChapterController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Chapter';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Chapter());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('assesment_id', __('Assessment id'));
        $grid->column('note_id', __('Note id'));
        $grid->column('course_id', __('Course id'));

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
        $show = new Show(Chapter::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('assesment_id', __('Assessment id'));
        $show->field('note_id', __('Note id'));
        $show->field('course_id', __('Course id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Chapter());

        $form->text('title', __('Title'));
        $form->number('assesment_id', __('Assessment id'));
        $form->number('note_id', __('Note id'));
        $form->number('course_id', __('Course id'));

        return $form;
    }
}
