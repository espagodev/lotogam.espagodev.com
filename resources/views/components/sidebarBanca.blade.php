@if ((Route::currentRouteName() == $route))

  <li class="selected list-group-item">
    <i class="{{ $icon }} " aria-hidden="true"></i>
    <strong>{{ $title }}</strong>
  </li>
@else
  <li class="bg-white list-group-item">
    <i class="{{ $icon }} " aria-hidden="true"></i>
    <a href="{{ route($route,$banca) }}">{{ $title }}</a>
  </li>
@endif
