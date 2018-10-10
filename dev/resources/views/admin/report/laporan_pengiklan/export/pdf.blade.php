<table>
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Pengiklan</th>
      <th>Email Pengiklan</th>
      <th>Provinsi</th>
      <th>Kota</th>
      <th>Total Iklan</th>
      <th>Status</th>
    </tr>
  </thead>

  <tbody>

    @foreach($data as $key => $user)
      <tr>
        <td class="text-center">{{ ($key+1) }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->district->name }}</td>
        <td>{{ $user->district->regency->name }}</td>
        <td>{{ (count($user->iklan) > 0) ? $user->iklan[0]->total_iklan : 0 }}</td>
        <td>
          {{ ($user->confirmed == 1) ? 'verified' : 'unverified' }}
        </td>
      </tr>
    @endforeach
    
  </tbody>
</table>