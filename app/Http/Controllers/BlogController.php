<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function categories(Request $request)
    {
        $categories = BlogCategory::all();
        $parentcategories = BlogCategory::where('parentcategory', "0")->get();
        return view('online.blogs.categories', compact('categories', 'parentcategories'));
    }

    public function storecategories(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:blog_catgeory,name'],
            // 'parentcategory' => ['required'],
        ]);

        $category = new BlogCategory;
        $category->name = $request->name;
        $slug = strtolower($request->name);
        $category->slug = str_replace(' ', '-', $slug) ;
        $category->parentcategory = $request->parentcategory;
        $parentcat= BlogCategory::where('id', $request->parentcategory)->first();
        $category->parentcategory_name = $parentcat->name;
        $category->save();
        return redirect('/blog-categories')->with('success', 'Category Saved Succesfully!');
    }

    public function updatecategories(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:blog_catgeory,name'],
        ]);

        $category = BlogCategory::find($request->id);
        $category->name = $request->name;
        $slug = strtolower($request->name);
        $category->slug = str_replace(' ', '-', $slug) ;
        $category->parentcategory = $request->parentcategory;
        $parentcat= BlogCategory::where('id', $request->parentcategory)->first();
        $category->parentcategory_name = $parentcat->name;
        $category->save();
        return redirect('/blog-categories')->with('success', 'Category Saved Succesfully!');
    }

    public function deleteCategory($id){
        $data = BlogCategory::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Category Deleted!');
    }

    //TAGS
    public function tags(Request $request)
    {
        $tags = Tag::all();
        return view('online.blogs.tags', compact(var_name: 'tags'));
    }

    public function updatetags(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tags,name'],
        ]);

        $category = Tag::find($request->id);
        $category->name = $request->name;
        $slug = strtolower($request->name);
        $category->slug = str_replace(' ', '-', $slug) ;
        $category->save();
        return redirect('/tags')->with('success', 'Category Saved Succesfully!');
    }

    public function deletetag($id){
        $data = Tag::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Tag Deleted!');
    }
    public function storetags(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tags,name'],
        ]);

        $tag = new Tag;
        $tag->name = $request->name;
        $tag->slug = str_replace(' ', '-', $request->name) ;
        $tag->save();
        return redirect('/tags')->with('success', 'Tag Saved Succesfully!');
    }

    public function storetag(Request $request)
    {
        $request->validate([
            'tag' => 'required|string|max:255|unique:tags,name',
        ]);

        $tag = new Tag();
        $tag->name = $request->tag;
        
        // Create the slug using the tag name
        $slug = strtolower($request->tag);
        $tag->slug = str_replace(' ', '-', $slug);
        
        $tag->save();

        return response()->json(['success' => true, 'tag' => $tag]);
    }


    //BLOGS
    public function getBlogsList(Request $request)
    {
        $blogs = Blog::all();
        return view('online.blogs.blogs-list', compact('blogs'));
    }

    public function addBlogs(Request $request)
    {
        $categories = BlogCategory::all();
        $tags = Tag::all();
        return view('online.blogs.add-blogs', compact('categories', 'tags'));
    }
    
    public function storeblogs(Request $request) {
        $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:blogs,title'],
            'description' => ['required'],
            'seotitle' => ['required'],
            'seodescription' => ['required'],
            'allow_search' => ['required'],
            'follow_links' => ['required'],
            'category' => ['required'],
            'status' => ['required'],
            'tags' => ['required'],
            'blog_image' => ['required'],

        ]);

        $blog = new Blog;
        $blog->title = $request->title;
        $slug = strtolower($request->title);
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        $blog->slug = str_replace(' ', '-', $slug);
        $blog->description = $request->description;
        $blog->seotitle = $request->seotitle;
        $blog->seodescription = $request->seodescription;
        $blog->allow_search = $request->allow_search;
        $blog->follow_links = $request->follow_links;
        
        if ($request->hasFile('blog_image')) {
            $imageName = time() . '_' . $request->file('blog_image')->getClientOriginalName();
            $imagePath = public_path('images/blogs/blog');
            $request->file('blog_image')->move($imagePath, $imageName);
            $blog->blog_image = 'images/blogs/blog/' . $imageName;
        }

        if ($request->hasFile('social_image')) {
            $imageName = time() . '_' . $request->file('social_image')->getClientOriginalName();
            $imagePath = public_path('images/blogs/social');
            $request->file('social_image')->move($imagePath, $imageName);
            $blog->social_image = 'images/blogs/social/' . $imageName;
        }
    
        $blog->social_title = $request->social_title;
        $blog->social_description = $request->social_description;
    
        if ($request->hasFile('x_image')) {
            $imageName = time() . '_' . $request->file('x_image')->getClientOriginalName();
            $imagePath = public_path('images/blogs/x_image');
            $request->file('x_image')->move($imagePath, $imageName);
            $blog->x_image = 'images/blogs/x_image/' . $imageName;
        }
        
        $blog->x_title = $request->x_title;
        $blog->x_description = $request->x_description;
        $blog->category = $request->category;
        $blog->tags = json_encode($request->tags);
        $blog->status = $request->status;
        $blog->author = "Admin";
        $blog->publish_date = date('Y-m-d H:i:s');

        $category = BlogCategory::where('id', $request->category)->first();
        $blog->category_name = $category->name;

        if ($category->parentcategory != "0") {
            // Get the parent category ID
            $parentId = $category->parentcategory;
            // Fetch the parent category based on the parent ID
            $child_category = BlogCategory::where('id', $parentId)->first();
            
            if ($child_category) {
                $blog->child_category_name = $child_category->name;
            } else {
                // Handle the case where the parent category doesn't exist, if necessary
                $blog->child_category_name = null; // or some default value
            }
        }        

        $tags = Tag::whereIn('id', $request->tags)->get();
        $tagsNames = $tags->pluck('name')->toArray();
        $tagsString = implode(', ', $tagsNames);
        $blog->tags_name = $tagsString;
        $blog->canonical_url = strtolower(str_replace(' ', '-', $request->title)). '/' .str_replace(' ', '-', $slug);
        $blog->save();
        
        return redirect('/blogs-list')->with('success', 'Blog Saved Successfully!');
    }

    public function editblog($id){
        $blog =Blog::find($id);
        $categories = BlogCategory::all();
        $tags = Tag::all();
        return view('online.blogs.edit-blog', compact('blog', 'categories', 'tags'));
    }

    public function updateblogs(Request $request) {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'seotitle' => ['required'],
            'seodescription' => ['required'],
            'allow_search' => ['required'],
            'follow_links' => ['required'],
            'category' => ['required'],
            'status' => ['required'],
            'tags' => ['required'],
        ]);

        $blog = Blog::find($request->id);
        $blog->title = $request->title;
        $slug = strtolower($request->slug);
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        $blog->slug = str_replace(' ', '-', $slug);
        $blog->description = $request->description;
        $blog->seotitle = $request->seotitle;
        $blog->seodescription = $request->seodescription;
        $blog->allow_search = $request->allow_search;
        $blog->follow_links = $request->follow_links;
        
        if ($request->hasFile('blog_image')) {
            $imageName = time() . '_' . $request->file('blog_image')->getClientOriginalName();
            $imagePath = public_path('images/blogs/blog');
            $request->file('blog_image')->move($imagePath, $imageName);
            $blog->blog_image = 'images/blogs/blog/' . $imageName;
        }

        if ($request->hasFile('social_image')) {
            $imageName = time() . '_' . $request->file('social_image')->getClientOriginalName();
            $imagePath = public_path('images/blogs/social');
            $request->file('social_image')->move($imagePath, $imageName);
            $blog->social_image = 'images/blogs/social/' . $imageName;
        }
    
        $blog->social_title = $request->social_title;
        $blog->social_description = $request->social_description;
    
        if ($request->hasFile('x_image')) {
            $imageName = time() . '_' . $request->file('x_image')->getClientOriginalName();
            $imagePath = public_path('images/blogs/x_image');
            $request->file('x_image')->move($imagePath, $imageName);
            $blog->x_image = 'images/blogs/x_image/' . $imageName;
        }
        
        $blog->x_title = $request->x_title;
        $blog->x_description = $request->x_description;
        $blog->category = $request->category;
        $blog->tags = json_encode($request->tags);
        $blog->status = $request->status;
        $blog->author = "Admin";
        $blog->publish_date = date('Y-m-d H:i:s');

        $category = BlogCategory::where('id', $request->category)->first();
        $blog->category_name = $category->name;

        if ($category->parentcategory != "0") {
            // Get the parent category ID
            $parentId = $category->parentcategory;
            // Fetch the parent category based on the parent ID
            $child_category = BlogCategory::where('id', $parentId)->first();
            
            if ($child_category) {
                $blog->child_category_name = $child_category->name;
            } else {
                // Handle the case where the parent category doesn't exist, if necessary
                $blog->child_category_name = null; // or some default value
            }
        }

        $tags = Tag::whereIn('id', $request->tags)->get();
        $tagsNames = $tags->pluck('name')->toArray();
        $tagsString = implode(', ', $tagsNames);
        $blog->tags_name = $tagsString;

        $blog->canonical_url = strtolower(str_replace(' ', '-', $category->name)). '/' .str_replace(' ', '-', $slug);
        $blog->save();
        
        return redirect('/blogs-list')->with('success', 'Blog Updated Successfully!');
    }
    
    public function deleteblog($id){
        $data = Blog::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Blog Deleted!');
    }

}
