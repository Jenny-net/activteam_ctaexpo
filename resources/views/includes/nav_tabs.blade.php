<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.content.add') || Route::is('admin.content.edit') ? 'active' : '' }}"

            href="{{ @$dataArr['content']->is_completed ? route('admin.content.edit', $dataArr['content']->id) : '#' }}"
            role="tab">Step
            1 : Details</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.content.step.two.update') ? 'active' : '' }}"
            href="{{ @$dataArr['content']->is_completed ? route('admin.content.step.two.update', $dataArr['content']->id) : '#' }}"
            role="tab">Step
            2 : 1st Section</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.content.step.three.update') ? 'active' : '' }}"
            href="{{ @$dataArr['content']->is_completed ? route('admin.content.step.three.update', $dataArr['content']->id) : '#' }}"
            role="tab">Step
            3 : 2nd Section </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.content.step.four.update') ? 'active' : '' }}"
            href="{{ @$dataArr['content']->is_completed ? route('admin.content.step.four.update', $dataArr['content']->id) : '#' }}"
            role="tab">Step
            4 : 3rd Section </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.content.step.five.update') ? 'active' : '' }}"
            href="{{ @$dataArr['content']->is_completed ? route('admin.content.step.five.update', $dataArr['content']->id) : '#' }}"
            role="tab">Step
            5 : 4th Section </a>
    </li>
    @if(isset($dataArr['content']) && $dataArr['content']->template === "two")
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.content.step.six.update') ? 'active' : '' }}"
            href="{{ @$dataArr['content']->is_completed ? route('admin.content.step.six.update', $dataArr['content']->id) : '#' }}"
            role="tab">Step
            6 : 5th Section </a>
    </li>
@endif



   
</ul>
