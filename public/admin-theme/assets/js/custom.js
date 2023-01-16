/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

let path = location.pathname.split('/');
let url = location.origin + '/' + path[1];

$('ul.sidebar-menu li a').each(function() {
  if($(this).attr('href').indexOf(url) !== -1) {
    $(this).parent().addClass('active').parent().parent('li').addClass('active');
  }
});

function thumbPrev() {
  const thumbnail = document.querySelector('#thumbnail');
  const labelThumb = document.querySelector('.label-page-thumbnail');
  const thumbPreview = document.querySelector('.thumb-preview');

  labelThumb.textContent = thumbnail.files[0].name;

  const fileThumb = new FileReader();
  fileThumb.readAsDataURL(thumbnail.files[0]);

  fileThumb.onload = function(e) {
    thumbPreview.src = e.target.result;
  };
};

// var cleave = new Cleave('.phone-number', {
//   phone: true,
//   phoneRegionCode: 'ID'
// });

$('.form-del-blog-kategori').submit(function(e) {
  const form = this;

  e.preventDefault();

  Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Menghapus kategori kemungkinan besar akan menyebabkan postingan yang telah ada tidak muncul di halaman yang berkaitan.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#6777ef',
      cancelButtonColor: '#fc544b',
      confirmButtonText: 'Ye, saya yakin!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
      }
    });
});

$('.form-del-post').submit(function(e) {
  const form = this;

  e.preventDefault();

  Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Post yang telah dihapus dapat dilihat dan di-restore lagi. Cek menu Trash",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#6777ef',
      cancelButtonColor: '#fc544b',
      confirmButtonText: 'Ye, saya yakin!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
      }
    });
});

$('.form-del-post-permanent').submit(function(e) {
  const form = this;

  e.preventDefault();

  Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Post akan dihapus permanent. Tidak bisa dikembalikan lagi.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#6777ef',
      cancelButtonColor: '#fc544b',
      confirmButtonText: 'Ye, saya yakin!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
      }
    });
});

$('.form-del-post-permanent-all').submit(function(e) {
  const form = this;

  e.preventDefault();

  Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Semua post akan dihapus permanent. Tidak bisa dikembalikan lagi.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#6777ef',
      cancelButtonColor: '#fc544b',
      confirmButtonText: 'Ye, saya yakin!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
      }
    });
});

// DataTables
$(document).ready( function () {
  $('#table-psb').DataTable();
} );
