<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Admin\AdminBaseController;

use App\Models\Admin\Locale;
use MetaTag;
use Modules\Blog\Entities\Comment;
use Modules\Blog\Entities\Post;
use Modules\Blog\Entities\Tag;
use Modules\Blog\Http\Requests\BlogPostCreateRequest;
use Modules\Blog\Http\Requests\BlogPostUpdateRequest;
use Modules\Blog\Repositories\BlogCategoryRepository;
use Modules\Blog\Repositories\BlogPostRepository;
use App\Repositories\Admin\LocalRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Blog\Repositories\TagRepository;
use Storage;


class AdminPostsController extends AdminBaseController
{
    private $blogPostRepository;
    private $localRepository;
    private $blogCategoryRepository, $tagRepository;
    public function __construct()
    {
        parent::__construct();
        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
        $this->localRepository = app(LocalRepository::class);
        $this->tagRepository = app(TagRepository::class);
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        MetaTag::setTags(['title' => __('admin.blog_articles')]);
        $items = $this->blogPostRepository->getAllWithPostPaginate(10);
        return view('blog::admin.posts.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $item = new Post();
        $categoryList = $this->blogCategoryRepository->getForComboBox();
        $tagsList = $this->tagRepository->getForComboBox();
        $locales = $this->blogPostRepository->getActiveLocales();
//        dd($tagsList, $categoryList);
        return view('blog::admin.posts.create', compact('item', 'categoryList', 'locales', 'tagsList'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(BlogPostCreateRequest $request)
    {
        $data = $request->input();
        if (($request['img'])){
            $folder = 'posts/'. date('Y') . '/'. date('m');

            $data['img'] = $request->file('img')->store('images/'. $folder);

        }


        $item = Post::create($data);
        $item->tags()->sync($request->tags);

        return $this->blogPostRepository
            ->resultRecording($item, 'admin.posts.edit', $item->id);
    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {

        $item = $this->blogPostRepository->getEdit($id);

        if (empty($item)){
            abort(404);
        }
        $categoryList = $this->blogCategoryRepository->getForComboBox();
        $tagsList = $this->tagRepository->getForComboBox();
        $locales = $this->blogPostRepository->getActiveLocales();
        $comments = Comment::where('blog_post_id', '=', $item->id)->get(array('name', 'id', 'email','text','status'));

        return view('blog::admin.posts.edit', compact('item', 'categoryList', 'locales', 'tagsList', 'comments'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(BlogPostUpdateRequest $request, $id)
    {
        $item = $this->blogPostRepository->getEdit($id);
        $this->blogPostRepository->issetItem($item);

        $data = $request->all();

        if (($request['img'])){
            Storage::delete($item->img);
            $folder = 'posts/'. date('Y') . '/'. date('m');
            $data['img'] = $request->file('img')->store('images/'. $folder);

        }

        $result = $item->update($data);
        $item->tags()->sync($request->tags);
        return $this->blogPostRepository
            ->resultRecording($result, 'admin.posts.edit', $item->id);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $result = Post::find($id);
        $result->tags()->sync([]);
        Storage::delete($result->img);
        $result->delete();
        if ($result) {
            return redirect()
                ->route('admin.posts.index')
                ->with(['success' => "запись $id удалена"]);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
