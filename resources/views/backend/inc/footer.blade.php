 <!-- ======= Footer ======= -->
 <footer id="footer" class="footer">
     <div class="copyright">
         &copy; Copyright <strong><span>JESCO</span></strong>. All Rights Reserved
     </div>
     <div class="credits">
         Develop by <a target="_blank" href="https://github.com/Sujon-Ahmed">Sujon Ahmed</a>
     </div>
 </footer><!-- End Footer -->

 <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

 <!-- Vendor JS Files -->
 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
 <script src="{{ asset('backend_assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
 <script src="{{ asset('backend_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('backend_assets/vendor/chart.js/chart.min.js') }}"></script>
 <script src="{{ asset('backend_assets/vendor/echarts/echarts.min.js') }}"></script>
 <script src="{{ asset('backend_assets/vendor/quill/quill.min.js') }}"></script>
 {{-- <script src="{{ asset('backend_assets/vendor/simple-datatables/simple-datatables.js') }}"></script> --}}
 <script src="{{ asset('backend_assets/vendor/tinymce/tinymce.min.js') }}"></script>
 <script src="{{ asset('backend_assets/vendor/php-email-form/validate.js') }}"></script>
 <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 <script src="{{ asset('backend_assets/js/main.js') }}"></script>
 {{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script> --}}
 {{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> --}}
 <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 {{-- custom script placement --}}
 @yield('scripts')
 {{-- script for dataTables --}}
 <script>
     $(document).ready(function() {
         $('#myTable').DataTable();
     });
 </script>

 {{-- session flash message toastr alert --}}
 @if (session('status'))
     <script>
         const Toast = Swal.mixin({
             toast: true,
             position: 'top-end',
             showConfirmButton: false,
             timer: 3000,
             timerProgressBar: true,
             didOpen: (toast) => {
                 toast.addEventListener('mouseenter', Swal.stopTimer)
                 toast.addEventListener('mouseleave', Swal.resumeTimer)
             }
         })

         Toast.fire({
             icon: 'success',
             title: '{{ session('status') }}',
         })
     </script>
 @endif
 @if (session('error'))
     <script>
         const Toast = Swal.mixin({
             toast: true,
             position: 'top-end',
             showConfirmButton: false,
             timer: 3000,
             timerProgressBar: true,
             didOpen: (toast) => {
                 toast.addEventListener('mouseenter', Swal.stopTimer)
                 toast.addEventListener('mouseleave', Swal.resumeTimer)
             }
         })

         Toast.fire({
             icon: 'error',
             title: '{{ session('error') }}',
         })
     </script>
 @endif


 </body>

 </html>
