<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>studentcomplaints</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
        {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

          <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

        <link rel="stylesheet" href="{{asset('assets/css/notyf.min.css')}}">
         <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">


        <!-- Icons -->
        <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">

        <!-- Small Ionicons Fixes for AdminLTE -->
        <style>
        html {
            background-color: #f4f6f9;
        }

        .nav-icon.icon:before {
            width: 25px;
        }

        
        </style>

        @if(!empty($role) == 'student' && empty($student))
        <link rel="stylesheet" href="{{asset('custom_css/wizard.css')}}">
        @endif


        <script type="module">
            import hotwiredTurbo from 'https://cdn.skypack.dev/@hotwired/turbo';
        </script>

        @livewireStyles
    </head>

    <body class="sidebar-mini layout-fixed layout-navbar-fixed ">
        <div id="app" class="wrapper">
            <div class="main-header">
                @include('layouts.nav')
            </div>

            @include('layouts.sidebar')

            <main class="content-wrapper p-5">
                @yield('content')
            </main>
        </div>

        @stack('modals')




        <script src="{{ URL::to('plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ URL::to('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- DataTables  & Plugins -->
        <script src="{{ URL::to('plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{ URL::to('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{ URL::to('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{ URL::to('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
        <script src="{{ URL::to('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{ URL::to('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{ URL::to('plugins/jszip/jszip.min.js')}}"></script>
        <script src="{{ URL::to('plugins/pdfmake/pdfmake.min.js')}}"></script>
        <script src="{{ URL::to('plugins/pdfmake/vfs_fonts.js')}}"></script>
        <script src="{{ URL::to('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{ URL::to('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{ URL::to('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

        <script src="{{ asset('dist/js/adminlte.min.js')}}"></script>
        <script src="../node_modules/alpinejs/dist/cdn.min.js" defer></script>
        <!-- Select2 -->
        <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

        @livewireScripts

        <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script>

        @stack('scripts')
        <script>
            $('.select2').select2()
        </script>

        <script src="{{asset('assets/js/notyf.min.js')}}"></script>

        @if (session()->has('success'))
        <script>
            var notyf = new Notyf({dismissible: true})
            notyf.success('{{ session('success') }}')
        </script>
        @endif
        @auth
        @if (Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) ||
                    Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))
            @can('view-any', Spatie\Permission\Models\Role::class)
        <script>
            var allChecked = false;
            document.getElementById('toggle-checkbox').addEventListener('click', function() {
                var checkboxes = document.querySelectorAll('input[name="permissions[]"]');
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = !allChecked;
                }
                allChecked = !allChecked;
            });
        </script>
            @endcan
        @endif
        @endauth

        <script>
            /* Simple Alpine Image Viewer */
            document.addEventListener('alpine:init', () => {
                Alpine.data('imageViewer', (src = '') => {
                    return {
                        imageUrl: src,

                        refreshUrl() {
                            this.imageUrl = this.$el.getAttribute("image-url")
                        },

                        fileChosen(event) {
                            this.fileToDataUrl(event, src => this.imageUrl = src)
                        },

                        fileToDataUrl(event, callback) {
                            if (! event.target.files.length) return

                            let file = event.target.files[0],
                                reader = new FileReader()

                            reader.readAsDataURL(file)
                            reader.onload = e => callback(e.target.result)
                        },
                    }
                })
            })
        </script>
        <script>
            // $(document).ready( function () {
            //     $('#myTable_simple').DataTable({
            //     });
            //     $('#myTable').DataTable(
            //         {
            //             "scrollX": true,
            //             // "scrollY": 800,
            //             "responsive": false,
            //             "scrollCollapse": true,
            //             "paging": true,
            //             "searching": true,
            //             "info": true,
            //             "ordering": true,
            //             "fixedColumns":   {
            //                 "leftColumns": 2,

            //             },
            //             "columnDefs": [
            //                 { "width": "100px", "targets": 0 }
            //             ],
            //             "dom": 'Bfrtip',
            //             "buttons": [
            //                 'copy', 'csv', 'excel', 'pdf', 'print'
            //             ],
            //             "language": {
            //                 "lengthMenu": "Display _MENU_ records per page",
            //                 "zeroRecords": "Nothing found - sorry",
            //                 "info": "Showing page _PAGE_ of _PAGES_",
            //                 "infoEmpty": "No records available",
            //                 "infoFiltered": "(filtered from _MAX_ total records)"
            //             },


            //         }
            //     );

                

            // } );

              $(function () {
                $("#myTable").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#button-wrapper .col-md-6:eq(0)');
            
            });
        </script>
    </body>
</html>
