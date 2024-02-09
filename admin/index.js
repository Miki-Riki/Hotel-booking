function deleteUser(userId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover this user!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
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
    document.getElementById('editUserModal').style.display = "block";
    document.getElementById('user_id').value = userId;
    document.getElementById('first_name').value = firstName;
    document.getElementById('last_name').value = lastName;
    document.getElementById('email').value = email;
}

function closeEditModal() {
    document.getElementById('editUserModal').style.display = "none";
}