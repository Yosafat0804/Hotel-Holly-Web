@extends('layouts.adminlte')
@section('content')
<div class="card shadow-lg" style="border-radius:24px; border:2px solid #d4af37; background:#fff;">
    <div class="card-header" style="background:#00008b; color:#fff; font-weight:bold; border-radius:22px 22px 0 0; letter-spacing:1px;">
      <h3 class="card-title" style="font-size:1.3rem; letter-spacing:1px;">
        <i class="fas fa-hotel" style="color:#d4af37; margin-right:8px;"></i>
        MAINTENANCE & RECEPTIONIST ADD
      </h3>
      <div class="card-tools"></div>
    </div>
    <div class="card-body" style="padding:2rem;">
        <form action="{{ route('supervisor.maintenanceReceptionist.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="username" style="color:#00008b; font-weight:600;">Name</label>
                <input id="username" name="username" type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required autocomplete="username" autofocus style="border-radius:16px; border:1.5px solid #d4af37;">
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email" style="color:#00008b; font-weight:600;">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" required autocomplete="email" autofocus style="border-radius:16px; border:1.5px solid #d4af37;" value="{{ old('email') }}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="role" style="color:#00008b; font-weight:600;">Role</label>
                <select name="role" class="form-control @error('role') is-invalid @enderror" id="role" required autocomplete="role" autofocus style="border-radius:16px; border:1.5px solid #d4af37;">
                    <option value="">Select role</option>
                    <option value="maintenance" {{ old('role') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    <option value="resepsionis" {{ old('role') == 'resepsionis' ? 'selected' : '' }}>Receptionist</option>
                </select>
                @error('role')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone" style="color:#00008b; font-weight:600;">Phone</label>
                <input id="phone" name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required autocomplete="phone" autofocus style="border-radius:16px; border:1.5px solid #d4af37;">
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password" style="color:#00008b; font-weight:600;">Password</label>
                <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" required autocomplete="password" autofocus style="border-radius:16px; border:1.5px solid #d4af37;">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group float-right row mb-0">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary" style="background:#d4af37; color:#000; font-weight:bold; border-radius:16px; padding:8px 28px; border:none;">
                        {{ __('Post') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection