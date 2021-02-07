<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Admin\AdminBaseController;


use MetaTag;
use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\Post;
use Modules\Blog\Http\Requests\BlogCategoryGreateRequest;
use App\Models\Locale;

use App\Repositories\Admin\LocalRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Http\Requests\BlogCategoryUpdateRequest;
use Modules\Blog\Repositories\BlogCategoryRepository;


class AdminCategoriesController extends AdminBaseController
{
    private $blogCategoryRepository;
    private $localRepository;

    public function __construct()
    {
        parent::__construct();
        $this->localRepository = app(LocalRepository::class);
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        MetaTag::setTags(['title' => __('admin.categories_blog')]);

        $items = $this->blogCategoryRepository->getAllWithCategoryPaginate(20);


        return view('blog::admin.categories.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = Category::make();
        $categoryList = $this->blogCategoryRepository->getForComboBox();
        $locales = Locale::where('status', '=', '1')->orderBy('sort', 'desc')->get(array('local'));
        return view('blog::admin.categories.create',
            compact('item', 'categoryList', 'locales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryGreateRequest $request)
    {
        $data = $request->input();// получаем  проверенные данные из формы


        $item = Category::create($data);

        return $this->blogCategoryRepository
            ->resultRecording($item, 'admin.categories.index');
    }

    public function edit($id)
    {
        $item = $this->blogCategoryRepository->getEdit($id);

        if (empty($item) || $item->id == 1) {
            abort(404);
        }
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        $locales = Locale::where('status', '=', '1')->orderBy('sort', 'desc')->get(array('local'));
        return view('blog::admin.categories.edit', compact('item', 'categoryList', 'locales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {

        $item = $this->blogCategoryRepository->getEdit($id);

        $this->blogCategoryRepository->issetItem($item);
        $data = $request->all();

        $result = $item
            ->fill($data)
            ->save();

        return $this->blogCategoryRepository
            ->resultRecording($result, 'admin.categories.edit', $item->id);
    }

    public function destroy($id)
    {
        $post = Post::where('category_id', '=', $id)->get();
        $category = Category::where('parent_id', '=', $id)->get();
        if (count($post)){
            return back()->withErrors(['msg'=> __('admin.error_isset_date')]);
        }
        if (count($category)){
            return back()->withErrors(['msg'=> __('admin.error_isset_parent')]);
        }
        $result = Category::destroy($id);
        if ($result) {
            return redirect()
                ->route('admin.categories.index')
                ->with(['success' => __('admin.article'). ' id ' . $id . __('admin.delete')]);
        } else {
            return back()->withErrors(['msg' => __('admin.error_del')]);
        }
    }
}
