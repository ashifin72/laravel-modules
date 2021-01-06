<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Repositories\Admin\LocalRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\Tag;
use Modules\Blog\Http\Requests\TagGreateRequest;
use Modules\Blog\Http\Requests\TagUpdateRequest;
use Modules\Blog\Repositories\BlogCategoryRepository;
use Modules\Blog\Repositories\TagRepository;

class AdminTagsController extends AdminBaseController
{
    private $tagRepository;
    private $localRepository;

    public function __construct()
    {
        parent::__construct();
        $this->localRepository = app(LocalRepository::class);
        $this->tagRepository = app(TagRepository::class);

    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $items =$this->tagRepository->getAllWithTagPaginate();
        return view('blog::admin.tags.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $item = Tag::make();
        $locales = $this->tagRepository->getActiveLocales();
        return view('blog::admin.tags.create',
            compact('item', 'locales'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(TagGreateRequest $request)
    {
        $data = $request->input();
        $item = Tag::create($data);
        return $this->tagRepository
            ->resultRecording($item, 'admin.tags.index');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $item = $this->tagRepository->getEditId($id);
        if (empty($item)){
            abort(404);
        }
        $locales = $this->tagRepository->getActiveLocales();
        return view('blog::admin.tags.edit', compact('item', 'locales'));

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(TagUpdateRequest $request, $id)
    {
        $item = $this->tagRepository->getEditId($id);
        $this->tagRepository->issetItem($item);
        $data = $request->all();

        $result = $item
            ->fill($data)
            ->save();
        return $this->tagRepository
            ->resultRecording($result, 'admin.tags.index', $item->id);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $result = Tag::destroy($id);
        if ($result) {
            return redirect()
                ->route('admin.tags.index')
                ->with(['success' => "запись $id удалена"]);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
