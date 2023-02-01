@extends('templete.master')
<!---section for dainamic title----->
@section('dinamic-title','অ্যাডমিন')
@section('main-content')
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">কাস্টমারের পাড়া/মহল্লা সংযুক্ত করন</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">হোম</a></li>
                <li class="breadcrumb-item active"> পাড়া/মহল্লা সংযুক্ত করন</li>
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
                        <h3 class="card-title">মোট <b>{{count($laids)}}</b>&nbsp;টি পাড়া/মহল্লা</h3>
                        <a class="btn btn-sm btn-primary" href="#" style="float: right;" data-toggle="modal"
                            data-target="#Addlaid"><i class="fas fa-plus"></i>
                            নতুন পাড়া/মহল্লা  সংযুক্ত করুন</a>
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
                                                    style="width: 278.547px;">গ্রাম</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending"
                                                    style="width: 100.547px;">অ্যাকশান</th>
                                            </tr>
                                        </thead>
                                        <tbody>          @if(count($laids)==0)
                                                            <h1>Data Not Added</h1>
                                                         @else
                                                            @php $sl=1 @endphp
                                                            @foreach($laids as $laids)

                                                                    <tr role="row" class="odd">
                                                                        <td class="sorting_1">{{$sl++}}</td>
                                                                        <td class="sorting_1">{{$laids->laid_name}}</td>
                                                                        <td class="sorting_1">{{$laids->village->village_name}}</td>
                                                                        <td class="sorting_1">
                                                                            <a href=""  class="btn btn-sm btn-warning" data-toggle="modal"
                                                                            data-target="#EditLaid{{$laids->id}}"><i class="text-light fas fa-user-edit"></i></a>&nbsp;

                                                                            <a id="delete" href="{{route('customer.village.laiddelete',$laids->id)}}" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>

                                                                        </td>
       <!-- edit Modal Start  -->
       <div class="modal fade" id="EditLaid{{$laids->id}}" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><b>নতুন পাড়া/মহল্লা সংযুক্ত করন</b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('customer.village.laidupdate')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" value="{{$laids->id}}">
                            <label for="exampleSelectBorder">গ্রামের নাম</label>
                            <select class="custom-select form-control-border @error('village_id') is-invalid @enderror" id="exampleSelectBorder" name="village_id" >
                                @foreach ($village as $vill )
                                    <option value="{{$vill->id}}" @if($vill->id==$laids->village_id) selected @endif >{{$vill->village_name}}</option>
                                @endforeach

                            </select>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                          </div>
                        <div class="form-group">
                            <label for="exampleInputName">পাড়া/মহল্লার নাম</label>
                            <input name="name"  type="text" value="{{$laids->laid_name}}"
                                class="form-control @error('name') is-invalid @enderror" id="exampleInputName"
                                placeholder="Enter Village Name">
                            @error('name')
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
    <!-- edit Modal End  -->

                                                                    </tr>

                                                            @endforeach
                                                        @endif
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
        <div class="modal fade" id="Addlaid" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><b>নতুন পাড়া/মহল্লা সংযুক্ত করন</b></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('customer.village.laidstore')}}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleSelectBorder">গ্রামের নাম</label>
                                <select class="custom-select form-control-border @error('village_id') is-invalid @enderror" id="exampleSelectBorder" name="village_id" >
                                  @foreach($village as $village)
                                    <option value="{{$village->id}}">{{$village->village_name}}</option>
                                   @endforeach
                                </select>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                              </div>
                            <div class="form-group">
                                <label for="exampleInputName">পাড়া/মহল্লার নাম</label>
                                <input name="name"  type="text"
                                    class="form-control @error('name') is-invalid @enderror" id="exampleInputName"
                                    placeholder="Enter Village Name">
                                @error('name')
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

