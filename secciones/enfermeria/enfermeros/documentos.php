<script>
//Esta funciòn es para agregar las imagenes
  function previewImage(input) {
    var preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        preview.setAttribute('src', e.target.result);
        preview.style.display = 'block';
      }
      reader.readAsDataURL(input.files[0]);
    } else {
      preview.style.display = 'none';
    }
  }

  function openFilePicker(event) {
    event.preventDefault();
    document.getElementById('Foto_perfil').click();
  }

  function deletePhoto(event) {
    event.preventDefault();
    document.getElementById('preview').src = '../../../../img/png.png';
    document.getElementById('preview').style.display = 'none';
    document.getElementById('Foto_perfil').value = '';
    var deleteLink = document.querySelector('.delete-link');
    deleteLink.style.display = 'none';
  }

  function confirmCancel(event) {
    event.preventDefault();
    Swal.fire({
      title: '¿Estás seguro?',
      text: "Si cancelas, se perderán los datos ingresados.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, cancelar',
      cancelButtonText: 'No, continuar'
    }).then((result) => {
      if (result.isConfirmed) {
        // Aquí puedes redirigir al usuario a otra página o realizar alguna otra acción
        window.location.href = "<?php echo $url_base; ?>secciones/Capital_humano/empleados/index.php";

      }
    });
  }

</script>