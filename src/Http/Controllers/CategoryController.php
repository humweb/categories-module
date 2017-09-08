<?php
namespace Humweb\Categories\Http\Controllers;

use Humweb\Categories\Category;

use Humweb\Categories\CategoryRequest;
use Humweb\Categories\Presenter\AdminPresenter;
use Humweb\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $manager;
    protected $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
        //        parent::__construct();
        //        Category::create(array('id' => 1, 'slug'=> 'root-1', 'title' => 'Root 1'   , 'lft' => 1  , 'rgt' => 10 , 'depth' => 0));
        //        Category::create(array('id' => 2, 'slug'=> 'child-1', 'title' => 'Child 1'  , 'lft' => 2  , 'rgt' => 3  , 'depth' => 1, 'parent_id' => 1));
        //        Category::create(array('id' => 3, 'slug'=> 'child-2', 'title' => 'Child 2'  , 'lft' => 4  , 'rgt' => 7  , 'depth' => 1, 'parent_id' => 1));
        //        Category::create(array('id' => 4, 'slug'=> 'child-2-1', 'title' => 'Child 2.1', 'lft' => 5  , 'rgt' => 6  , 'depth' => 2, 'parent_id' => 3));
        //        Category::create(array('id' => 5, 'slug'=> 'child-3', 'title' => 'Child 3'  , 'lft' => 8  , 'rgt' => 9  , 'depth' => 1, 'parent_id' => 1));
        //        Category::create(array('id' => 6, 'slug'=> 'root-2', 'title' => 'Root 2'   , 'lft' => 11 , 'rgt' => 12 , 'depth' => 0));

    }


    /**
     * Get index hierarchy of categories
     *
     * @param \Humweb\Categories\Presenter\AdminPresenter $presenter
     * @param string|null                                 $type
     *
     * @return \Illuminate\View\View
     */
    public function getIndex(AdminPresenter $presenter, $type = null)
    {
        /** @var Baum\Node */
        $root = Category::find(1);

        //Category::rebuild(true);
        $tree = ! is_null($root) ? $root->getDescendantsAndSelf()->toHierarchy() : [];

        $tree = $presenter->toNestable($tree, 5);

        //        dd($tree);
        return view('categories.index', compact('tree'));
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
        if ($category) {
            $url        = route('admin.category.get.create', [$category->id]);
            $parentName = $category->title;
        } else {
            $url           = route('admin.category.get.create');
            $category      = new Category();
            $categoryTitle = '- ROOT -';
        }

        return view('categories.form', compact('parentName', 'url', 'category'));
    }


    /**
     * Store new category
     *
     * @param \Humweb\Categories\CategoryRequest $request
     *
     * @return \Illuminate\View\View
     */
    public function postCreate(CategoryRequest $request, Category $parent)
    {
        if ($parent) {
            // Move to a parent item
            $parent->children()->create($request->all());
        } else {
            // Make root item
            Category::find(0)->children()->create($request->all());
        }

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
        return view('categories.show', compact('category'));
    }


    /**
     * Show the category edit form
     *
     * @param \Humweb\Categories\Category $category
     *
     * @return \Illuminate\View\View
     */
    public function getEdit(Category $category)
    {
        $parentName = $category->isRoot() ? '- ROOT -' : $category->parent->title;
        $url        = route('admin.category.post.update', ['category' => $category->id]);

        return view('categories.form', compact('parentName', 'url', 'category'));
    }


    /**
     * Store the updated category
     *
     * @param \Humweb\Categories\CategoryRequest $request
     * @param \Humweb\Categories\Category        $category
     *
     * @return \Illuminate\View\View
     */
    public function postEdit(CategoryRequest $request, Category $category)
    {
        $category->fill($request->all());
        $category->save();

        return view('_modal_script', [
            'message'    => [
                'type'    => 'success',
                'content' => trans('common.update_object_success', ['name' => trans('category.common.item')])
            ],
            'reloadPage' => true,
        ]);
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

        return response()->json([
            'type'    => 'success',
            'content' => trans('common.delete_object_success', ['name' => trans('category.common.category')]),
        ]);
    }


    /**
     * Move the category in the hierarchy
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postMove()
    {
        $category = $this->getNode('element');

        if (is_null($category)) {
            // TODO: Handle error
        }

        switch (true) {
            case $leftNode = $this->getNode('left'):
                $category->moveToRightOf($leftNode);
                break;
            case $rightNode = $this->getNode('right'):
                $category->moveToLeftOf($rightNode);
                break;
            case $destNode = $this->getNode('parent'):
                $category->makeChildOf($destNode);
                break;
            default:
                // TODO: Handle error
        }

        return response()->json([
            'type'    => 'success',
            'content' => 'Updated Item.',
        ]);
    }


    /**
     *
     * @param \Illuminate\Http\Request $request
     * @param string                   $name
     *
     * @return \Humweb\Categories\Category|null
     */
    protected function getNode($name)
    {

        if ($id = $this->request->get($name)) {
            return Category::find($id);
        } else {
            return null;
        }
    }

}
