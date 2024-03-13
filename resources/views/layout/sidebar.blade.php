<!-- expand-hover push -->
<!-- Sidebar -->
<div class="adminx-sidebar expand-hover push">
    <ul class="sidebar-nav">

        <li class="sidebar-nav-item">
            <a href="{{ route('attendance') }}" class="sidebar-nav-link">
                <span class="sidebar-nav-icon">
                    <i data-feather="home"></i>
                </span>
                <span class="sidebar-nav-name">
                    Dashboard
                </span>
                <span class="sidebar-nav-end">

                </span>
            </a>
        </li>

        <li class="sidebar-nav-item">
            @foreach (getMenuByRoleId() as $menuItem)
                <a class="sidebar-nav-link collapsed" data-toggle="collapse" href="#data{{ $menuItem->id }}"
                    aria-expanded="false" aria-controls="example">
                    <span class="sidebar-nav-icon">
                        <i data-feather="{{ $menuItem->icon }}"></i>
                    </span>
                    <span class="sidebar-nav-name">
                        {{ $menuItem->name }}
                    </span>
                    <span class="sidebar-nav-end">
                        <i data-feather="chevron-right" class="nav-collapse-icon"></i>
                    </span>
                </a>
                <ul class="sidebar-sub-nav collapse" id="data{{ $menuItem->id }}">
                    @foreach ($menuItem->subMenus as $subMenuItem)
                        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <li class="sidebar-nav-item">
                                <a href="{{ route($subMenuItem->url) }}" class="sidebar-nav-link">
                                    <span class="sidebar-nav-abbr">
                                        {{ $subMenuItem->short }}
                                    </span>
                                    <span class="sidebar-nav-name">
                                        {{ $subMenuItem->name }}
                                    </span>
                                </a>
                            </li>
                        @elseif (Auth::user()->role_id == 3 || Auth::user()->role_id == 4)
                            @if ($subMenuItem->id != 5)
                                <li class="sidebar-nav-item">
                                    <a href="{{ route($subMenuItem->url) }}" class="sidebar-nav-link">
                                        <span class="sidebar-nav-abbr">
                                            {{ $subMenuItem->short }}
                                        </span>
                                        <span class="sidebar-nav-name">
                                            {{ $subMenuItem->name }}
                                        </span>
                                    </a>
                                </li>
                            @endif
                        @endif
                    @endforeach
                </ul>
            @endforeach
        </li>
    </ul>
</div><!-- Sidebar End -->
