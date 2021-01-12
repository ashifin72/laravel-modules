<?php

namespace Modules\Menu\Http\Controllers;

use App\Http\Controllers\Admin\AdminBaseController;

use App\Repositories\Admin\LocalRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Http\Requests\MenuRequest;
use Modules\Menu\Http\Requests\UpdateMenuRequest;
use Modules\Menu\Repositories\MenuItemRepository;
use Modules\Menu\Repositories\MenuRepository;

class AdminMenuController extends AdminBaseController
{
    private $menuRepository;
    private $localRepository;
    private $menuItemRepository;

    public function __construct()
    {
        parent::__construct();

        $this->menuRepository = app(MenuRepository::class);
        $this->localRepository = app(LocalRepository::class);
        $this->menuItemRepository = app(MenuItemRepository::class);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->menuRepository->getAllWithMenuPaginate();
        return view('menus::admin.menus.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = Menu::make();

        return view('menus::admin.menus.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $data = $request->input();// получаем  проверенные данные из формы

        $item = Menu::create($data);

        return $this->menuRepository
            ->resultRecording($item, 'admin.menus.index');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->menuRepository->getEditId($id);

        if (empty($item)) {
            abort(404);
        }
        $menuItems = $this->menuItemRepository->getAllWithMenuItem($perPage = null, $id);


        return view('menus::admin.menus.edit',
            compact('item', 'menuItems'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenuRequest $request, $id)
    {

        $item = $this->menuRepository->getEditId($id);

        $this->menuRepository->issetItem($item);

        $data = $request->all();
        $result = $item
            ->fill($data)
            ->save();
        return $this->menuRepository
            ->resultRecording($result, 'admin.menus.edit', $item->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menuItems = $this->menuItemRepository->getAllWithMenuItem($perPage = null, $id);

        if ($menuItems->isEmpty()){
            $result = Menu::destroy($id);
            if ($result) {
                return redirect()
                    ->route('admin.menus.index')
                    ->with(['success' => __('admin.article'). ' id ' . $id . __('admin.delete')]);
            } else {
                return back()->withErrors(['msg' => __('admin.error_delete')]);
            }
        }else{
            return back()->withErrors(['msg' => __('menus.eroror-delit_menu')]);
        }
    }}
