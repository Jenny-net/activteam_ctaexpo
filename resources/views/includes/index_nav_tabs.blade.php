
<ul class="nav nav-tabs">
<!-- Tab for Step 1: Details -->
<li class="nav-item">
    <a class="nav-link {{ Route::is('admin.home.content.edit') ? 'active' : '' }}"
        @if ($dataArr['page']->section_one)
            href="{{ route('admin.home.content.edit', $dataArr['page']->id) }}"
            role="tab"
        @else
            href="#"
        @endif
        role="tab">Step 1 : Details
    </a>
</li>

<!-- Tab for Step 2: 1st Section -->
<li class="nav-item">
    <a class="nav-link {{ Route::is('admin.homecontent.step.one.update') ? 'active' : '' }}"
        @if ($dataArr['page']->section_one)
            href="{{ route('admin.homecontent.step.one.update', $dataArr['page']->id) }}"
            role="tab"
        @else
            href="#"
        @endif
        role="tab">Step 2 : Content Area
    </a>
</li>

   
</ul>
