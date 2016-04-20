<?php

namespace App\Modules\ApiManager\Http\Controllers;

use App\Modules\AbstractModulesController;
use App\Modules\ApiManager\Http\Requests\UpdateRequestUser;
use App\Modules\Models\User;
use Illuminate\Support\Facades\View;

class UserController extends AbstractModulesController
{
    /**
     * Lista todos Usuários.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = User::all();
        return view($this->page, compact(['data']));
    }

    /**
     * Cria um novo usuário.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view($this->page);
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view($this->page, compact(['data']));
    }

    protected function update(UpdateRequestUser $updateRequestUser, $id)
    {
        if($dataPost = $updateRequestUser->all())
        {
            /** @var User $userData */
            $userData   =   User::findOrFail($id);

            if($userData->update($dataPost))
            {
                return redirect('/user/' . $id . '/edit')->with($this->getMessage('update'));
            }
            else
            {
                return redirect('/user/' . $id . '/edit')->withErrors($updateRequestUser);
            }
        }
    }
}
