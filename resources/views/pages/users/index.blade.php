@extends('templete.master')
<!---section for dainamic title----->
@section('dinamic-title','অ্যাডমিন')
@section('main-content')
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">এডমিন এড</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Blank</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
  <!-- /.content-header -->
     <!-- Main content -->
     <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row d-flex justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Total <b>{{count($userAdmins)}}</b> User</h3>
                        <a class="btn btn-sm btn-primary" href="#" style="float: right;" data-toggle="modal"
                            data-target="#AddUser"><i class="fas fa-plus"></i>
                            নতুন অ্যাডমিন যোগ করুন</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="datatableid" class="table table-bordered table-striped dataTable"
                                        role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row" class="bg-gray">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending"
                                                    style="width: 50.078px;">#</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending"
                                                    style="width: 278.547px;">নাম</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending"
                                                    style="width: 278.547px;">ইমেইল</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending"
                                                    style="width: 100.547px;">অ্যাকশান</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach ($userAdmins as $userAdmin )
                                                    @if($userAdmin->role==2)
                                                        <tr role="row" class="odd">
                                                            <td class="sorting_1">1</td>
                                                            <td class="sorting_1">{{$userAdmin->name}}</td>
                                                            <td class="sorting_1">{{$userAdmin->email}}</td>
                                                            <td class="sorting_1">
                                                                <a href=""  class="btn btn-sm btn-warning" data-toggle="modal"
                                                                data-target="#editUser{{$userAdmin->id}}"><i class="text-light fas fa-user-edit"></i></a>&nbsp;

                                                                <a id="delete" href="{{route('admin.delete',$userAdmin->id)}}" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>

<!-- edit Modal Start  -->
    <div class="modal fade" id="editUser{{$userAdmin->id}}" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><b>এডিট  অ্যাডমিন
                        </b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{Route('admin.update',$userAdmin->id)}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" value="{{$userAdmin->id}}" name="id">
                        <div class="form-group">
                            <label for="exampleInputName">নাম</label>
                            <input name="name"  type="text" value="{{$userAdmin->name}}"
                                class="form-control @error('name') is-invalid @enderror" id="exampleInputName"
                                placeholder="Enter User Name">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail">ইমেইল</label>
                            <input name="email"  type="email" value="{{$userAdmin->email}}"
                                class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail"
                                placeholder="Enter User Email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword">পাসওয়ার্ড</label>
                            <br><span class="text-warning">(if need update admin password plese remove this value and and input Update password)</span>
                            <input name="password" type="password" value="{{$userAdmin->password}}"
                                class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword"
                                placeholder="Enter User Password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">বন্ধ করুন</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> আপডেট</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- edit Modal End  -->
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- Create Modal Start  -->
    <div class="modal fade" id="AddUser" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><b>Create User</b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{Route('admin.user.store')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputName">নাম</label>
                            <input name="name"  type="text"
                                class="form-control @error('name') is-invalid @enderror" id="exampleInputName"
                                placeholder="Enter User Name">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail">ইমেইল</label>
                            <input name="email"  type="email"
                                class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail"
                                placeholder="Enter User Email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword">পাসওয়ার্ড</label>
                            <input name="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword"
                                placeholder="Enter User Password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">বন্ধ করুন</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> সেভ
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- Create Modal End  -->

@endsection

