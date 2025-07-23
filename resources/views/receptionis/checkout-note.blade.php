@extends('layouts.app')
@section('content')
<div class="card shadow-lg" style="border-radius:24px; border:2px solid #d4af37; background:#fff;">
    <div class="card-header" style="background:#00008b; color:#fff; font-weight:bold; border-radius:22px 22px 0 0; letter-spacing:1px;">
      <h3 class="card-title" style="font-size:1.3rem; letter-spacing:1px;">
        <i class="fas fa-couch" style="color:#d4af37; margin-right:8px;"></i>
        Tamahkan Catatan
      </h3>
      <div class="card-tools"></div>
    </div>
    <div class="card-body" style="padding:2rem;">
        <form action="{{ route('receptionis.storeCheckoutNote', $transaction->id) }}" method="post">
            @csrf
            <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
            <div class="form-group">
                <label for="checkout_note" style="color:#00008b; font-weight:600;">Catatan</label>
                <input id="checkout_note" value="{{ $transaction->checkout_note }}" name="checkout_note" type="text" class="form-control @error('checkout_note') is-invalid @enderror" value="{{ old('checkout_note') }}" required autocomplete="checkout_note" autofocus style="border-radius:16px; border:1.5px solid #d4af37;">
                @error('checkout_note')
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