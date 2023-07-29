<?php

namespace App\Admin\Controllers;

use App\Models\Discussion;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DiscussionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Discussion';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Discussion());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('question', __('Question'));
        $grid->column('chapter_id', __('Chapter id'));

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
        $show = new Show(Discussion::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('question', __('Question'));
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
        $form = new Form(new Discussion());

        $form->text('title', __('Title'));
        $form->text('question', __('Question'));
        $form->number('chapter_id', __('Chapter id'));

        return $form;
    }
}
