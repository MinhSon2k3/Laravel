<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserCatalougeRequest;
use App\Http\Requests\UpdateUserRequest;
use  App\Services\Interfaces\UserCatalougeServiceInterface as UserCatalougeService;//thao tác create/update/delete/paginate
use  App\Repositories\Interfaces\UserCatalougeRepositoryInterface as UserCatalougeRepository;//dùng cho tra cứu theo id



class UserCatalougeController extends Controller
{
  protected $userCatalougeService;
  protected $userCatalougeRepository;
  public function __construct(
    UserCatalougeService $userCatalougeService,
    UserCatalougeRepository $userCatalougeRepository,
  ) {

    $this->userCatalougeService = $userCatalougeService;
    $this->userCatalougeRepository = $userCatalougeRepository;
  }

  public function index(Request $request)
  {
    //controller->service->repository thực hiện nghiệp vụ
    $userCatalouges = $this->userCatalougeService->paginate($request);
    $seo = [
      //Hàm config lấy giá trị từ file cấu hình của ứng dụng.
      'meta_title' => config('apps.usercatalouge')
    ];
    // Định nghĩa đường dẫn tới template
    $template = 'backend.user.catalouge.index';
    // Trả về view với layout 'backend.dashboard.layout' và truyền biến 'template' và 'users' tới view
    return view('backend.dashboard.layout', compact('template', 'userCatalouges', 'seo'));
  }

  //khi ấn vào dòng thêm người dùng
  public function create()
  { 
  
   
    $template = 'backend.user.catalouge.create';
    $seo = [
      'meta_title' => config('apps.usercatalouge')
    ];
    return view('backend.dashboard.layout', compact('template', 'seo'));
  }
  //Khi nhấn vào submit create
  public  function store(StoreUserCatalougeRequest $request ){ //StoreUserRequest validate các thông tin cần create
    if($this->userCatalougeService->create($request)){
      return redirect()->route('user.catalouge.index')->with('success', 'Thêm mới thành công');
    }
    return redirect()->route('user.catalouge.index')->with('error', 'Thêm mới ko thành công');
  }
  
  //edit
  public function edit($id){
    $userCatalouges = $this->userCatalougeRepository->findById($id); 
    $template = 'backend.user.catalouge.edit';
    $seo = [
        'meta_title' => config('apps.usercatalouge')
    ];
    return view('backend.dashboard.layout', compact('template', 'seo', 'userCatalouges'));
}
  public function update($id, Request $request){
    if($this->userCatalougeService->update($id,$request)){
      return redirect()->route('user.catalouge.index')->with('success', 'Chỉnh sửa thông tin thành công');
    }
    return redirect()->route('user.catalouge.index')->with('error', 'Chỉnh sửa thông tin ko thành công');
  }


  public function delete($id){
    $userCatalouges = $this->userCatalougeRepository->findById($id);  
    $template = 'backend.user.catalouge.delete';
    $seo = [
        'meta_title' => config('apps.usercatalouge')
    ];
    return view('backend.dashboard.layout', compact('template', 'seo','userCatalouges'));
}

public function destroy($id){
  if($this->userCatalougeService->destroy($id)){
    return redirect()->route('user.catalouge.index')->with('success', 'Xóa thông tin thành công');
  }
  return redirect()->route('user.catalouge.index')->with('error', 'Xóa thông tin ko thành công');
}


}



