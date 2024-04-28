function deleteUser(userId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover this user!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: 'darkblue',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'delete_user.php',
                type: 'POST',
                data: {
                    id: userId
                },
                success: function (response) {
                    if (response.status === 'success') {
                        location.reload();
                    }
                }
            });
        }
    });
}

document.getElementById('loginForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch('login.php', {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (response.ok) {
                window.location.href = 'dashboard.php';
            } else {
                return response.text();
            }
        })
        .then(errorMessage => {
            if (errorMessage) {
                console.error('Login failed:', errorMessage);
                document.getElementById('errorMessage').textContent = errorMessage;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});


function editUser(userId, firstName, lastName, email) {
    $('#editUserModal').modal('show').on('shown.bs.modal');
    $('#user_id').val(userId);
    $('#first_name').val(firstName);
    $('#last_name').val(lastName);
    $('#email').val(email);
}

function closeEditModal() {
    $('#editUserModal').modal('hide').on('hidden.bs.modal');
}