@include('backend.dashboard.component.breadcrumb',['title'=>$seo['meta_title']['delete']['title']])

<form action="{{ route('user.destroy', ['id' => $user->id]) }}" method="post" class="box">
    @csrf
   
    <div class="wrapper wrapper-content aminated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">
                       
                        <p> <strong>Bạn có chắc muốn xóa thành viên :</strong> {{$user->email}}</p>
                        <label for="" class="control-lable text-right">Lưu ý
                            <span class="text-danger">Không thể khôi phục khi xóa</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Thông tin chung</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-lable text-right">Email
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input type="text" name="email" value="{{old('email',($user->email) ?? '')}}" class="form-control" placeholder="" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-lable text-right">Họ tên
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input type="text" name="name" value="{{old('name',($user->name) ?? '')}}" class="form-control" placeholder="" autocomplete="off" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right">
            <button class="btn btn-danger" type="submit" name="send" value="">Xóa dữ liệu</button>
        </div>
    </div>

</form>




