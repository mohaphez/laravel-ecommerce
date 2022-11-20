<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Menu;
use App\MenuHeader;
use App\SubMenu;
use Illuminate\Http\Request;

class MenuController extends Controller {
	public $successStatus = 200;
	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index(Request $request) {
		$menus      = Menu::with('menuheader.submenu')->get();
		$categories = Category::all();
		return $request->ajax()?view('Admin.ajax.menu-index', compact('menus', 'categories')):view('Admin.menu.menu-index', compact('menus', 'categories'));
	}
	/**
	 * [store description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function store(Request $request) {
		$this->validate($request, ['menu' => 'required|string']);
		Menu::create(['name'              => $request['menu']]);
		return redirect()->back();
	}
	/**
	 * [SubMenuStore description]
	 * @param Request $request [description]
	 */
	public function SubMenuStore(Request $request) {
		$this->validate($request, ['menuheader' => 'required|string',
				'menuheader-link'                     => 'required|string'
			]);
		if (!$request->has('menuheader_id')) {
			$menuheader          = new menuHeader();
			$menuheader->name    = $request['menuheader'];
			$menuheader->menu_id = $request['id'];
			$menuheader->link    = $request['menuheader-link'];
			$menuheader->save();
			if ($request['submenu'] != null) {
				$i = 0;
				foreach (array_combine($request['submenu'], $request['submenu-link']) as $key => $value) {
					if ($value[$i] != null) {
						$submenu                 = new Submenu();
						$submenu->name           = $key;
						$submenu->link           = $value;
						$submenu->menu_header_id = $menuheader->id;
						$submenu->save();
					}
					$i++;
				}
			}
		} else {
			$menuheader          = menuHeader::findOrFail($request['menuheader_id']);
			$menuheader->name    = $request['menuheader'];
			$menuheader->menu_id = $request['id'];
			$menuheader->link    = $request['menuheader-link'];
			$menuheader->save();
			Submenu::where('menu_header_id', $request['menuheader_id'])->delete();
			if ($request['submenu'] != null) {
				$i = 0;
				foreach (array_combine($request['submenu'], $request['submenu-link']) as $key => $value) {
					if ($value[$i] != null) {
						$submenu                 = new Submenu();
						$submenu->name           = $key;
						$submenu->link           = $value;
						$submenu->menu_header_id = $menuheader->id;
						$submenu->save();
					}
					$i++;
				}
			}
		}
		return response()->json(['success', $this->successStatus]);
	}
	/**
	 * [destroyMenuHeader description]
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function destroyMenuHeader(Request $request, $id) {
		if ($request                 ->ajax()) {
			MenuHeader::where('id', $id)->delete();
			return response()->json(['success', $this->successStatus]);
		}
	}
	/**
	 * [editMenu description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function editMenu($id) {
		$menu = Menu::where('id', $id)->first();
		return view('Admin.menu.edit-menu', compact('menu'));
	}
	/**
	 * [editMenu description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function updateMenu(Request $request, $id) {
		$this->validate($request, ['menu' => 'required|string']);
		$menu       = Menu::where('id', $id)->first();
		$menu->name = $request['menu'];
		$menu->save();
		return response()->json(['success', $this->successStatus]);
	}
	/**
	 * [destroyMenu description]
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function destroyMenu(Request $request, $id) {
		if ($request           ->ajax()) {
			Menu::where('id', $id)->delete();
			return response()->json(['success', $this->successStatus]);
		}
	}
	/**
	 * [choosePage description]
	 * @return [type] [description]
	 */
	public function choosePage() {
		$categories = Category::all();
		return view('Admin.menu.choose-page', compact('categories'));
	}
}
