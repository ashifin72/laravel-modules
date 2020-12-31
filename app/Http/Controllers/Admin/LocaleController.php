<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Site\Admin\AdminBaseController;
use App\Http\Requests\LocalCreateRequest;
use App\Http\Requests\LocalUpdateRequest;
use App\Models\Admin\Locale;
use App\Repositories\Admin\LocalRepository;
use Illuminate\Http\Request;

class LocaleController extends AdminBaseController
{
    private $localRepository;

    public function __construct()
    {
        parent::__construct();

        $this->localRepository = app(LocalRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['id', 'name', 'local', 'sort', 'status', 'favorite'];
        $items = $this->localRepository->getAllWithPaginate(15, $columns);
        MetaTag::setTags(['title'=>'Локазизации сайта']);
        return view('site.admin.local.index', compact('items'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        $item = Locale::make();
        MetaTag::setTags(['title'=>'Добавить локализацию']);
        $locallist = $this->localRepository->getForComboBox();
        return view('site.admin.local.create', compact('item', 'locallist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocalCreateRequest $request)
    {
        $data = $request->input();// получаем  проверенные данные из формы
        $result = Locale::create($data);

        if ($result) {
            return redirect()->route('site.admin.local.index')
                ->with(['success' => 'Успешное сохраненно!']);
        } else {
            return back()
                // если есть ошибка выдай и отправь назад на исходную точку с сохранением данных в инпуте
                ->withErrors(['msg' => 'Ошибка сохранения!',])
                ->withInput();
        }


    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->localRepository->getEditId($id);
        if (empty($item)) {
            abort(404);
        }

        return view('site.admin.local.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocalUpdateRequest $request, $id)
    {
        $item = $this->localRepository->getEditId($id);
        $this->localRepository->issetItem($item);

        $data = $request->all();

        $result = $item
            ->fill($data)
            ->save();
        return $this->localRepository
            ->resultRecording($result, 'site.admin.local.index', $item->id);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public  function  main_localization(Request $request)
    {
        $idFavorite = $this->localRepository->receiveLocale();
        $data = $request->input();
        $id = $data['id'];
        return $this->localRepository->saveLocale($id, $idFavorite);
    }
    // переключение языка админки
    public function changeLocale($locale)
    {
        session(['Locale'=> $locale]);
        \App::setLocale($locale);

        return redirect()->back();
    }


}
