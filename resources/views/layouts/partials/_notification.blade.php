<script type="text/javascript" src="{{ asset('js/PNotify.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/PNotifyButtons.js') }}"></script>

<script type="text/javascript">
  PNotify.defaults.styling = 'bootstrap4';

  @if(Session::has('success_message'))
      PNotify.success({
        text: '{{ Session::get('success_message') }}'
      });
  @endif

  @if(Session::has('error_message'))
      PNotify.error({
        text: '{{ Session::get('error_message') }}'
      });
  @endif
</script>
