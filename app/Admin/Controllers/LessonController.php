<?php

namespace App\Admin\Controllers;

use App\Models\Lesson;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class LessonController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Lesson';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Lesson());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('description', __('Description'));
        $grid->column('video', __('Video'));
        $grid->column('poster', __('Poster'));
        $grid->column('chapter_id', __('Chapter id'));
        $grid->column('quiz_id', __('Quiz id'));

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
        $show = new Show(Lesson::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('attachment_id', __('Attachment id'));
        $show->field('chapter_id', __('Chapter id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Lesson());

        $form->text('title', __('Title'));
        $form->text('description', __('Description'));
        $form->number('attachment_id', __('Attachment id'));
        $form->number('chapter_id', __('Chapter id'));
        $form->file('video', __('Video'));
        $form->file('poster', __('Poster'));
        $form->number('quiz_id', __('Quiz id'));

        return $form;
    }
}
