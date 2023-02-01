@extends('templete.master')
<!---section for dainamic title----->
@section('dinamic-title','অ্যাডমিন')
@section('main-content')
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
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

                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">

                                    <div class="form-group">
                                        <label for="exampleInputName">নাম</label>
                                        <input name="name"  type="text" value="{{$customer->customer_name}}"
                                            class=" text-bold form-control @error('name') is-invalid @enderror" id="exampleInputName"
                                            placeholder="Enter Name Bangla" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName">পরিচ</label>
                                        <input name="poricoy"  type="text" value="{{$customer->customer_relations}}"
                                            class=" text-bold form-control @error('poricoy') is-invalid @enderror" id="exampleInputName"
                                            placeholder="Enter Name Bangla" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName">গ্রাম</label>
                                        <input name="gram"  type="text" value="{{$customer->village->village_name}}"
                                            class=" text-bold form-control @error('gram') is-invalid @enderror" id="exampleInputName"
                                            placeholder="Enter Name Bangla" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName">পাড়া/মহল্লা</label>
                                        <input name="para"  type="text" value="{{$customer->laid->laid_name}}"
                                            class=" text-bold form-control @error('para') is-invalid @enderror" id="exampleInputName"
                                            placeholder="Enter Name Bangla" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName">মোট বাকি</label>
                                        <input name="baki"  type="text" value="{{$customer->privious_total_due}}"
                                            class=" text-bold form-control @error('baki') is-invalid @enderror" id="exampleInputName"
                                            placeholder="Enter Name Bangla" disabled>
                                    </div>
                                  <form action="{{route('customer.HalkhataUpdate')}}" method="POST">
                                    @csrf
                                        <div class="form-group">
                                            <input type="hidden" name="id" value="{{$customer->id}}">
                                            <label for="exampleInputName">হালখাতা</label>
                                            <input name="payment"  type="number" value="{{$customer->payment}}"
                                                class=" text-bold form-control @error('payment') is-invalid @enderror" id="exampleInputName"
                                                placeholder="Enter Name Bangla" >
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">আপডেট করুন</button>
                                        </div>
                                  </form>


                            </div>
                            <div class="form-group">
                                <a href="{{route('customer.HalkhataCancle',$customer->id)}}" id="delete" class="btn btn-danger">হালখাতা বাতিল করুন</a>
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

