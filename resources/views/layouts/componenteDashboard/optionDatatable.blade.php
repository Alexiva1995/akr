{{-- para los css --}}
@push('page_css')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/vendors/css/tables/datatable/datatables.min.css')}}"> --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/r-2.2.6/datatables.min.css"/>
@endpush

{{-- para los js --}}
@push('page_vendor_js')
{{-- <script src="{{asset('assets/app-assets/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script> --}}
 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/r-2.2.6/datatables.min.js"></script>
@endpush


@push('custom_js')
    <script>
        $('.myTable').DataTable({
            // responsive: true,
         scrollX: true,

            order: [0, 'desc']
            
        })
    </script>
    <script>
        $('.myTable2').DataTable({
            responsive: true,
            order: [[ 0, "desc" ]],
            searching: tru,
            bLengthChange: false,
            pageLength: 5,
            language: {
                paginate: {
                    Siguiente:				">",
                    previous:			"<"
                },
            },
            drawCallback: function( settings ) {
                $('ul.pagination li.paginate_button.page-item.active').addClass("custom-pagination-li-active");
                $('ul.pagination li.paginate_button.page-item.active a').addClass("custom-pagination-li-active-a");
                $('ul.pagination li a').addClass("custom-pagination-li-a2");
                $('ul.pagination li.previous, ul.pagination li.next').addClass("custom-pagination-li");
                $('ul.pagination li.previous a, ul.pagination li.next a').addClass("custom-pagination-li-a");
            }
        })
    </script>
@endpush