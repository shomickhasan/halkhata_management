 {{-- @foreach ($data as $customer)
<p>{{$customer->customer_name}}</p>

@endforeach --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pdf report</title>
    <style>
        table{
            width: 90%;
            margin: 0 auto;
            text-align: center;
        }
         td {
            border: 1px solid black;
            padding: 5px;

        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>নং</th>
                <th>নাম</th>
                <th>সম্পর্ক</th>
                <th>গ্রাম</th>
                <th>পাড়া/মহল্লা</th>
                <th>মোট বাকি</th>
                <th>হালখাতা</th>
                <th>জের</th>
            </tr>
        </thead>
        <tbody>
            @php $sl=1 @endphp
            @foreach ($data as $customer )
                <tr>
                    <td >
                        @if($customer->status ==0)
                            <mark>{{$sl++}}</mark>
                        @else
                            {{$sl++}}
                        @endif

                    </td>
                    <td>{{$customer->customer_name}}</td>
                    <td>{{$customer->customer_relations}}</td>
                    <td>{{$customer->village->village_name}}</td>
                    <td>{{$customer->laid->laid_name}}</td>
                    <td>{{$customer->privious_total_due}}</td>
                    <td>{{$customer->payment}}</td>
                    <td>{{$customer->current_due}}</td>

            @endforeach
                </tr>
        </tbody>
    </table>

</body>
</html>
