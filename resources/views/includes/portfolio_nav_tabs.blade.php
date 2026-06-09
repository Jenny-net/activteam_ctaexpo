<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.Portfolio.add') || Route::is('admin.Portfolio.edit') ? 'active' : '' }}"

            href="{{ @$dataArr['content']->is_completed ? route('admin.Portfolio.edit', $dataArr['content']->id) : '#' }}"
            role="tab">Step
            1 : Details</a>
    </li>
     <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.Portfolio.gallery.add') ? 'active' : '' }}"
            href="{{ @$dataArr['content']->is_completed ? route('admin.Portfolio.gallery.add', $dataArr['content']->id) : '#' }}"
            role="tab">Step
            2 : 1st Section</a>
    </li> 
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.portfolio.content.step.one.mass.page.url.update') ? 'active' : '' }}"
            href="{{ @$dataArr['content']->is_completed ? route('admin.portfolio.content.step.one.mass.page.url.update', $dataArr['content']->id) : '#' }}"
            role="tab">Step
            3 : 2nd section</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.portfolio.content.step.two.update') ? 'active' : '' }}"
            href="{{ @$dataArr['content']->is_completed ? route('admin.portfolio.content.step.two.update', $dataArr['content']->id) : '#' }}"
            role="tab">Step
            4 : 3rd Section</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.portfolio.content.step.three.update') ? 'active' : '' }}"
            href="{{ @$dataArr['content']->is_completed ? route('admin.portfolio.content.step.three.update', $dataArr['content']->id) : '#' }}"
            role="tab">Step
            5 : 4th Section</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.portfolio.content.step.four.update') ? 'active' : '' }}"
            href="{{ @$dataArr['content']->is_completed ? route('admin.portfolio.content.step.four.update', $dataArr['content']->id) : '#' }}"
            role="tab">Step
            6 : 5th Section</a>
    </li>        
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.portfolio.content.step.five.update') ? 'active' : '' }}"
            href="{{ @$dataArr['content']->is_completed ? route('admin.portfolio.content.step.five.update', $dataArr['content']->id) : '#' }}"
            role="tab">Step
            7 : 6th Section</a>
    </li>
    
</ul>
