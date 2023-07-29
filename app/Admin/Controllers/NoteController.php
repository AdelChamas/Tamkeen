<?php

namespace App\Admin\Controllers;

use App\Models\Note;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class NoteController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Note';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Note());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('note', __('Note'));

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
        $show = new Show(Note::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('note', __('Note'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Note());

        $form->textarea('title', __('Title'));
        $form->textarea('note', __('Note'));
        $form->number('user_id', __('User'));

        return $form;
    }
}
