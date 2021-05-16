<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index(){

    	$title = "Welcome to index page";
    	return view('pages.index',compact('title'));
    }

    public function aboutus(){

    	$title = "Welcome to about page";
    	//return view('pages.about',compact('title'));
        return  view('pages.about')->with('title',$title);
    }
    public function services(){

    	$data = array(
            'title'=> 'Service page',
            'contant' => ['Web Design','Development','SEO']
        );
    	return view('pages.service')->with($data);
    }
}
