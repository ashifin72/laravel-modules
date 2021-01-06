<?php

namespace Modules\Blog\Http\Controllers;


use App\Http\Controllers\Admin\AdminBaseController;
use MetaTag;
use Modules\Blog\Entities\Comment;
use Modules\Blog\Http\Requests\CommentGreateRequest;
use Modules\Blog\Http\Requests\CommentUpdateRequest;
use Modules\Blog\Repositories\CommentRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Repositories\BlogPostRepository;

class AdminCommentsController extends AdminBaseController
{
    private $commentRepository, $blogPostRepository;
    public function __construct()
    {
        parent::__construct();
        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->commentRepository= app(CommentRepository::class);

    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        MetaTag::setTags(['title'=>__('admin.title_comments')]);

        $items = $this->commentRepository->getAllWithCommentsPaginate();
        return view('blog::admin.comments.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $parent_id = $_GET['parent_id'];
        $parent_comment = $this->commentRepository->getEditId($parent_id);
        $this->commentRepository->issetItem($parent_comment);
        // активиреум комментарий на который отвечаем
        $parent_comment->status = '1';
        $parent_comment->save();
        $item = Comment::make();
        return view('blog::admin.comments.create', compact('item','parent_comment'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CommentGreateRequest $request)
    {
        $data = $request->input();
        $item = Comment::create($data);
        return $this->commentRepository
            ->resultRecording($item, 'admin.comments.edit', $item->id);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('blog::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $item = $this->commentRepository->getEditId($id);
        if (empty($item)) {
            abort(404);
        }
        return view('blog::admin.comments.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(CommentUpdateRequest $request, $id)
    {
        $item = $this->commentRepository->getEditId($id);
        $this->commentRepository->issetItem($item);
        $data = $request->all();

        $result = $item
            ->fill($data)
            ->save();
        return $this->commentRepository
            ->resultRecording($result, 'admin.comments.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $result = Comment::destroy($id);
        if ($result) {
            return redirect()
                ->route('admin.comments.index')
                ->with(['success' => __('admin.title_comments') . $id . __('admin.delete')]);
        } else {
            return back()->withErrors(['msg' => __('admin.error_delete')]);
        }
    }
}
