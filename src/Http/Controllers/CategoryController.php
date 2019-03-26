<?php
namespace Humweb\Categories\Http\Controllers;

use Humweb\Categories\Category;
use Humweb\Categories\CategoryRequest;
use Humweb\Core\Http\Controllers\AdminController;

class CategoryController extends AdminController
{
    protected $manager;
    protected $request;


    public function getIndex($type = null)
    {
        $categories = Category::all();

        return $this->setContent('categories::index', compact('categories'));
    }


    /**
     * Show the category create form
     *
     * @param \Humweb\Categories\Category $category
     *
     * @return \Illuminate\View\View
     */
    public function getCreate(Category $category)
    {
        $category = new Category();

        return $this->setContent('categories::form', [
            'action'   => 'create',
            'url'      => route('admin.category.post.create'),
            'category' => $category,
        ]);
    }


    /**
     * Store new category
     *
     * @param \Humweb\Categories\CategoryRequest $request
     *
     * @return \Illuminate\View\View
     */
    public function postCreate(CategoryRequest $request)
    {
        Category::create([
            'title' => $request->title
        ]);
        return redirect()->route('admin.categories.get.index')->with('success', 'Created category.');
    }


    /**
     * Display the specified category
     *
     * @param \Humweb\Categories\Category $category
     *
     * @return \Illuminate\View\View
     */
    public function show(Category $category)
    {
        return $this->setContent('categories::show', compact('category'));
    }


    /**
     * Show the category edit form
     *
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $category = Category::find($id);

        return $this->setContent('categories::form', [
            'action'   => 'edit',
            'url'      => route('admin.category.post.update'),
            'category' => $category,
        ]);
    }


    /**
     * Store the updated category
     *
     * @param \Humweb\Categories\CategoryRequest $request
     *
     * @return \Illuminate\View\View
     */
    public function postEdit(CategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $category->fill([
            'title' => $request->title
        ]);
        $category->save();

        return redirect()->route('admin.categories.get.index')->with('success', 'Category updated.');
    }

    /**
     * Delete the specified  category
     *
     * @param \Humweb\Categories\Category $category
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function getDelete(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.get.index')->with('success', 'Category deleted.');
    }

}
