<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin');
    }

    public function ports()
    {
        $ports = session()->get('ports', [

            [
                'name' => 'Port of Hamburg',
                'country' => 'Germany'
            ],

            [
                'name' => 'Port of Shanghai',
                'country' => 'China'
            ],

            [
                'name' => 'Port of Tanjung Priok',
                'country' => 'Indonesia'
            ]

        ]);

        session()->put('ports', $ports);

        return view('admin_ports', compact('ports'));
    }
    
    public function users()
    {
         $users = session()->get('users', []);

        return view('admin_users', compact('users'));
    }

    public function articles()
    {
        $articles = session()->get('articles', []);

        return view('admin_articles',
            compact('articles'));
    }

    public function createArticle()
    {
        return view('admin_article_create');
    }

    public function storeArticle(Request $request)
    {
        $articles = session()->get('articles', []);

        $articles[] = [
            'title' => $request->title,
            'country' => $request->country,
            'content' => $request->content
        ];

        session()->put('articles', $articles);

        return redirect('/admin/articles');
    }

    public function editArticle($id)
    {
        $articles = session()->get('articles', []);

        $article = $articles[$id];

        return view(
            'admin_article_edit',
            compact('article', 'id')
        );
    }

    public function updateArticle(Request $request,$id)
    {
        $articles = session()->get('articles', []);

        $articles[$id] = [

            'title' => $request->title,
            'country' => $request->country

        ];

        session()->put(
            'articles',
            $articles
        );

        return redirect('/admin/articles');
    }

    public function deleteArticle($id)
    {
        $articles = session()->get('articles', []);

        unset($articles[$id]);

        session()->put(
            'articles',
            array_values($articles)
        );

        return redirect('/admin/articles');
    }

    public function createPort()
    {
        return view('admin_port_create');
    }

    public function storePort(Request $request)
    {
        $ports = session()->get('ports', []);

        $ports[] = [

            'name' => $request->name,
            'country' => $request->country

        ];

        session()->put(
            'ports',
            $ports
        );

        return redirect('/admin/ports');
    }

    public function editPort($id)
    {
        $ports = session()->get('ports', []);

        $port = $ports[$id];

        return view(
            'admin_port_edit',
            compact('port', 'id')
        );
    }

    public function updatePort(Request $request, $id)
    {
        $ports = session()->get('ports', []);

        $ports[$id] = [

            'name' => $request->name,
            'country' => $request->country

        ];

        session()->put(
            'ports',
            $ports
        );

        return redirect('/admin/ports');
    }

    public function deletePort($id)
    {
        $ports = session()->get('ports', []);

        unset($ports[$id]);

        session()->put(
            'ports',
            array_values($ports)
        );

        return redirect('/admin/ports');
    }

    public function createUser()
    {
        return view('admin_user_create');
    }

    public function storeUser(Request $request)
    {

        $request->validate([
            'name'  => 'required',
            'email' => 'required',
            'role'  => 'required'
        ]);

        $users = session()->get('users', []);

        $users[] = [

            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role

        ];

        session()->put('users', $users);

        return redirect('/admin/users');
    }

    public function editUser($id)
    {
        $users = session()->get('users', []);

        $user = $users[$id];

        return view('admin_user_edit',
            compact('user', 'id'));
    }

    public function updateUser(Request $request, $id)
    {
        $users = session()->get('users', []);

        $users[$id] = [

            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role

        ];

        session()->put('users', $users);

        return redirect('/admin/users');
    }

    public function deleteUser($id)
    {
        $users = session()->get('users', []);

        unset($users[$id]);

        $users = array_values($users);

        session()->put('users', $users);

        return redirect('/admin/users');
    }

}