<table>
    <thead>
    <tr>
        <th>Phone Number</th>
    </tr>
    </thead>
    <tbody>
    @foreach($array as $arr)
        <tr>
            <td>{{$arr}}</td>
        </tr>
    @endforeach
    </tbody>
</table>