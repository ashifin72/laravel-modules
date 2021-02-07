<?php

namespace Modules\Section\Http\Controllers;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Requests\SectionItemGreateRequest;
use App\Models\Locale;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

use Modules\Section\Entities\SectionItem;
use Modules\Section\Http\Requests\SectionItemRequest;
use Modules\Section\Repositories\SectionItemRepository;
use Modules\Section\Repositories\SectionRepository;

class AdminSectionItemController extends AdminBaseController
{
  private $sectionRepository, $sectionItemRepository;

  public function __construct()
  {
    parent::__construct();
    $this->sectionItemRepository = app(SectionItemRepository::class);
    $this->sectionRepository = app(SectionRepository::class);
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $section_id = $_GET['section_id'];
    $section = $this->sectionRepository->getEditId($section_id);
    if (empty($section)) {
      abort(404);
    }
    $item = SectionItem::make();
    $locales = $this->sectionRepository->getActiveLocales();
    return view('section::admin.sections.create_item',
      compact('section', 'item', 'locales'));
  }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
  public function store(SectionItemRequest $request)
  {
    $data = $request->input();
    $this->sectionRepository->issetItem($data);

    $item = SectionItem::create($data);
    return $this->sectionItemRepository
      ->resultRecording($item, 'admin.sections.show', $item->section_id);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $item = $this->sectionItemRepository->getEditId($id);
    if (empty($item)) {
      abort(404);
    }


    $locales = Locale::where('status', '=', '1')->orderBy('sort', 'desc')->get(array('local'));

    return view('section::admin.sections.edit_item',
      compact('item', 'locales'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(SectionItemRequest $request, $id)
  {
    $item = $this->sectionItemRepository->getEditId($id);
    $this->sectionItemRepository->issetItem($id);
    $data = $request->input();
    $result = $item
      ->fill($data)
      ->save();
    return $this->sectionItemRepository
      ->resultRecording($result, 'admin.sections.show', $item->section_id);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $item = $this->sectionItemRepository->getEdit($id);

    $result = SectionItem::find($id)->forceDelete();

    if ($result) {
      return redirect()
        ->route('admin.sections.show', $item->section_id)
        ->with(['success' => $item->title . ' ' . __('admin.delete')]);
    } else {
      return back()->withErrors(['msg' => __('admin.error_del')]);
    }
  }
}
