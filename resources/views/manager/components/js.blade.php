<script src="{{asset("plugins/jquery/jquery.min.js")}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset("plugins/jquery-ui/jquery-ui.min.js")}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset("plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- ChartJS -->
<script src="{{asset("plugins/chart.js/Chart.min.js")}}"></script>
<!-- Sparkline -->
<script src="{{asset("plugins/sparklines/sparkline.js")}}"></script>

<script src="{{asset("plugins/jquery-knob/jquery.knob.min.js")}}"></script>
<!-- daterangepicker -->
<script src="{{asset("plugins/moment/moment.min.js")}}"></script>
<script src="{{asset("plugins/daterangepicker/daterangepicker.js")}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset("plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js")}}"></script>
<!-- Summernote -->
<script src="{{asset("plugins/summernote/summernote-bs4.min.js")}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset("plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{asset("dist/js/adminlte.js")}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset("dist/js/demo.js")}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset("dist/js/pages/dashboard.js")}}"></script>
{{--<script src="{{asset("js/jquery.pjax.js")}}"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css">
<script src="{{asset("js/getAddress.js")}}"></script>
{{--<script>--}}
{{--    var url = "{{ route('commune.by.district') }}";--}}
{{--    $("select[name='district']").change(function () {--}}
{{--        var address = $(this).val();--}}
{{--        var token = $("input[name='_token']").val();--}}
{{--        $.ajax({--}}
{{--            url: url,--}}
{{--            method: 'GET',--}}
{{--            data: {--}}
{{--                id: address,--}}
{{--                _token: token,--}}
{{--            },--}}
{{--            success: function (data) {--}}
{{--                console.log(data);--}}
{{--                $("select[name='ward']").html('');--}}
{{--                $.each(data.data, function (key, value) {--}}
{{--                    console.log(value)--}}
{{--                    $("select[name='ward']").append(--}}
{{--                        "<option value=" + value.xaid + ">" + value.name + "</option>"--}}
{{--                    );--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
