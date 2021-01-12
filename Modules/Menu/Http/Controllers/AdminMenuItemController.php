<?php

namespace Modules\Menu\Http\Controllers;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\locale;
use App\Repositories\Admin\LocalRepository;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Menu\Entities\MenuItem;
use Modules\Menu\Http\Requests\MenuItemRequest;
use Modules\Menu\Repositories\MenuItemRepository;
use Modules\Menu\Repositories\MenuRepository;


class AdminMenuItemController extends AdminBaseController
{
    private $menuRepository;
    private $localRepository;
    private $menuItemRepository;
    public function __construct()
    {
        parent::__construct();

        $this->menuRepository = app(MenuRepository::class);
        $this->localRepository = app(LocalRepository::class);
        $this->menuItemRepository= app(MenuItemRepository::class);

    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        $menu_id = $_GET['menu_id'];
        $menu = $this->menuRepository->getEdit($menu_id);
        if (empty($menu)){
            abort(404);
        }

        $item = MenuItem::make();

        $locales = Locale::where('status', '=', '1')->orderBy('sort', 'desc')->get(array('local'));
        $parentList = $this->menuItemRepository->getForComboBox($menu_id);

        return view('menus::admin.menus.create_item', compact('item', 'menu', 'locales', 'parentList'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(MenuItemRequest $request)
    {
        $data = $request->input();
        $item = MenuItem::create($data);
        // выводим информацию о записи и перенаправляем на нужный роут
        return $this->menuItemRepository
            ->resultRecording($item, 'admin.menus.edit', $item->menu_id);
    }




    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $item = $this->menuItemRepository->getEdit($id);
        $locales = Locale::where('status', '=', '1')->orderBy('sort', 'desc')->get(array('local'));

        $parentList = $this->menuItemRepository->getForComboBox($item->menu_id);
        return view('menus::admin.menu.edit_item', compact('item',  'locales', 'parentList'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(MenuItemRequest $request, $id)
    {
        $item = $this->menuItemRepository->getEdit($id);
        $this->menuItemRepository->issetItem($item);
        $data = $request->all();
        $result = $item
            ->fill($data)
            ->save();
        return $this->menuItemRepository
            ->resultRecording($result, 'admin.menus.edit', $item->menu_id );
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $item = $this->menuItemRepository->getEdit($id);

        $result = MenuItem::find($id)->forceDelete();
        if ($result) {
            return redirect()
                ->route('admin.menus.edit', $item->menu_id )
                ->with(['success' => "запись $item->title удалена"]);
        } else {
            return back()->withErrors(['msg' => __('admin.error_del')]);
        }
    }
}
