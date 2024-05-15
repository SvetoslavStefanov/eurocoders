<form
    id="{{ $name }}"
    action="{{ $url }}"
    method="POST"
    class="d-none"
    onsubmit="return confirm('{{ __('Are you sure?') }}');"
>
  <input type="hidden" name="_method" value="DELETE">
  @if(isset($previous_page))
    <input type="hidden" name="previous_page" value="{{$previous_page}}"/>
  @endif
  @csrf
</form>