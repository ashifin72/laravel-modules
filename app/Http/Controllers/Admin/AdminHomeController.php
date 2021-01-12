<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Repositories\Admin\InfoRepository;
use App\Repositories\Admin\LocalRepository;
use App\Repositories\Admin\UserRepository;
use Illuminate\Http\Request;
use MetaTag;
use Modules\Blog\Repositories\BlogPostRepository;
use Modules\Portfolio\Repositories\PortfolioRepository;
use Modules\Section\Repositories\SectionRepository;

class AdminHomeController extends AdminBaseController
{
    private $userRepository;
  private $infoRepository;
  private $localRepository;
    private $postRepository;
    private $sectionRepository;
    private $portfolioRepository;
    public function __construct()
    {
        parent::__construct();
        $this->userRepository = app(UserRepository::class);
      $this->localRepository = app(LocalRepository::class);
      $this->infoRepository = app(InfoRepository::class);
      $this->postRepository = app(BlogPostRepository::class);
      $this->sectionRepository = app(SectionRepository::class);
      $this->portfolioRepository = app(PortfolioRepository::class);
    }

    public function index(){
        $user = User::find(1);
//        dd($user->hasRole('web-developer')); //вернёт true
//        dd($user->hasRole('project-manager')); //вернёт false
//        dd($user->givePermissionsTo('manage-users')); //выдаём разрешение
//        dd($user->hasPermission('manage-users')); //вернёт true
      $countPost = $this->postRepository->getCount();
      $countUsers = $this->userRepository->getCount();
      $countLocal = $this->localRepository->getCount();
      $countPortfolio = $this->portfolioRepository->getCount();
      $countSection = $this->sectionRepository->getCount();
      $item = $this->infoRepository->getEdit(1);
      MetaTag::setTags(['title' => 'Админ панель']);
        return view('admin.main.index',
          compact('countUsers', 'countPost', 'countLocal', 'countPortfolio','countSection', 'item'));
    }
}
