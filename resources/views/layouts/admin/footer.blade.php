      </div>
      </div>
      <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
      <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
      <script src="{{ asset('assets/js/app.min.js') }}"></script>
      <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
      <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
      <script src="{{ asset('assets/js/dashboard.js') }}"></script>
      <script
          src="https://cdn.datatables.net/v/bs5/dt-2.0.6/date-1.5.2/fc-5.0.0/fh-4.0.1/r-3.0.2/rg-1.5.0/rr-1.5.0/sc-2.4.2/datatables.min.js">
      </script>
      <!-- solar icons -->
      <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
      @include('sweetalert::alert')
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
      <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
      </script>
      @stack('scripts')
      </body>
      </html>
