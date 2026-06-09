<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.masscontent.add') || Route::is('admin.masscontent.edit') ? 'active' : '' }}"

            href="{{ @$dataArr['content']->is_completed ? route('admin.masscontent.edit', $dataArr['content']->id) : '#' }}"
            role="tab">Step
            1 : Details</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.masscontent.step.two.update') ? 'active' : '' }}"
            href="{{ @$dataArr['content']->is_completed ? route('admin.masscontent.step.two.update', $dataArr['content']->id) : '#' }}" role="tab">Step
            2 : 1st Section</a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.masscontent.step.three.update') ? 'active' : '' }}"
            href="{{ @$dataArr['content']->is_completed ? route('admin.masscontent.step.three.update', $dataArr['content']->id) : '#' }}"
            role="tab">Step
            3 : 2nd Section</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.masscontent.step.four.update') ? 'active' : '' }}"
            href="{{ @$dataArr['content']->is_completed ? route('admin.masscontent.step.four.update', $dataArr['content']->id) : '#' }}"
            role="tab">Step
            4 : 3rd Section</a>
    </li>
  
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.masscontent.step.five.update') ? 'active' : '' }}"
            href="{{ @$dataArr['content']->is_completed ? route('admin.masscontent.step.five.update', $dataArr['content']->id) : '#' }}"
            role="tab">Step
            5 : 4th Section</a>
    </li>
</ul>
