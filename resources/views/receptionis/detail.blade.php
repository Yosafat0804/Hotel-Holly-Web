@extends('layouts.adminlte')

@section('content')
<div class="container mt-5">
	<div class="card shadow-lg" style="border-radius:24px; border:2px solid #d4af37; background:#fff;">
		<div class="card-header"
			style="background:#00008b; color:#fff; font-weight:bold; border-radius:22px 22px 0 0; letter-spacing:1px;">
			<h3 class="card-title" style="font-size:1.3rem; letter-spacing:1px;">
				<i class="fas fa-user" style="color:#d4af37; margin-right:8px;"></i>
				Profil
			</h3>
		</div>
		<div class="card-body" style="padding:2rem;">
			<table class="table table-bordered" style="background:#fffbe6; border-radius:18px;">
				<tr>
					<th>Name</th>
					<td>{{ $user->name }}</td>
				</tr>
				<tr>
					<th>Email</th>
					<td>{{ $user->email }}</td>
				</tr>
				<tr>
					<th>Phone</th>
					<td>{{ $user->phone }}</td>
				</tr>
				<tr>
					<th>Role</th>
					<td>{{ ucfirst($user->role) }}</td>
				</tr>
				<tr>
					<th>Rating</th>
					<td>
						@if($user->rating == 'Baik')
							<span class="badge badge-success">Baik</span>
						@elseif($user->rating == 'Kurang Baik')
							<span class="badge badge-warning">Kurang Baik</span>
						@elseif($user->rating == 'Buruk')
							<span class="badge badge-danger">Buruk</span>
						@else
							<span class="badge badge-secondary">Belum Dinilai</span>
						@endif
					</td>
				</tr>
					<tr>
						<th>Note from Supervisor</th>
						<td>{{ $user->note }}</td>
					</tr>
			</table>
		</div>
	</div>
</div>
@endsection