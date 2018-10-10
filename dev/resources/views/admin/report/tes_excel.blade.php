<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
        @foreach($data as $cek)
            <tr>
                <td>{{ $cek["nama"] }}</td>
                <td>{{ $cek["email"] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>