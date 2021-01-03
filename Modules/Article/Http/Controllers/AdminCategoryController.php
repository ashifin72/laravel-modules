<?php

namespace Modules\Article\Http\Controllers;

use App\Http\Controllers\Admin\AdminBaseController;


use MetaTag;
use Modules\Article\Entities\Category;
use Modules\Article\Http\Requests\BlogCategoryGreateRequest;
use App\Models\locale;

use App\Repositories\Admin\LocalRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Http\Requests\BlogCategoryUpdateRequest;
use Modules\Article\Repositories\BlogCategoryRepository;


class AdminCategoryController extends AdminBaseController
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


        return view('article::admin.categories.index', compact('items'));
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
        return view('article::admin.categories.create',
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
            ->resultRecording($item, 'admin.category.index');
    }

    public function edit($id)
    {
        $item = $this->blogCategoryRepository->getEdit($id);

        if (empty($item) || $item->id == 1) {
            abort(404);
        }
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        $locales = Locale::where('status', '=', '1')->orderBy('sort', 'desc')->get(array('local'));
        return view('admin..blog.categories.edit', compact('item', 'categoryList', 'locales'));
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
            ->resultRecording($result, 'admin.category.edit', $item->id);
    }

    public function destroy($id)
    {
        //
    }
}
