@php
  $first = new \DateTime("first day of $year-$month");
  $last = new \DateTime("last day of $year-$month");
  $month = new \DatePeriod($first, (new \DateInterval('P1D')), $last->modify('+1 day'));

  $startDay = (int)$month->getStartDate()->format('N');
  $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
@endphp

<div class="Month">
  <h4 class="Month__heading">{{ $month->getStartDate()->format('M') }}</h4>
  <div class="Month__grid grid">
    @for($i = 0; $i < $startDay - 1; $i++)
    <div class="grid__item"></div>
    @endfor
    
    @foreach($month as $day)
      <div class="grid__item">
        <div 
          class="Month__day @if(in_array($day->format('Y-m-d'), $allEntries)) Month__day--active @endif"
        ></div>
      </div>
    @endforeach
  </div>
</div>