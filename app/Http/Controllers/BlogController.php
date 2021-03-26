<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;

use App\Blog;

class BlogController extends Controller
{
  public function details($id){
    $blog = Blog::find($id);
  	$title = $blog->firstHomeTitle;
    
    return view('frontend.blog.blogDetails')->with(compact('title','blog'));
  }
}
