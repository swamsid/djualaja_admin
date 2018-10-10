<table>
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Iklan</th>
      <th>Harga</th>
      <th>Kondisi</th>
      <th>Kota</th>
      <th>Status</th>
    </tr>
  </thead>

  <tbody>

    @foreach($data as $key => $user)
      <tr>
        <td>{{ ($key+1) }}</td>
        <td>{{ $user->product_name }}</td>
        <td>{{ number_format($user->product_price) }}</td>
        <td>{{ $user->product_condition }}</td>
        <td>{{ $user->district->regency->name }}</td>
        <td>{{ $user->product_status }}</td>
      </tr>
    @endforeach
    
  </tbody>
</table>