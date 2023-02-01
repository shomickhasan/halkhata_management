@extends('templete.master')
<!---section for dainamic title----->
@section('dinamic-title','হালখাতা')
@section('main-content')
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">হালখাতা এন্ট্রি করুন</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">হোম</a></li>
                <li class="breadcrumb-item active"> হালখাতা এন্ট্রি করুন</li>
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
                        <h3 class="card-title">মোট <b>{{count($customer)}}</b>&nbsp;টি কাস্টমার</h3>
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
                                                    style="width: 200.547px;">name</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending"
                                                    style="width: 298.547px;">নাম</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending"
                                                    style="width: 298.547px;">পরিচয়</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending"
                                                    style="width: 250.547px;">গ্রাম</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending"
                                                    style="width: 278.547px;">পাড়া/মহল্লা</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending"
                                                    style="width: 200.547px;">মোট বাকি</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending"
                                                    style="width: 100.547px;">অ্যাকশান</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                            @if($customer)
                                                             @php $sl=1 @endphp
                                                                @foreach($customer as $customer)
                                                                    <tr role="row" class="odd">
                                                                        <td class="sorting_1">{{$sl++}}</td>
                                                                        <td class="sorting_1">{{$customer->customer_english_name}}</td>
                                                                        <td class="sorting_1">{{$customer->customer_name}}</td>
                                                                        <td class="sorting_1">{{$customer->customer_relations}}</td>
                                                                        <td class="sorting_1">{{$customer->village->village_name}}</td>
                                                                        <td class="sorting_1">{{$customer->laid->laid_name}}</td>
                                                                        <td class="sorting_1">{{$customer->privious_total_due}}</td>
                                                                        <td class="sorting_1">
                                                                            @if($customer->status==1)
                                                                               <span><b>{{$customer->payment}}</b></span><span><i class="text-success fas fa-check"></i></span>
                                                                               <span><a href="{{route('customer.HalkhataEdit',$customer->id)}}">Edit</a></span>
                                                                            @else
                                                                                <a href=""  class="btn btn-sm btn-warning" data-toggle="modal"
                                                                                data-target="#EditCustomer{{$customer->id}}"><i class="text-light fas fa-user-edit"></i></a>
                                                                            @endif
                                                                        </td>
<!-- edit Modal Start  -->
      <div class="modal fade" id="EditCustomer{{$customer->id}}" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><b>{{$customer->customer_name}}</b></h4>
                        @if($customer->customer_relations)<span>( <span>{{$customer->customer_relations}}</span>)</span>@endif
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <h6><b>গ্রাম: &nbsp;</b>{{$customer->village->village_name}}</h6>
                            </div>
                            <div class="col-md-6">
                                <h6><b>পাড়া/মহল্লা: &nbsp;</b>{{$customer->laid->laid_name}}</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputName">মোট বাকি</label>
                                    <input name="payment"  type="text" value="{{$customer->privious_total_due}}"
                                        class=" text-bold form-control @error('payment') is-invalid @enderror" id="exampleInputName"
                                        placeholder="Enter Name Bangla" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <form action="{{route('customer.HalkhataStore')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="{{$customer->id}}">
                                        <label for="exampleInputName">হালখাতা</label>
                                        <input name="payment"  type="number"
                                            class=" text-bold form-control @error('payment') is-invalid @enderror" id="exampleInputName"
                                            placeholder="Enter amount">
                                        @error('payment')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn  btn-primary">Save</button>
                                </form>
                            </div>
                        </div>

                    </div>


                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- Create Modal End  -->
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



@endsection

