<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InfoUpdateRequest;

use App\Models\Locale;
use App\Repositories\Admin\InfoRepository;
use App\Repositories\Admin\LocalRepository;
use Illuminate\Http\Request;
use MetaTag;

class InfoController extends AdminBaseController
{

    private $infoRepository, $localRepository;

    public function __construct()
    {
        parent::__construct();
        $this->infoRepository = app(InfoRepository::class);
        $this->localRepository = app(LocalRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['id', 'title', 'img', 'local_id'];
        MetaTag::setTags(['title' => __('admin.info_project')]);
        $items = $this->infoRepository->getAllWithInfo(20, $columns);
        return view('admin.info.index', compact('items'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->infoRepository->getEdit($id);
        if (empty($item)) {
            abort(404);
        }
        $locales = Locale::where('status', '=', '1')->orderBy('favorite', 'desc')->get(array('local'));
        MetaTag::setTags(['title' => __('admin.info_project')]);
        return view('admin.info.edit', compact('item', 'locales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InfoUpdateRequest $request, $id)
    {
        $item = $this->infoRepository->getEdit($id);
        $this->infoRepository->issetItem($item);

        $data = $request->input();

        $result = $item
            ->fill($data)
            ->save();
        // выводим информацию о записи и перенаправляем на нужный роут
        return $this->infoRepository
            ->resultRecording($result, $view ='admin.info.edit', $item->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
