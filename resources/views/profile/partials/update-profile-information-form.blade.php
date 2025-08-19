<section>
    <div class="mb-4">
        <h5 class="mb-1">Profile Information</h5>
        <p class="text-muted">Update your account's profile information and email address.</p>
    </div>

    <!-- Form Kirim Verifikasi Email -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Form Update Profile -->
    <form method="post" action="{{ route('profile.update') }}" id="profileUpdateForm">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input id="name" name="name" type="text"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" name="email" type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-warning small">
                        Your email address is unverified.
                        <button type="submit" form="send-verification" class="btn btn-link p-0 m-0 align-baseline">
                            Click here to re-send verification email
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="text-success small mt-1">
                            A new verification link has been sent to your email address.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Save
            </button>
        </div>
    </form>
</section>

<!-- SweetAlert2 Notification -->
@if (session('status') === 'profile-updated')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: 'Profile Updated',
                text: 'Your profile has been successfully updated!',
                timer: 2000,
                showConfirmButton: false
            });
        });
    </script>
@endif
