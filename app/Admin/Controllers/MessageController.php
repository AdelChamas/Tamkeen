<?php

namespace App\Admin\Controllers;

use App\Models\Message;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MessageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Message';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Message());

        $grid->column('id', __('Id'));
        $grid->column('content', __('Content'));
        $grid->column('sender_id', __('Sender id'));
        $grid->column('receiver_id', __('Receiver id'));
        $grid->column('discussion_id', __('Discussion id'));

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
        $show = new Show(Message::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('content', __('Content'));
        $show->field('sender_id', __('Sender id'));
        $show->field('receiver_id', __('Receiver id'));
        $show->field('discussion_id', __('Discussion id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Message());

        $form->text('content', __('Content'));
        $form->number('sender_id', __('Sender id'));
        $form->number('receiver_id', __('Receiver id'));
        $form->number('discussion_id', __('Discussion id'));

        return $form;
    }
}
