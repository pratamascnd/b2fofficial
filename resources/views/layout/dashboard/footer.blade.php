        </div>
        <footer class="footer">
          <div class="container-fluid d-flex justify-content-between">
            <div class="copyright">
              Created by <strong class="sitename">B2F Official</strong>
            </div>
          </div>
        </footer>
      </div>
      <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    <script src="{{asset('bootstrap')}}/bootstrap-b2f-dashboard/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="{{asset('bootstrap')}}/bootstrap-b2f-dashboard/assets/js/core/popper.min.js"></script>
    <script src="{{asset('bootstrap')}}/bootstrap-b2f-dashboard/assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{asset('bootstrap')}}/bootstrap-b2f-dashboard/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="{{asset('bootstrap')}}/bootstrap-b2f-dashboard/assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="{{asset('bootstrap')}}/bootstrap-b2f-dashboard/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="{{asset('bootstrap')}}/bootstrap-b2f-dashboard/assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="{{asset('bootstrap')}}/bootstrap-b2f-dashboard/assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="{{asset('bootstrap')}}/bootstrap-b2f-dashboard/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{asset('bootstrap')}}/bootstrap-b2f-dashboard/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="{{asset('bootstrap')}}/bootstrap-b2f-dashboard/assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="{{asset('bootstrap')}}/bootstrap-b2f-dashboard/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="{{asset('bootstrap')}}/bootstrap-b2f-dashboard/assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{asset('bootstrap')}}/bootstrap-b2f-dashboard/assets/js/setting-demo.js"></script>
    <script src="{{asset('bootstrap')}}/bootstrap-b2f-dashboard/assets/js/demo.js"></script>

    <script>
      $(document).ready(function () {
        $("#basic-datatables").DataTable({});

        $("#multi-filter-select").DataTable({
          pageLength: 5,
          initComplete: function () {
            this.api()
              .columns()
              .every(function () {
                var column = this;
                var select = $(
                  '<select class="form-select"><option value=""></option></select>',
                )
                  .appendTo($(column.footer()).empty())
                  .on("change", function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column
                      .search(val ? "^" + val + "$" : "", true, false)
                      .draw();
                  });

                column
                  .data()
                  .unique()
                  .sort()
                  .each(function (d, j) {
                    select.append(
                      '<option value="' + d + '">' + d + "</option>",
                    );
                  });
              });
          },
        });

        // Add Row
        $("#add-row").DataTable({
          pageLength: 5,
        });

        var action =
          '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        $("#addRowButton").click(function () {
          $("#add-row")
            .dataTable()
            .fnAddData([
              $("#addName").val(),
              $("#addPosition").val(),
              $("#addOffice").val(),
              action,
            ]);
          $("#addRowModal").modal("hide");
        });
      });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      @if (session('SA-success'))
          Swal.fire({
              icon: 'success',
              title: 'Berhasil!',
              text: "{{ session('SA-success') }}",
              showConfirmButton: false,
              timer: 2000
          });
      @endif

      @if (session('SA-error'))
          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: "{{ session('SA-error') }}",
              confirmButtonColor: '#d33',
          });
      @endif

      @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Gagal Simpan!',
                html: `
                    <ul style="text-align: left;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                confirmButtonColor: '#d33',
            });
        @endif
    </script>

    {{-- sweetalert hapus --}}
    <script type="text/javascript">
      $(function(){
        // Tombol Hapus
        $(document).on('click', '#delete', function(e){
          e.preventDefault();
          var form = $(this).closest("form");

          Swal.fire({
            title: "Peringatan",
            text: "Apakah kamu yakin akan menghapus data ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#4CAF50",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus",
            cancelButtonText: "Tidak"
          }).then((result) => {
            if (result.isConfirmed) {
              form.submit();
              Swal.fire({
                title: "Terhapus!",
                text: "Data berhasil dihapus.",
                icon: "success"
              });
              
            }
          });
        });

      });
    </script>
    @stack('scripts')
  </body>
</html>
