<section>
    <div class="mb-4">
        <h5 class="text-danger">Delete Account</h5>
        <p class="text-muted">
            Once your account is deleted, all of its resources and data will be permanently deleted.
            Please download any data or information that you wish to retain before proceeding.
        </p>
    </div>

    <form id="deleteAccountForm" method="post" action="{{ route('profile.destroy') }}">
        @csrf
        @method('delete')

        <!-- Password -->
        <div class="mb-3">
            <label for="delete_password" class="form-label">Password</label>
            <input id="delete_password" name="password" type="password"
                   class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                   placeholder="Enter your password to confirm">
            @error('password', 'userDeletion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Delete Button -->
        <button type="button" class="btn btn-danger" id="deleteAccountBtn">
            <i class="bi bi-trash-fill"></i> Delete Account
        </button>
    </form>
</section>

<!-- SweetAlert2 Confirm Delete -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteBtn = document.getElementById('deleteAccountBtn');
        const deleteForm = document.getElementById('deleteAccountForm');

        deleteBtn.addEventListener('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "Once deleted, your account and all data will be permanently removed!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteForm.submit();
                }
            });
        });
    });
</script>
