<?php

namespace App\View\Components\Admin\Users;

use Illuminate\View\Component;

class UserForm extends Component
{

    public $user, $roles, $postRoute, $formMethod;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user, $roles, $postRoute, $formMethod)
    {
        $this->user = $user;
        $this->roles = $roles;
        $this->postRoute = $postRoute;
        $this->formMethod = $formMethod;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.users.user-form');
    }
}
