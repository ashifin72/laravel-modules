<?php

namespace Modules\Section\Http\Controllers;

use App\Http\Controllers\Admin\AdminBaseController;
use Modules\Section\Http\Requests\SectionRequest;
use App\Models\Locale;
use App\Repositories\Admin\LocalRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

use MetaTag;
use Modules\Section\Entities\Section;
use Modules\Section\Repositories\SectionItemRepository;
use Modules\Section\Repositories\SectionRepository;


class AdminSectionController extends AdminBaseController
{
    private $localRepository, $sectionRepository, $sectionItemRepository;

    public function __construct()
    {
        parent::__construct();
        $this->localRepository = app(LocalRepository::class);
        $this->sectionRepository = app(SectionRepository::class);
        $this->sectionItemRepository = app(SectionItemRepository::class);
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        MetaTag::setTags(['title' => __('admin.sections')]);
        $colums = ['id', 'title_ru', 'title_uk', 'title_en', 'sort', 'status'];
        $items = $this->sectionRepository->getAllWithPaginate(20, $colums);

        return view('section::admin.sections.index',
            compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $item = Section::make();
        $locales = $this->localRepository->getActiveLocales();
        return view('section::admin.sections.create', compact('item', 'locales'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(SectionRequest $request)
    {
      $data = $request->input();
      $this->sectionRepository->issetItem($data);

      $item = Section::create($data);
      return $this->sectionRepository
        ->resultRecording($item, 'admin.sections.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
  public function show($id)
  {
    $item = $this->sectionRepository->getEditId($id);
    if (empty($item)) {
      abort(404);
    }
    $section_id = $item->id;
    $sectItems = $this->sectionItemRepository
      ->getAllWithSectionItem($perPage = null, $section_id);
    $locales = $this->localRepository->getActiveLocales();
    return view('section::admin.sections.show',
      compact('item', 'locales', 'sectItems'));
  }


  /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
      $item = $this->sectionRepository->getEditId($id);
      if (empty($item)) {
        abort(404);
      }
      $locales = $this->localRepository->getActiveLocales();
      return view('section::admin.sections.edit',
        compact('item', 'locales'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(SectionRequest $request, $id)
    {
      $item = $this->sectionRepository->getEditId($id);
      $this->sectionRepository->issetItem($id);
      $data = $request->input();
      $result = $item
        ->fill($data)
        ->save();
      return $this->sectionRepository
        ->resultRecording($result, 'admin.sections.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
      $item = $this->sectionRepository->getEditId($id);

      $sectItems = $this->sectionItemRepository
        ->getEditSlug($id, $column = 'section_id');

      if ($sectItems == null) {
        $result = Section::find($id)->forceDelete();

        if ($result) {
          return redirect()
            ->route('site.admin.sections.index')
            ->with(['success' => $item->title . __('admin.delete')]);
        } else {
          return back()->withErrors(['msg' => __('admin.error_del')]);
        }

      } else {
        return redirect()
          ->route('admin.sections.show', $item->id)
          ->withErrors(['msg' => __('admin.error_isset_date')]);
      }
    }
}
