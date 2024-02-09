document.addEventListener('DOMContentLoaded', function() {
    document.body.addEventListener('click', function(event) {
      if (event.target && event.target.id === 'featureBtn') {
        Swal.fire({
          icon: 'info',
          title: 'Feature Coming Soon',
          text: 'Stay tuned for updates!',
          confirmButtonText: 'Got it'
        });
      }
    });
  });
  